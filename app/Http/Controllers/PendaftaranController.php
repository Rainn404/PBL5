<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\AnggotaHima;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Display pendaftaran management page
     */
    public function index()
    {
        // Data dummy untuk sementara
        $pendaftaran = collect([
            [
                'id_pendaftaran' => 1,
                'nama' => 'Ahmad Rizki',
                'nim' => '20210001',
                'semester' => 3,
                'no_hp' => '081234567890',
                'email' => 'ahmad@example.com',
                'alasan_mendaftar' => 'Saya ingin bergabung dengan HIMA TI untuk mengembangkan skill dan berkontribusi untuk organisasi.',
                'dokumen' => 'dokumen/dokumen1.pdf',
                'status_pendaftaran' => 'pending',
                'submitted_at' => '2024-09-01 10:00:00',
                'divalidasi_oleh' => null,
                'validator' => null
            ],
            [
                'id_pendaftaran' => 2,
                'nama' => 'Lisa Putri',
                'nim' => '20210002',
                'semester' => 5,
                'no_hp' => '081298765432',
                'email' => 'lisa@example.com',
                'alasan_mendaftar' => 'Berminat untuk belajar organisasi dan pengembangan diri melalui HIMA TI.',
                'dokumen' => null,
                'status_pendaftaran' => 'diterima',
                'submitted_at' => '2024-08-28 14:30:00',
                'divalidasi_oleh' => 1,
                'validator' => 'Admin HIMA'
            ],
            [
                'id_pendaftaran' => 3,
                'nama' => 'Andi Pratama',
                'nim' => '20210003',
                'semester' => 2,
                'no_hp' => '08111222333',
                'email' => 'andi@example.com',
                'alasan_mendaftar' => 'Ingin menambah pengalaman organisasi dan relasi di kampus.',
                'dokumen' => 'dokumen/dokumen3.pdf',
                'status_pendaftaran' => 'ditolak',
                'submitted_at' => '2024-08-25 09:15:00',
                'divalidasi_oleh' => 1,
                'validator' => 'Admin HIMA'
            ]
        ]);

        // Data divisi dan jabatan untuk form
        $divisi = collect([
            ['id_divisi' => 1, 'nama' => 'Divisi IT'],
            ['id_divisi' => 2, 'nama' => 'Divisi Humas'],
            ['id_divisi' => 3, 'nama' => 'Divisi Akademik']
        ]);

        $jabatan = collect([
            ['id_jabatan' => 1, 'nama_jabatan' => 'Anggota'],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Koordinator'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Sekretaris']
        ]);

        return view('admin.pendaftaran', compact('pendaftaran', 'divisi', 'jabatan'));
    }

    /**
     * Update status pendaftaran
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pendaftaran' => 'required|in:pending,diterima,ditolak',
            'id_divisi' => 'required_if:status_pendaftaran,diterima',
            'id_jabatan' => 'required_if:status_pendaftaran,diterima',
            'alasan_penolakan' => 'nullable|string|max:500'
        ]);

        try {
            // $pendaftaran = Pendaftaran::findOrFail($id);
            
            if ($validated['status_pendaftaran'] === 'diterima') {
                // Tambahkan ke anggota hima
                // AnggotaHima::create([
                //     'id_user' => $pendaftaran->id_user,
                //     'id_divisi' => $validated['id_divisi'],
                //     'id_jabatan' => $validated['id_jabatan'],
                //     'nim' => $pendaftaran->nim,
                //     'nama' => $pendaftaran->nama,
                //     'semester' => $pendaftaran->semester,
                //     'status' => 'active'
                // ]);
            }

            // Update status pendaftaran
            // $pendaftaran->update([
            //     'status_pendaftaran' => $validated['status_pendaftaran'],
            //     'divalidasi_oleh' => Auth::id()
            // ]);

            $statusText = $validated['status_pendaftaran'] === 'diterima' ? 'diterima' : 'ditolak';
            return redirect()->route('admin.pendaftaran.index')
                ->with('success', "Pendaftaran berhasil di{$statusText}.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status pendaftaran: ' . $e->getMessage());
        }
    }

    /**
     * Delete pendaftaran
     */
    public function destroy($id)
    {
        try {
            // $pendaftaran = Pendaftaran::findOrFail($id);
            // $pendaftaran->delete();

            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Data pendaftaran berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data pendaftaran: ' . $e->getMessage());
        }
    }
}