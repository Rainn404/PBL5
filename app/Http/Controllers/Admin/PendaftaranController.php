<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\PendaftaranSetting;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        // Ambil settings pendaftaran
        $settings = PendaftaranSetting::first();
        if (!$settings) {
            $settings = new PendaftaranSetting([
                'pendaftaran_aktif' => false,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addMonth()->format('Y-m-d'),
                'kuota' => 50,
                'auto_close' => true
            ]);
        }

        // Statistik
        $stats = [
            'totalPendaftaran' => Pendaftaran::count(),
            'pendingCount' => Pendaftaran::where('status_pendaftaran', 'pending')->count(),
            'diterimaCount' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'ditolakCount' => Pendaftaran::where('status_pendaftaran', 'ditolak')->count(),
        ];

        // Query dengan filter
        $query = Pendaftaran::with(['user', 'validator', 'divisi', 'jabatan']);

        // Filter status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status_pendaftaran', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nim', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('email', 'like', '%' . $search . '%');
                  });
            });
        }

        $pendaftaran = $query->orderBy('created_at', 'desc')->paginate(10);

        // Ambil data divisi dan jabatan untuk form validasi
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();

        return view('admin.pendaftaran.index', compact('settings', 'stats', 'pendaftaran', 'divisi', 'jabatan'));
    }

    public function create()
    {
        // Biasanya untuk admin tidak perlu create form, redirect ke index
        return redirect()->route('admin.pendaftaran.index');
    }

    public function store(Request $request)
    {
        // Biasanya untuk admin tidak perlu store, redirect ke index
        return redirect()->route('admin.pendaftaran.index');
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'validator', 'divisi', 'jabatan'])
            ->findOrFail($id);

        return response()->json($pendaftaran);
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'divisi', 'jabatan'])
            ->findOrFail($id);
            
        $divisi = Divisi::where('status', 'active')->get();
        $jabatan = Jabatan::where('status', 'active')->get();
        
        return view('admin.pendaftaran.partials.edit_form', compact('pendaftaran', 'divisi', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $rules = [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:pendaftaran,nim,' . $pendaftaran->id . ',id',
            'semester' => 'required|integer|min:1|max:14',
            'no_hp' => 'nullable|string|max:20',
            'alasan_mendaftar' => 'required|string|max:1000',
            'pengalaman' => 'nullable|string|max:1000',
            'skill' => 'nullable|string|max:1000',
            'status_pendaftaran' => 'required|in:pending,diterima,ditolak',
            'id_divisi' => 'nullable|required_if:status_pendaftaran,diterima|exists:divisi,id',
            'id_jabatan' => 'nullable|required_if:status_pendaftaran,diterima|exists:jabatan,id',
            'alasan_penolakan' => 'nullable|string|max:500'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $pendaftaran->nama = $request->nama;
            $pendaftaran->nim = $request->nim;
            $pendaftaran->semester = $request->semester;
            $pendaftaran->no_hp = $request->no_hp;
            $pendaftaran->alasan_mendaftar = $request->alasan_mendaftar;
            $pendaftaran->pengalaman = $request->pengalaman;
            $pendaftaran->skill = $request->skill;
            $pendaftaran->status_pendaftaran = $request->status_pendaftaran;

            if ($request->status_pendaftaran == 'diterima') {
                $pendaftaran->id_divisi = $request->id_divisi;
                $pendaftaran->id_jabatan = $request->id_jabatan;
                $pendaftaran->alasan_penolakan = null;
                
                // Update user role jika status berubah menjadi diterima
                $user = User::find($pendaftaran->user_id);
                if ($user) {
                    $user->role = 'anggota';
                    $user->save();
                }
            } else {
                $pendaftaran->alasan_penolakan = $request->alasan_penolakan;
                $pendaftaran->id_divisi = null;
                $pendaftaran->id_jabatan = null;
            }

            if ($request->hasFile('dokumen')) {
                // Hapus file lama jika ada
                if ($pendaftaran->dokumen) {
                    Storage::disk('public')->delete($pendaftaran->dokumen);
                }
                $path = $request->file('dokumen')->store('dokumen_pendaftaran', 'public');
                $pendaftaran->dokumen = $path;
            }

            $pendaftaran->save();

            DB::commit();

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Data pendaftaran berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $pendaftaran = Pendaftaran::findOrFail($id);
            
            // Hapus file dokumen jika ada
            if ($pendaftaran->dokumen) {
                Storage::disk('public')->delete($pendaftaran->dokumen);
            }
            
            $pendaftaran->delete();

            DB::commit();

            return redirect()->back()
                ->with('success', 'Data pendaftaran berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Additional methods untuk buka/tutup sesi
   public function bukaSesi(Request $request)
{
    try {
        DB::beginTransaction();

        $settings = PendaftaranSetting::first();
        
        if (!$settings) {
            $settings = new PendaftaranSetting([
                'pendaftaran_aktif' => true,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addMonth()->format('Y-m-d'),
                'kuota' => 50,
                'auto_close' => true
            ]);
        } else {
            // Validasi
            if (!$settings->tanggal_mulai || !$settings->tanggal_selesai) {
                return response()->json([
                    'success' => false,
                    'message' => 'Harap setting tanggal mulai dan selesai terlebih dahulu'
                ], 400);
            }

            if (!$settings->kuota || $settings->kuota <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Harap setting kuota penerimaan terlebih dahulu'
                ], 400);
            }

            $settings->pendaftaran_aktif = true;
        }

        $settings->save();
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Sesi pendaftaran berhasil dibuka'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}
    public function tutupSesi(Request $request)
    {
        try {
            DB::beginTransaction();

            $settings = PendaftaranSetting::first();
            if ($settings) {
                $settings->pendaftaran_aktif = false;
                $settings->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sesi pendaftaran berhasil ditutup'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'required|integer|min:1',
            'auto_close' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $settings = PendaftaranSetting::firstOrNew();
            $settings->tanggal_mulai = $request->tanggal_mulai;
            $settings->tanggal_selesai = $request->tanggal_selesai;
            $settings->kuota = $request->kuota;
            $settings->auto_close = $request->boolean('auto_close');
            $settings->save();

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengaturan periode berhasil disimpan'
                ]);
            }

            return redirect()->back()->with('success', 'Pengaturan periode berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status_pendaftaran' => 'required|in:diterima,ditolak',
            'id_divisi' => 'required_if:status_pendaftaran,diterima|exists:divisi,id_divisi',
            'id_jabatan' => 'required_if:status_pendaftaran,diterima|exists:jabatan,id_jabatan',
            'alasan_penolakan' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Validasi gagal: ' . $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $pendaftaran = Pendaftaran::findOrFail($id);
            
            // Validasi kuota jika status diterima
            if ($request->status_pendaftaran == 'diterima') {
                $totalDiterima = Pendaftaran::where('status_pendaftaran', 'diterima')->count();
                $settings = PendaftaranSetting::first();
                
                if ($settings && $totalDiterima >= $settings->kuota) {
                    return redirect()->back()
                        ->with('error', 'Kuota penerimaan sudah penuh. Tidak dapat menerima pendaftar lagi.');
                }

                // Update user role menjadi anggota
                $user = User::find($pendaftaran->user_id);
                if ($user) {
                    $user->role = 'anggota';
                    $user->save();
                }
            }

            $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
            $pendaftaran->validator_id = auth('super_admin')->id();
            $pendaftaran->validated_at = now();

            if ($request->status_pendaftaran == 'diterima') {
                $pendaftaran->id_divisi = $request->id_divisi;
                $pendaftaran->id_jabatan = $request->id_jabatan;
                $pendaftaran->alasan_penolakan = null;
            } else {
                $pendaftaran->alasan_penolakan = $request->alasan_penolakan;
                $pendaftaran->id_divisi = null;
                $pendaftaran->id_jabatan = null;
            }

            $pendaftaran->save();

            DB::commit();

            $statusText = $request->status_pendaftaran == 'diterima' ? 'diterima' : 'ditolak';
            return redirect()->back()
                ->with('success', "Pendaftaran berhasil di{$statusText}");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}