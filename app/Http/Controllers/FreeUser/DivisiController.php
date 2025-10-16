<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        // Ambil data divisi dengan jumlah anggota dan data anggota
        $divisis = Divisi::withCount('anggotas')
            ->with(['anggotas' => function($query) {
                $query->select('id_anggota_hima', 'nama', 'id_divisi')
                      ->where('status', true);
            }])
            ->where('status', true)
            ->orderBy('nama_divisi')
            ->get();

        return view('divisi.index', compact('divisis'));
    }

    public function show($id)
    {
        $divisi = Divisi::with(['anggotas' => function($query) {
                $query->where('status', true)
                      ->with('jabatan');
            }])
            ->withCount('anggotas')
            ->findOrFail($id);

        return view('divisi.show', compact('divisi'));
    }
}