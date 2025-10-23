<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaBermasalah;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Sanksi;
use Illuminate\Http\Request;

class MahasiswaBermasalahController extends Controller
{
    public function index()
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::with(['pelanggaran', 'sanksi'])->paginate(10);
        return view('admin.mahasiswa-bermasalah.index', compact('mahasiswaBermasalah'));
    }

    public function create()
    {
        $pelanggaran = Pelanggaran::all();
        $sanksi = Sanksi::all();
        return view('admin.mahasiswa-bermasalah.create', compact('pelanggaran', 'sanksi'));
    }

    public function getMahasiswaByNim($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        
        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return response()->json([
    'nama' => $mahasiswa->nama,
    'semester' => $mahasiswa->semester_aktif, // sesuaikan dengan nama field di database
    'nama_orang_tua' => $mahasiswa->nama_ortu // sesuaikan dengan nama field di database
]);
    }

   public function store(Request $request)
{
    $request->validate([
        'nim' => 'required|exists:mahasiswas,nim',
        'pelanggaran_id' => 'required|exists:pelanggaran,id',
        'sanksi_id' => 'required|exists:sanksi,id',
        'deskripsi' => 'required'
    ]);

    // Ambil data mahasiswa berdasarkan NIM
    $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

    // Cek jika tidak ditemukan (harusnya sudah aman karena ada exists)
    if (!$mahasiswa) {
        return back()->withErrors(['nim' => 'Mahasiswa tidak ditemukan']);
    }

    // Simpan ke tabel mahasiswa_bermasalah
    MahasiswaBermasalah::create([
        'nim' => $mahasiswa->nim,
        'nama' => $mahasiswa->nama, // ambil dari tabel mahasiswa
        'semester' => $mahasiswa->semester_aktif ?? $request->semester, // fallback kalau kolomnya beda
        'nama_orang_tua' => $mahasiswa->nama_ortu ?? $request->nama_orang_tua,
        'pelanggaran_id' => $request->pelanggaran_id,
        'sanksi_id' => $request->sanksi_id,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('admin.mahasiswa-bermasalah.index')
        ->with('success', 'Data mahasiswa bermasalah berhasil ditambahkan');
}

    public function edit($id)
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::findOrFail($id);
        $pelanggaran = Pelanggaran::all();
        $sanksi = Sanksi::all();
        
        return view('admin.mahasiswa-bermasalah.edit', compact('mahasiswaBermasalah', 'pelanggaran', 'sanksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
            'pelanggaran_id' => 'required|exists:pelanggaran,id',
            'sanksi_id' => 'required|exists:sanksi,id',
            'deskripsi' => 'required'
        ]);

        $mahasiswaBermasalah = MahasiswaBermasalah::findOrFail($id);
        $mahasiswaBermasalah->update($request->all());

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::findOrFail($id);
        $mahasiswaBermasalah->delete();

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil dihapus');
    }
}