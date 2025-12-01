public function store(Request $request, $id)
{
    $request->validate([
        'isi' => 'required'
    ]);

    \App\Models\Komentar::create([
        'berita_id' => $id,
        'nama' => $request->nama,
        'isi' => $request->isi,
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan!');
}
