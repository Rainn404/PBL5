<?php
// app/Http/Controllers/SanksiController.php

namespace App\Http\Controllers;

use App\Models\Sanksi;
use Illuminate\Http\Request;

class SanksiController extends Controller
{
    public function index()
    {
        // GANTI: get() menjadi paginate()
        $sanksi = Sanksi::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.sanksi.index', compact('sanksi'));
    }

    public function create()
    {
        return view('admin.sanksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sanksi' => 'required',
            'jenis_sanksi' => 'required|in:ringan,sedang,berat'
        ]);

        // Generate auto ID sanksi
        $lastSanksi = Sanksi::orderBy('id', 'desc')->first();
        $nextId = $lastSanksi ? $lastSanksi->id + 1 : 1;
        $idSanksi = 'S' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        // Ensure unique id_sanksi
        while (Sanksi::where('id_sanksi', $idSanksi)->exists()) {
            $nextId++;
            $idSanksi = 'S' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        }

        Sanksi::create([
            'id_sanksi' => $idSanksi,
            'nama_sanksi' => $request->nama_sanksi,
            'jenis_sanksi' => $request->jenis_sanksi,
        ]);

        return redirect()->route('admin.sanksi.index')
            ->with('success', 'Data sanksi berhasil ditambahkan.');
    }

    public function edit(Sanksi $sanksi)
    {
        return view('admin.sanksi.edit', compact('sanksi'));
    }

    public function update(Request $request, Sanksi $sanksi)
    {
        $request->validate([
            'id_sanksi' => 'required|unique:sanksi,id_sanksi,' . $sanksi->id,
            'nama_sanksi' => 'required',
            'jenis_sanksi' => 'required|in:ringan,sedang,berat'
        ]);

        $sanksi->update($request->all());

        return redirect()->route('admin.sanksi.index')
            ->with('success', 'Data sanksi berhasil diperbarui.');
    }

    public function destroy(Sanksi $sanksi)
    {
        $sanksi->delete();

        return redirect()->route('admin.sanksi.index')
            ->with('success', 'Data sanksi berhasil dihapus.');
    }
}