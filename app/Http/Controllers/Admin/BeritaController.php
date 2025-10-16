<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $penulisList = Berita::whereNotNull('penulis')
            ->distinct()
            ->pluck('penulis')
            ->toArray();

        return view('admin.berita.index', compact('berita', 'penulisList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'penulis' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $data = $request->only(['judul', 'isi', 'tanggal', 'penulis']);
            
            // Handle file upload
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('berita', 'public');
                $data['foto'] = $fotoPath;
            }

            Berita::create($data);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            return response()->json($berita);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Berita tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'penulis' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $berita = Berita::findOrFail($id);
            $data = $request->only(['judul', 'isi', 'tanggal', 'penulis']);
            
            // Handle file upload
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($berita->foto) {
                    Storage::disk('public')->delete($berita->foto);
                }
                
                $fotoPath = $request->file('foto')->store('berita', 'public');
                $data['foto'] = $fotoPath;
            }

            $berita->update($data);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            
            // Delete photo if exists
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            
            $berita->delete();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}