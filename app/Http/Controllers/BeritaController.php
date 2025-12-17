<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Berita;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;


class BeritaController extends Controller
{
    /* =========================================================
     * ADMIN AREA
     * ========================================================= */

    public function index()
    {
        $berita = Berita::orderByDesc('Tanggal_berita')
                        ->orderByDesc('Id_berita')
                        ->get();

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'judul'   => 'required|string|max:200',
        'isi'     => 'required|string',
        'penulis' => 'nullable|string|max:100',
        'tanggal' => 'required|date',
        'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('berita', 'public');
    }

    Berita::create($validated);

    return redirect()
        ->route('admin.berita.index')
        ->with('success', 'Berita berhasil ditambahkan');
}

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    public function adminShow($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:200',
            'isi'          => 'required|string',
            'kategori'     => 'required|string|max:50',
            'penulis' => 'nullable|string|max:100',
            'tanggal'      => 'nullable|date',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('foto')) {
            if (!empty($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $validated['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (!empty($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

public function publicIndex()
{
    $berita = Berita::orderByDesc('tanggal')
        ->orderByDesc('id_berita')
        ->get();

    return view('berita.index', compact('berita'));
}

    public function publicShow($id)
    {
        $berita = Berita::with('komentar')->findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    /* =========================================================
     * KOMENTAR PUBLIK
     * ========================================================= */

   public function publicCommentStore(Request $request, $id)
{
    if (!auth::check()) {
        return redirect()->route('login')
            ->with('error', 'Silakan login untuk menambahkan komentar.');
    }

    $request->validate([
        'isi' => 'required|string|max:2000',
    ]);

    $berita = Berita::findOrFail($id);

    $berita->komentar()->create([
        'nama' => auth()->user()->email,
        'isi'  => $request->isi,
    ]);

    return back()->with('success', 'Komentar berhasil dikirim');
}



public function publicCommentUpdate(Request $request, $id, $komentarId)
{
    if (!auth::check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'isi' => 'required|string|max:2000',
    ]);

    $berita   = Berita::findOrFail($id);
    $komentar = $berita->komentar()->where('id', $komentarId)->firstOrFail();

    $komentar->update([
        'isi' => $request->isi,
    ]);

    return redirect()->to(route('berita.show', $id) . '#komentar')
        ->with('success', 'Komentar berhasil diperbarui.');
}

public function publicCommentDestroy($id, $komentarId)
{
    if (!auth::check()) {
        return redirect()->route('login');
    }

    $berita   = Berita::findOrFail($id);
    $komentar = $berita->komentar()->where('id', $komentarId)->firstOrFail();

    $komentar->delete();

    return redirect()->to(route('berita.show', $id) . '#komentar')
        ->with('success', 'Komentar berhasil dihapus.');
}
}