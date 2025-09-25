<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display anggota management page
     */
    public function index()
    {
        // Data dummy untuk sementara
        $anggota = [
            [
                'id' => 1,
                'nama' => 'Ahmad Rizki',
                'nim' => '123456789',
                'divisi' => 'IT',
                'jabatan' => 'Ketua',
                'email' => 'ahmad.rizki@example.com',
                'telepon' => '08123456789',
                'alamat' => 'Jl. Contoh No. 123',
                'status' => 'Aktif'
            ],
            [
                'id' => 2,
                'nama' => 'Siti Nurhaliza',
                'nim' => '987654321',
                'divisi' => 'Humas',
                'jabatan' => 'Anggota',
                'email' => 'siti.nurhaliza@example.com',
                'telepon' => '08987654321',
                'alamat' => 'Jl. Contoh No. 456',
                'status' => 'Aktif'
            ],
            [
                'id' => 3,
                'nama' => 'Budi Santoso',
                'nim' => '202012345',
                'divisi' => 'Akademik',
                'jabatan' => 'Sekretaris',
                'email' => 'budi.santoso@example.com',
                'telepon' => '081122334455',
                'alamat' => 'Jl. Contoh No. 789',
                'status' => 'Aktif'
            ]
        ];

        $divisiList = ['IT', 'Humas', 'Akademik', 'Kreatif', 'Olahraga'];

        return view('admin.anggota', compact('anggota', 'divisiList'));
    }

    /**
     * Store new anggota
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'divisi' => 'required|string',
            'jabatan' => 'required|string|max:100',
            'email' => 'required|email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        // Simpan data ke database (akan diimplementasikan nanti)
        // Untuk sementara return success message

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    /**
     * Update existing anggota
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'divisi' => 'required|string',
            'jabatan' => 'required|string|max:100',
            'email' => 'required|email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        // Update data di database (akan diimplementasikan nanti)

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Delete anggota
     */
    public function destroy($id)
    {
        // Hapus data dari database (akan diimplementasikan nanti)

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}