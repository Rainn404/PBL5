<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaHima;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = AnggotaHima::with(['divisi', 'jabatan', 'user'])->get();
        $divisi = Divisi::orderBy('nama_divisi')->get();
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();

        return view('admin.anggota', compact('anggota', 'divisi', 'jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:anggota_hima,nim',
            'id_divisi' => 'required|exists:divisis,id_divisi',
            'id_jabatan' => 'required|exists:jabatans,id_jabatan',
            'semester' => 'required|integer|min:1|max:14',
            'status' => 'required|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_anggota', 'public');
        }

        AnggotaHima::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'id_divisi' => $request->id_divisi,
            'id_jabatan' => $request->id_jabatan,
            'semester' => $request->semester,
            'status' => $request->status,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:anggota_hima,nim,' . $id . ',id_anggota_hima',
            'id_divisi' => 'required|exists:divisis,id_divisi',
            'id_jabatan' => 'required|exists:jabatans,id_jabatan',
            'semester' => 'required|integer|min:1|max:14',
            'status' => 'required|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $anggota = AnggotaHima::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $anggota->foto = $request->file('foto')->store('foto_anggota', 'public');
        }

        $anggota->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'id_divisi' => $request->id_divisi,
            'id_jabatan' => $request->id_jabatan,
            'semester' => $request->semester,
            'status' => $request->status,
            'foto' => $anggota->foto,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // ✅ Tambahkan method destroy di bawah ini
    public function destroy($id)
    {
        $anggota = AnggotaHima::findOrFail($id);

        // Hapus foto dari storage jika ada
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
