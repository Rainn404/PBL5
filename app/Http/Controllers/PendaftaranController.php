<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'nim'    => 'required|string|max:20',
            'prodi'  => 'required|string|max:100',
            'divisi' => 'required|string',
            'foto'   => 'nullable|image|max:2048', // max 2MB
        ]);

        // contoh simpan ke database nanti (sementara dummy)
        // Pendaftaran::create([...]);

        return back()->with('success', 'Pendaftaran berhasil dikirim!');
    }
}
