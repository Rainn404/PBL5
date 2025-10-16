<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Divisi;
use App\Models\AnggotaHima;

class DivisiController extends Controller
{
    // Halaman publik divisi
    public function publicIndex()
    {
        $divisi = Divisi::where('status', 1)
            ->withCount('anggotaHima') // TAMBAHKAN INI
            ->orderBy('nama_divisi')
            ->get();

        return view('divisi', compact('divisi'));
    }

    // Menampilkan detail divisi publik
    public function publicShow(string $id)
    {
        $divisi = Divisi::where('status', 1)
            ->withCount('anggotaHima') // TAMBAHKAN INI
            ->with(['anggotaHima' => function($query) {
                $query->where('status', true)
                      ->with('jabatan');
            }])
            ->find($id);

        if (!$divisi) {
            return redirect()->route('divisi')
                ->with('error', 'Data divisi tidak ditemukan.');
        }

        return view('divisi-detail', compact('divisi'));
    }

    // Menampilkan daftar divisi di admin
    public function index()
    {
        $divisi = Divisi::withCount('anggotaHima') // TAMBAHKAN INI
            ->orderBy('nama_divisi')
            ->get();
            
        return view('admin.divisi', compact('divisi'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('admin.divisi.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_divisi'   => 'required|string|max:255|unique:divisis,nama_divisi',
            'ketua_divisi'  => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'color'         => 'nullable|string|max:7',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi data.');
        }

        Divisi::create([
            'nama_divisi'   => $request->nama_divisi,
            'ketua_divisi'  => $request->ketua_divisi,
            'deskripsi'     => $request->deskripsi,
            'status'        => true,
            'color'         => $request->color ?? '#1a73e8',
        ]);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi baru berhasil ditambahkan!');
    }

    // Menampilkan detail divisi di admin
    public function show(string $id)
    {
        $divisi = Divisi::withCount('anggotaHima') // TAMBAHKAN INI
            ->with(['anggotaHima' => function($query) {
                $query->with('jabatan');
            }])
            ->find($id);

        if (!$divisi) {
            return redirect()->route('admin.divisi.index')
                ->with('error', 'Data divisi tidak ditemukan.');
        }

        return view('admin.divisi.view', compact('divisi'));
    }

    // Menampilkan form edit
    public function edit(string $id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            return redirect()->route('admin.divisi.index')
                ->with('error', 'Data divisi tidak ditemukan.');
        }

        return view('admin.divisi.edit', compact('divisi'));
    }

    // Update data
    public function update(Request $request, string $id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            return redirect()->route('admin.divisi.index')
                ->with('error', 'Data divisi tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'nama_divisi'   => 'required|string|max:255|unique:divisis,nama_divisi,' . $id . ',id_divisi',
            'ketua_divisi'  => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'status'        => 'nullable|boolean',
            'color'         => 'nullable|string|max:7',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        $divisi->update([
            'nama_divisi'   => $request->nama_divisi,
            'ketua_divisi'  => $request->ketua_divisi,
            'deskripsi'     => $request->deskripsi,
            'status'        => $request->status ?? true,
            'color'         => $request->color ?? '#1a73e8',
        ]);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Data divisi berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(string $id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            return redirect()->route('admin.divisi.index')
                ->with('error', 'Data divisi tidak ditemukan.');
        }

        // Cek apakah divisi memiliki anggota
        $jumlahAnggota = $divisi->anggotaHima()->count();
        if ($jumlahAnggota > 0) {
            return redirect()->route('admin.divisi.index')
                ->with('error', 'Tidak dapat menghapus divisi yang masih memiliki anggota. Pindahkan atau hapus anggota terlebih dahulu.');
        }

        $divisi->delete();

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Data divisi berhasil dihapus!');
    }
}