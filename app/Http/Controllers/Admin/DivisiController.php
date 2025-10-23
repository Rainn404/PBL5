<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index()
{
    // Ambil semua divisi beserta relasi anggota
    $divisis = Divisi::with('anggotaHima')
        ->orderBy('nama_divisi')
        ->get();

    return view('admin.divisi.index', compact('divisis'));
}


    public function create()
    {
        return view('admin.divisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // sesuaikan dengan kolom di migration
            'nama_divisi' => 'required|string|max:100|unique:divisis,nama_divisi',
            'ketua_divisi' => 'required|string|max:100',
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

    public function show(Divisi $divisi)
    {
        return view('admin.divisi.show', compact('divisi'));
    }

    public function edit(Divisi $divisi)
    {
        return view('admin.divisi.edit', compact('divisi'));
    }

    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:100|unique:divisis,nama_divisi,' . $divisi->id_divisi . ',id_divisi',
            'ketua_divisi' => 'required|string|max:100',
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

    public function destroy(Divisi $divisi)
    {
        try {
            DB::beginTransaction();

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
