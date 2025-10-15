<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaBermasalah;
use App\Models\Pelanggaran;
use App\Models\Sanksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // TAMBAHKAN INI

class MahasiswaBermasalahController extends Controller
{
    public function index()
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::with(['pelanggaran', 'sanksi'])->get();
        $pelanggaranList = Pelanggaran::with('sanksi')->get();

        return view('admin.mahasiswa-bermasalah.index', compact('mahasiswaBermasalah', 'pelanggaranList'));
    }


    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'nim' => 'required|string|max:30',
            'semester' => 'nullable|integer|min:1|max:14',
            'nama_orang_tua' => 'nullable|string|max:150',
            'id_masalah' => 'required|exists:pelanggaran,id_masalah',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Dapatkan sanksi otomatis berdasarkan pelanggaran
        $sanksi = Sanksi::where('id_masalah', $request->id_masalah)->first();

        $data = $request->except('bukti');
        $data['id_sanksi'] = $sanksi->id_sanksi;

        // Upload bukti jika ada
        if ($request->hasFile('bukti')) {
            $fileName = time() . '_' . $request->file('bukti')->getClientOriginalName();
            $path = $request->file('bukti')->storeAs('bukti_pelanggaran', $fileName, 'public');
            $data['bukti'] = $path;
        }

        MahasiswaBermasalah::create($data);

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'nim' => 'required|string|max:30',
            'semester' => 'nullable|integer|min:1|max:14',
            'nama_orang_tua' => 'nullable|string|max:150',
            'id_masalah' => 'required|exists:pelanggaran,id_masalah',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $mahasiswa = MahasiswaBermasalah::findOrFail($id);
        $sanksi = Sanksi::where('id_masalah', $request->id_masalah)->first();

        $data = $request->except('bukti');
        $data['id_sanksi'] = $sanksi->id_sanksi;

        if ($request->hasFile('bukti')) {
            // Hapus bukti lama jika ada
            if ($mahasiswa->bukti) {
                Storage::disk('public')->delete($mahasiswa->bukti);
            }
            
            $fileName = time() . '_' . $request->file('bukti')->getClientOriginalName();
            $path = $request->file('bukti')->storeAs('bukti_pelanggaran', $fileName, 'public');
            $data['bukti'] = $path;
        }

        $mahasiswa->update($data);

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mahasiswa = MahasiswaBermasalah::findOrFail($id);
        
        // Hapus file bukti jika ada
        if ($mahasiswa->bukti) {
            Storage::disk('public')->delete($mahasiswa->bukti);
        }
        
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil dihapus');
    }

    public function getSanksi($idMasalah)
    {
        $sanksi = Sanksi::where('id_masalah', $idMasalah)->first();
        
        return response()->json([
            'success' => true,
            'sanksi' => $sanksi
        ]);
    }

    

public function edit($id)
{
    $mahasiswa = MahasiswaBermasalah::with(['pelanggaran', 'sanksi'])->findOrFail($id);

    return response()->json([
        'success' => true,
        'mahasiswa' => $mahasiswa
    ]);
}



    // Method untuk menambah pelanggaran dan sanksi baru
    public function storePelanggaranSanksi(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:150',
            'deskripsi_pelanggaran' => 'nullable|string',
            'nama_sanksi' => 'required|string|max:150',
            'deskripsi_sanksi' => 'nullable|string'
        ]);

        // Simpan pelanggaran
        $pelanggaran = Pelanggaran::create([
            'nama' => $request->nama_pelanggaran,
            'deskripsi' => $request->deskripsi_pelanggaran
        ]);

        // Simpan sanksi yang terkait
        Sanksi::create([
            'id_masalah' => $pelanggaran->id_masalah,
            'nama_sanksi' => $request->nama_sanksi,
            'deskripsi' => $request->deskripsi_sanksi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pelanggaran dan sanksi berhasil ditambahkan',
            'pelanggaran' => $pelanggaran
        ]);

        
    }
}
