<?php

namespace App\Http\Controllers;

use App\Models\AnggotaHima;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class AnggotaHimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $anggota = AnggotaHima::with(['divisi', 'jabatan'])->get();
    $divisiList = Divisi::pluck('nama_divisi'); // ambil nama divisi dari tabel Divisi
    return view('anggota', compact('anggota', 'divisiList'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisis = Divisi::all();
        $jabatans = Jabatan::all();
        return view('anggota.create', compact('divisis', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:anggota_hima,nim',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'semester' => 'required|integer|min:1|max:14',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $fotoName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images/anggota'), $fotoName);
            $data['foto'] = $fotoName;
        }

        $data['status'] = $request->has('status');

        AnggotaHima::create($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggotaHima $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaHima $anggota)
    {
        $divisis = Divisi::all();
        $jabatans = Jabatan::all();
        return view('anggota.edit', compact('anggota', 'divisis', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaHima $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:anggota_hima,nim,'.$anggota->id_anggota_hima.',id_anggota_hima',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'semester' => 'required|integer|min:1|max:14',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($anggota->foto && file_exists(public_path('images/anggota/'.$anggota->foto))) {
                unlink(public_path('images/anggota/'.$anggota->foto));
            }

            $fotoName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images/anggota'), $fotoName);
            $data['foto'] = $fotoName;
        }

        $data['status'] = $request->has('status');

        $anggota->update($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaHima $anggota)
    {
        // Delete photo if exists
        if ($anggota->foto && file_exists(public_path('images/anggota/'.$anggota->foto))) {
            unlink(public_path('images/anggota/'.$anggota->foto));
        }

        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}