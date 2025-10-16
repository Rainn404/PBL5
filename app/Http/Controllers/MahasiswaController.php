<?php
// app/Http/Controllers/MahasiswaController.php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // ==================== METHOD UNTUK FRONTEND (PUBLIC) ====================
    
    /**
     * Menampilkan data mahasiswa untuk frontend (hanya baca)
     */
    public function frontIndex(Request $request)
    {
        $search = $request->get('search');
        
        $mahasiswas = Mahasiswa::where('status', 'Aktif')
            ->when($search, function($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);

        return view('mahasiswa.front-index', compact('mahasiswas', 'search'));
    }

    // ==================== METHOD UNTUK ADMIN PANEL ====================
    
    /**
     * Menampilkan data mahasiswa untuk admin (full CRUD)
     */
    public function adminIndex(Request $request)
    {
        $search = $request->get('search');
        
        $mahasiswas = Mahasiswa::when($search, function($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('admin.mahasiswa.index', compact('mahasiswas', 'search'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim|max:20',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        // PERBAIKAN: Gunakan $validated bukan $request->all()
        Mahasiswa::create($validated);

        return redirect()->route('admin.mahasiswa.index')
                        ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function adminShow(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        // PERBAIKAN: Gunakan $validated bukan $request->all()
        $mahasiswa->update($validated);

        return redirect()->route('admin.mahasiswa.index')
                        ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
                        ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}