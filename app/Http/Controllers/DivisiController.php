<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display divisi management page
     */
    public function index()
    {
        // Data dummy untuk sementara
        $divisi = [
            [
                'id' => 1,
                'nama' => 'Divisi IT',
                'deskripsi' => 'Mengelola teknologi informasi dan sistem',
                'ketua' => 'Ahmad Rizki',
                'anggota' => 15
            ],
            [
                'id' => 2,
                'nama' => 'Divisi Humas',
                'deskripsi' => 'Hubungan masyarakat dan komunikasi',
                'ketua' => 'Lisa Putri',
                'anggota' => 12
            ],
            [
                'id' => 3,
                'nama' => 'Divisi Akademik',
                'deskripsi' => 'Bidang akademik dan pembelajaran',
                'ketua' => 'Andi Pratama',
                'anggota' => 18
            ]
        ];

        return view('admin.divisi', compact('divisi'));
    }

    /**
     * Store new divisi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ketua' => 'required|string|max:255'
        ]);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Data divisi berhasil ditambahkan.');
    }

    /**
     * Update existing divisi
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ketua' => 'required|string|max:255'
        ]);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Data divisi berhasil diperbarui.');
    }

    /**
     * Delete divisi
     */
    public function destroy($id)
    {
        return redirect()->route('admin.divisi.index')
            ->with('success', 'Data divisi berhasil dihapus.');
    }
}