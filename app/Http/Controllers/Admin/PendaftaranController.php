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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan halaman kelola pendaftaran
     */
    public function index(Request $request)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses sebagai super admin.');
        }

        try {
            // Ambil settings pendaftaran
            $settings = PendaftaranSetting::first();
            if (!$settings) {
                $settings = $this->createDefaultSettings();
            }

            // Statistik lengkap
            $stats = $this->getPendaftaranStats();

            // Query dengan filter dan search
            $pendaftaran = $this->getFilteredPendaftaran($request);

            // Ambil data divisi dan jabatan untuk form validasi
            $divisi = Divisi::where('status', 'active')->get();
            $jabatan = Jabatan::where('status', 'active')->get();

            return view('admin.pendaftaran.index', compact(
                'settings', 
                'stats', 
                'pendaftaran', 
                'divisi', 
                'jabatan'
            ));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail pendaftaran
     */
    public function show($id)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses sebagai super admin.'
            ], 403);
        }

        try {
            $pendaftaran = Pendaftaran::with([
                'user', 
                'validator', 
                'divisi', 
                'jabatan'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $pendaftaran
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Menampilkan form edit pendaftaran
     */
    public function edit($id)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses sebagai super admin.'
            ], 403);
        }

        try {
            $pendaftaran = Pendaftaran::with(['user', 'divisi', 'jabatan'])
                ->findOrFail($id);
                
            $divisi = Divisi::where('status', 'active')->get();
            $jabatan = Jabatan::where('status', 'active')->get();
            
            return view('admin.pendaftaran.partials.edit_form', compact(
                'pendaftaran', 
                'divisi', 
                'jabatan'
            ));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update data pendaftaran
     */
    public function update(Request $request, $id)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses sebagai super admin.');
        }

        $pendaftaran = Pendaftaran::findOrFail($id);

        $rules = [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:pendaftaran,nim,' . $pendaftaran->id . ',id_pendaftaran',
            'semester' => 'required|integer|min:1|max:14',
            'no_hp' => 'nullable|string|max:20',
            'alasan_mendaftar' => 'required|string|max:1000',
            'pengalaman' => 'nullable|string|max:1000',
            'skill' => 'nullable|string|max:1000',
            'status_pendaftaran' => 'required|in:pending,diterima,ditolak',
            'id_divisi' => 'nullable|required_if:status_pendaftaran,diterima|exists:divisi,id_divisi',
            'id_jabatan' => 'nullable|required_if:status_pendaftaran,diterima|exists:jabatan,id_jabatan',
            'alasan_penolakan' => 'nullable|string|max:500',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal: ' . $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update data dasar
            $pendaftaran->nama = $request->nama;
            $pendaftaran->nim = $request->nim;
            $pendaftaran->semester = $request->semester;
            $pendaftaran->no_hp = $request->no_hp;
            $pendaftaran->alasan_mendaftar = $request->alasan_mendaftar;
            $pendaftaran->pengalaman = $request->pengalaman;
            $pendaftaran->skill = $request->skill;
            
            // Handle status perubahan
            $statusChanged = $pendaftaran->status_pendaftaran !== $request->status_pendaftaran;
            $pendaftaran->status_pendaftaran = $request->status_pendaftaran;

            if ($request->status_pendaftaran == 'diterima') {
                $pendaftaran->id_divisi = $request->id_divisi;
                $pendaftaran->id_jabatan = $request->id_jabatan;
                $pendaftaran->alasan_penolakan = null;
                $pendaftaran->validator_id = auth()->id();
                $pendaftaran->validated_at = now();
                
                // Update user role jika status berubah menjadi diterima
                if ($statusChanged) {
                    $user = User::find($pendaftaran->user_id);
                    if ($user && $user->role !== 'anggota') {
                        $user->role = 'anggota';
                        $user->save();
                    }
                }
            } else if ($request->status_pendaftaran == 'ditolak') {
                $pendaftaran->alasan_penolakan = $request->alasan_penolakan;
                $pendaftaran->id_divisi = null;
                $pendaftaran->id_jabatan = null;
                $pendaftaran->validator_id = auth()->id();
                $pendaftaran->validated_at = now();
            } else {
                $pendaftaran->alasan_penolakan = null;
                $pendaftaran->validator_id = null;
                $pendaftaran->validated_at = null;
            }

            // Handle file upload
            if ($request->hasFile('dokumen')) {
                // Hapus file lama jika ada
                if ($pendaftaran->dokumen && Storage::disk('public')->exists($pendaftaran->dokumen)) {
                    Storage::disk('public')->delete($pendaftaran->dokumen);
                }
                
                $file = $request->file('dokumen');
                $filename = 'doc_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('dokumen_pendaftaran', $filename, 'public');
                $pendaftaran->dokumen = $path;
            }

            $pendaftaran->save();

            DB::commit();

            $message = $statusChanged ? 
                "Status pendaftaran berhasil diubah menjadi " . $request->status_pendaftaran : 
                "Data pendaftaran berhasil diperbarui";

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hapus data pendaftaran
     */
    public function destroy($id)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses sebagai super admin.');
        }

        try {
            DB::beginTransaction();

            $pendaftaran = Pendaftaran::findOrFail($id);
            
            // Hapus file dokumen jika ada
            if ($pendaftaran->dokumen && Storage::disk('public')->exists($pendaftaran->dokumen)) {
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

    /**
     * Buka sesi pendaftaran
     */
    public function bukaSesi(Request $request)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses sebagai super admin.'
            ], 403);
        }

        try {
            DB::beginTransaction();

            $settings = PendaftaranSetting::first();
            
            if (!$settings) {
                $settings = $this->createDefaultSettings();
            }

            // Validasi pengaturan
            $validation = $this->validateSettings($settings);
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $validation['message']
                ], 400);
            }

            $settings->pendaftaran_aktif = true;
            $settings->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sesi pendaftaran berhasil dibuka',
                'settings' => $settings
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tutup sesi pendaftaran
     */
    public function tutupSesi(Request $request)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses sebagai super admin.'
            ], 403);
        }

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
                'message' => 'Sesi pendaftaran berhasil ditutup',
                'settings' => $settings
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update pengaturan periode pendaftaran
     */
    public function updateSettings(Request $request)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses sebagai super admin.'
                ], 403);
            }
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses sebagai super admin.');
        }

        $validator = Validator::make($request->all(), [
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'required|integer|min:1',
            'auto_close' => 'sometimes|boolean'
        ], [
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $settings = PendaftaranSetting::firstOrNew();
            $settings->tanggal_mulai = $request->tanggal_mulai;
            $settings->tanggal_selesai = $request->tanggal_selesai;
            $settings->kuota = $request->kuota;
            $settings->auto_close = $request->boolean('auto_close', false);
            
            // Jika auto_close aktif dan tanggal selesai sudah lewat, tutup otomatis
            if ($settings->auto_close && Carbon::now()->gt($settings->tanggal_selesai)) {
                $settings->pendaftaran_aktif = false;
            }
            
            $settings->save();

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengaturan periode berhasil disimpan',
                    'settings' => $settings
                ]);
            }

            return redirect()->back()->with('success', 'Pengaturan periode berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update status pendaftaran (terima/tolak)
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses sebagai super admin.');
        }

        $validator = Validator::make($request->all(), [
            'status_pendaftaran' => 'required|in:diterima,ditolak',
            'id_divisi' => 'required_if:status_pendaftaran,diterima|exists:divisi,id_divisi',
            'id_jabatan' => 'required_if:status_pendaftaran,diterima|exists:jabatan,id_jabatan',
            'alasan_penolakan' => 'nullable|required_if:status_pendaftaran,ditolak|string|max:500'
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
                $kuotaCheck = $this->checkKuotaPenerimaan();
                if (!$kuotaCheck['available']) {
                    return redirect()->back()
                        ->with('error', $kuotaCheck['message']);
                }
            }

            $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
            $pendaftaran->validator_id = auth()->id();
            $pendaftaran->validated_at = now();

            if ($request->status_pendaftaran == 'diterima') {
                $pendaftaran->id_divisi = $request->id_divisi;
                $pendaftaran->id_jabatan = $request->id_jabatan;
                $pendaftaran->alasan_penolakan = null;
                
                // Update user role menjadi anggota
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

    /**
     * Get status pendaftaran (API)
     */
    public function getStatus()
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses sebagai super admin.'
            ], 403);
        }

        try {
            $settings = PendaftaranSetting::first();
            
            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'pendaftaran_aktif' => false,
                    'message' => 'Pengaturan pendaftaran belum diatur'
                ]);
            }

            $stats = $this->getPendaftaranStats();

            return response()->json([
                'success' => true,
                'pendaftaran_aktif' => $settings->pendaftaran_aktif,
                'settings' => $settings,
                'stats' => $stats,
                'server_time' => now()->toDateTimeString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export data pendaftaran
     */
    public function export(Request $request)
    {
        // Validasi super admin
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses sebagai super admin.'
            ], 403);
        }

        try {
            $pendaftaran = $this->getFilteredPendaftaran($request, false);
            
            $filename = 'pendaftaran_' . date('Y-m-d_H-i-s') . '.xlsx';
            
            return response()->json([
                'success' => true,
                'message' => 'Fitur export akan segera tersedia',
                'data_count' => $pendaftaran->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * =========================================================================
     * PRIVATE METHODS
     * =========================================================================
     */

    /**
     * Buat pengaturan default
     */
    private function createDefaultSettings()
    {
        return PendaftaranSetting::create([
            'pendaftaran_aktif' => false,
            'tanggal_mulai' => now()->format('Y-m-d'),
            'tanggal_selesai' => now()->addMonth()->format('Y-m-d'),
            'kuota' => 50,
            'auto_close' => true
        ]);
    }

    /**
     * Get statistik pendaftaran
     */
    private function getPendaftaranStats()
    {
        return [
            'totalPendaftaran' => Pendaftaran::count(),
            'pendingCount' => Pendaftaran::where('status_pendaftaran', 'pending')->count(),
            'diterimaCount' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'ditolakCount' => Pendaftaran::where('status_pendaftaran', 'ditolak')->count(),
            'todayCount' => Pendaftaran::whereDate('created_at', today())->count(),
            'weekCount' => Pendaftaran::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'monthCount' => Pendaftaran::whereMonth('created_at', now()->month)->count(),
        ];
    }

    /**
     * Get data pendaftaran dengan filter
     */
    private function getFilteredPendaftaran(Request $request, $paginate = true)
    {
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
                  ->orWhere('no_hp', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter tanggal
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $query->orderBy('created_at', 'desc');

        return $paginate ? $query->paginate(10) : $query->get();
    }

    /**
     * Validasi pengaturan
     */
    private function validateSettings($settings)
    {
        if (!$settings->tanggal_mulai || !$settings->tanggal_selesai) {
            return [
                'valid' => false,
                'message' => 'Harap setting tanggal mulai dan selesai terlebih dahulu'
            ];
        }

        if (!$settings->kuota || $settings->kuota <= 0) {
            return [
                'valid' => false,
                'message' => 'Harap setting kuota penerimaan terlebih dahulu'
            ];
        }

        if (Carbon::now()->gt($settings->tanggal_selesai)) {
            return [
                'valid' => false,
                'message' => 'Tanggal selesai pendaftaran sudah lewat. Perbarui tanggal terlebih dahulu.'
            ];
        }

        return ['valid' => true, 'message' => 'OK'];
    }

    /**
     * Cek ketersediaan kuota
     */
    private function checkKuotaPenerimaan()
    {
        $settings = PendaftaranSetting::first();
        $totalDiterima = Pendaftaran::where('status_pendaftaran', 'diterima')->count();

        if ($settings && $totalDiterima >= $settings->kuota) {
            return [
                'available' => false,
                'message' => 'Kuota penerimaan sudah penuh. Tidak dapat menerima pendaftar lagi.'
            ];
        }

        return [
            'available' => true,
            'message' => 'Kuota tersedia',
            'terpakai' => $totalDiterima,
            'sisa' => $settings ? $settings->kuota - $totalDiterima : 0
        ];
    }
}