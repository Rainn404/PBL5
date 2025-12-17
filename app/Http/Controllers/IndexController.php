<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class IndexController extends Controller
{
    public function index()
    {
        $beritaQuery = Berita::orderByDesc('tanggal')
            ->orderByDesc('id_berita');

        // 4 berita total (1 besar + 3 kecil)
        $berita = $beritaQuery->take(4)->get();

        return view('index', compact('berita'));
    }
}
