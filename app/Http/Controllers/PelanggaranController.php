<?php
// app/Http/Controllers/PelanggaranController.php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggaran::orderBy('created_at', 'desc');
        
        // Filter berdasarkan jenis pelanggaran
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_pelanggaran', $request->jenis);
        }
        
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_pelanggaran', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_pelanggaran', 'like', '%' . $request->search . '%');
            });
        }
        
        $pelanggaran = $query->paginate(10);
        
        return view('admin.pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        return view('admin.pelanggaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'jenis_pelanggaran' => 'required|in:ringan,sedang,berat'
        ]);

        // Generate kode pelanggaran otomatis
        $lastPelanggaran = Pelanggaran::orderBy('id', 'desc')->first();
        $nextId = $lastPelanggaran ? $lastPelanggaran->id + 1 : 1;
        $kodePelanggaran = 'PLG' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Pelanggaran::create([
            'kode_pelanggaran' => $kodePelanggaran,
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'jenis_pelanggaran' => $request->jenis_pelanggaran
        ]);

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    public function edit(Pelanggaran $pelanggaran)
    {
        return view('admin.pelanggaran.edit', compact('pelanggaran'));
    }

    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'jenis_pelanggaran' => 'required|in:ringan,sedang,berat'
        ]);

        $pelanggaran->update([
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'jenis_pelanggaran' => $request->jenis_pelanggaran
        ]);

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}