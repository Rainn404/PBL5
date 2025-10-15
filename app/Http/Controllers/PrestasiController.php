<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display prestasi management page
     */
    public function index()
    {
        // Data dummy untuk sementara
        $prestasi = [
            [
                'id' => 1,
                'nama' => 'Juara 1 Lomba Programming',
                'mahasiswa' => 'Ahmad Rizki',
                'tingkat' => 'Nasional',
                'juara' => 'Juara 1',
                'tanggal' => '2024-03-15',
                'status' => 'Menunggu Validasi',
                'deskripsi' => 'Kompetisi Nasional IT - Universitas Indonesia'
            ],
            [
                'id' => 2,
                'nama' => 'Juara 2 Debat Bahasa Inggris',
                'mahasiswa' => 'Siti Nurhaliza',
                'tingkat' => 'Regional',
                'juara' => 'Juara 2',
                'tanggal' => '2024-03-10',
                'status' => 'Tervalidasi',
                'deskripsi' => 'Kompetisi Regional - Universitas Gadjah Mada'
            ]
        ];

        return view('admin.prestasi', compact('prestasi'));
    }

    /**
     * Store new prestasi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'mahasiswa' => 'required|string|max:255',
            'tingkat' => 'required|in:Lokal,Regional,Nasional,Internasional',
            'juara' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'status' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak',
            'deskripsi' => 'required|string'
        ]);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diajukan.');
    }

    /**
     * Update existing prestasi
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'mahasiswa' => 'required|string|max:255',
            'tingkat' => 'required|in:Lokal,Regional,Nasional,Internasional',
            'juara' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'status' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak',
            'deskripsi' => 'required|string'
        ]);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Delete prestasi
     */
    public function destroy($id)
    {
        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }
}