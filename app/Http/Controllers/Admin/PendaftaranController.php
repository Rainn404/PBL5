<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\AnggotaHima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pendaftaran dengan relasi
        $pendaftaran = Pendaftaran::with(['user', 'validator'])
            ->orderBy('submitted_at', 'desc')
            ->get();
        
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();

        return view('admin.pendaftaran.index', compact('pendaftaran', 'divisi', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
    return redirect()->back()->with('error', 'Silakan login terlebih dahulu!');
}

        try {
            $request->validate([
                'nim' => 'required|unique:pendaftaran,nim',
                'nama' => 'required|string|max:150',
                'semester' => 'required|integer|between:1,14',
                'alasan_mendaftar' => 'required|string',
                'no_hp' => 'required|string|max:20',
                'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data = $request->all();
            $data['id_user'] = auth()->guard('admin')->id();

            $data['status_pendaftaran'] = 'pending';

            // Handle file upload
            if ($request->hasFile('dokumen')) {
                $file = $request->file('dokumen');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pendaftaran', $fileName, 'public');
                $data['dokumen'] = $path;
            }

            Pendaftaran::create($data);

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Pendaftaran berhasil dibuat!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'validator'])->findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            
            $request->validate([
                'nim' => 'required|unique:pendaftaran,nim,' . $id . ',id_pendaftaran',
                'nama' => 'required|string|max:150',
                'semester' => 'required|integer|between:1,14',
                'alasan_mendaftar' => 'required|string',
                'no_hp' => 'required|string|max:20',
                'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('dokumen')) {
                // Delete old file
                if ($pendaftaran->dokumen) {
                    Storage::disk('public')->delete($pendaftaran->dokumen);
                }
                
                $file = $request->file('dokumen');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pendaftaran', $fileName, 'public');
                $data['dokumen'] = $path;
            }

            $pendaftaran->update($data);

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Pendaftaran berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update status pendaftaran (diterima/ditolak)
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            
            $request->validate([
                'status_pendaftaran' => 'required|in:diterima,ditolak',
                'id_divisi' => 'required_if:status_pendaftaran,diterima',
                'id_jabatan' => 'required_if:status_pendaftaran,diterima',
                'alasan_penolakan' => 'nullable|string',
            ]);

            $data = [
                'status_pendaftaran' => $request->status_pendaftaran,
                'divalidasi_oleh' => auth()->id(),
            ];

            // Jika diterima, buat data anggota hima
            if ($request->status_pendaftaran === 'diterima') {
                // Cek apakah sudah menjadi anggota
                $existingAnggota = AnggotaHima::where('nim', $pendaftaran->nim)->first();
                
                if (!$existingAnggota) {
                    AnggotaHima::create([
                        'id_user' => $pendaftaran->id_user,
                        'id_divisi' => $request->id_divisi,
                        'id_jabatan' => $request->id_jabatan,
                        'nim' => $pendaftaran->nim,
                        'nama' => $pendaftaran->nama,
                        'semester' => $pendaftaran->semester,
                        'status' => 'active'
                    ]);
                } else {
                    // Update anggota yang sudah ada
                    $existingAnggota->update([
                        'id_divisi' => $request->id_divisi,
                        'id_jabatan' => $request->id_jabatan,
                        'status' => 'active'
                    ]);
                }
            }

            $pendaftaran->update($data);

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Status pendaftaran berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            
            // Delete file if exists
            if ($pendaftaran->dokumen) {
                Storage::disk('public')->delete($pendaftaran->dokumen);
            }
            
            $pendaftaran->delete();

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Pendaftaran berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}