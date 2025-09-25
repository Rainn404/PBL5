<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display berita management page
     */
    public function index()
    {
        // Data dummy untuk sementara
        $berita = [
            [
                'id_berita' => 1,
                'judul' => 'Pembukaan Pendaftaran Anggota Baru HIMA TI 2024',
                'isi' => 'Himpunan Mahasiswa Teknik Informatika membuka pendaftaran anggota baru untuk periode 2024. Pendaftaran dibuka dari tanggal 1 September hingga 15 September 2024.',
                'foto' => 'berita/berita1.jpg',
                'tanggal' => '2024-09-01 10:00:00',
                'penulis' => 'Admin HIMA'
            ],
            [
                'id_berita' => 2,
                'judul' => 'Workshop Web Development Modern',
                'isi' => 'HIMA TI akan mengadakan workshop web development dengan teknologi terkini. Workshop terbuka untuk semua mahasiswa TI.',
                'foto' => null,
                'tanggal' => '2024-09-05 14:30:00',
                'penulis' => 'Ketua HIMA'
            ],
            [
                'id_berita' => 3,
                'judul' => 'Prestasi Mahasiswa TI dalam Kompetisi Nasional',
                'isi' => 'Mahasiswa Teknik Informatika berhasil meraih juara 1 dalam kompetisi programming nasional yang diselenggarakan di Jakarta.',
                'foto' => 'berita/berita3.jpg',
                'tanggal' => '2024-09-10 09:15:00',
                'penulis' => 'Admin HIMA'
            ]
        ];

        return view('admin.berita', compact('berita'));
    }

    /**
     * Store new berita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('berita', 'public');
                $validated['foto'] = $fotoPath;
            }

            // Simpan ke database (gunakan model Berita ketika sudah ada)
            // Berita::create($validated);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update existing berita
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // $berita = Berita::findOrFail($id);

            // Handle file upload
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                // if ($berita->foto) {
                //     Storage::disk('public')->delete($berita->foto);
                // }
                
                $fotoPath = $request->file('foto')->store('berita', 'public');
                $validated['foto'] = $fotoPath;
            }

            // Update berita
            // $berita->update($validated);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete berita
     */
    public function destroy($id)
    {
        try {
            // $berita = Berita::findOrFail($id);
            
            // Hapus foto jika ada
            // if ($berita->foto) {
            //     Storage::disk('public')->delete($berita->foto);
            // }
            
            // $berita->delete();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }
}