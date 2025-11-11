<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\AnggotaHima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index()
    {
        // Ambil semua divisi beserta jumlah anggota
        $divisis = Divisi::withCount('anggotaHima')
            ->orderBy('nama_divisi')
            ->get();

        return view('admin.divisi.index', compact('divisis'));
    }

    public function create()
    {
        // Ambil data anggota untuk dropdown ketua
        $anggota = AnggotaHima::where('status', 1)
            ->orderBy('nama')
            ->get();
            
        return view('admin.divisi.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:100|unique:divisis,nama_divisi',
            'ketua_divisi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            Divisi::create([
                'nama_divisi' => $request->nama_divisi,
                'ketua_divisi' => $request->ketua_divisi,
                'deskripsi' => $request->deskripsi
            ]);

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

    public function show($id)
    {
        $divisi = Divisi::withCount('anggotaHima')->findOrFail($id);
        
        return view('admin.divisi.show', compact('divisi'));
    }

    public function edit($id)
    {
        $divisi = Divisi::findOrFail($id);
        // Ambil data anggota untuk dropdown ketua
        $anggota = AnggotaHima::where('status', 1)
            ->orderBy('nama')
            ->get();
            
        return view('admin.divisi.edit', compact('divisi', 'anggota'));
    }

    public function update(Request $request, $id)
    {
        $divisi = Divisi::findOrFail($id);
        
        $request->validate([
            'nama_divisi' => 'required|string|max:100|unique:divisis,nama_divisi,' . $divisi->id_divisi . ',id_divisi',
            'ketua_divisi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $divisi->update([
                'nama_divisi' => $request->nama_divisi,
                'ketua_divisi' => $request->ketua_divisi,
                'deskripsi' => $request->deskripsi
            ]);

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

    public function destroy($id)
    {
        $divisi = Divisi::findOrFail($id);
        
        try {
            DB::beginTransaction();

            // Cek apakah divisi digunakan oleh anggota
            if ($divisi->anggotaHima()->exists()) {
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