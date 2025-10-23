<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $mahasiswa = Mahasiswa::when($search, function($query) use ($search) {
            return $query->where('nim', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('prodi', 'like', "%{$search}%");
        })
        ->orderBy('nama')
        ->paginate(10);

        return view('admin.mahasiswa.index', compact('mahasiswa', 'search'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'prodi' => 'nullable|string|max:100',
            'angkatan' => 'nullable|string|max:4',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'status' => 'required|in:Aktif,Non-Aktif,Cuti'
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
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
            'nim' => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'prodi' => 'nullable|string|max:100',
            'angkatan' => 'nullable|string|max:4',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'status' => 'required|in:Aktif,Non-Aktif,Cuti'
        ]);

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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new MahasiswaImport, $request->file('file'));
            
            return redirect()->route('admin.mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diimport dari Excel.');
        } catch (\Exception $e) {
            return redirect()->route('admin.mahasiswa.index')
                ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport, 'data-mahasiswa-' . date('Y-m-d') . '.xlsx');
    }

    public function template()
    {
        return Excel::download(new MahasiswaExport(true), 'template-import-mahasiswa.xlsx');
    }
}