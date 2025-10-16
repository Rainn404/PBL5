<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisis = Divisi::orderBy('nama')->get();
        return view('admin.divisi.index', compact('divisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:divisi,nama',
            'deskripsi' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            Divisi::create($request->all());

            DB::commit();

            return redirect()->route('admin.divisi.index')
                ->with('success', 'Divisi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        return view('admin.divisi.show', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisi $divisi)
    {
        return view('admin.divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:divisi,nama,' . $divisi->id_divisi . ',id_divisi',
            'deskripsi' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $divisi->update($request->all());

            DB::commit();

            return redirect()->route('admin.divisi.index')
                ->with('success', 'Divisi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi)
    {
        try {
            DB::beginTransaction();

            // Cek apakah divisi digunakan di tabel anggota_hima
            $usedInAnggota = DB::table('anggota_hima')->where('id_divisi', $divisi->id_divisi)->exists();
            
            if ($usedInAnggota) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus divisi karena masih digunakan oleh anggota.');
            }

            $divisi->delete();

            DB::commit();

            return redirect()->route('admin.divisi.index')
                ->with('success', 'Divisi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}