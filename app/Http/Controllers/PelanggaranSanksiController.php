<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use App\Models\Sanksi;
use Illuminate\Http\Request;

class PelanggaranSanksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'deskripsi_pelanggaran' => 'nullable|string',
            'nama_sanksi' => 'required|string|max:255',
            'deskripsi_sanksi' => 'nullable|string'
        ]);

        try {
            // Buat pelanggaran terlebih dahulu (tanpa sanksi dulu)
            $pelanggaran = Pelanggaran::create([
                'nama' => $request->nama_pelanggaran,
                'deskripsi' => $request->deskripsi_pelanggaran
            ]);

            // Buat sanksi dengan relasi ke pelanggaran
            Sanksi::create([
                'id_masalah' => $pelanggaran->id_masalah,
                'nama_sanksi' => $request->nama_sanksi,
                'deskripsi' => $request->deskripsi_sanksi
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pelanggaran dan sanksi berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}