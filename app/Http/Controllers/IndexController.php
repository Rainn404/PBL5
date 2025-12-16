<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class IndexController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru, urut berdasarkan tanggal lalu id (aman kalau tanggal null)
        $beritaQuery = Berita::orderByDesc('tanggal')
            ->orderByDesc('id_berita');

        // 5 berita untuk slider atas
        $beritaSlider = (clone $beritaQuery)
            ->take(5)
            ->get();

        // 2 berita pelengkap di bawah
        $beritaBawah = (clone $beritaQuery)
            ->skip(5)
            ->take(2)
            ->get();

        return view('index', [
            'beritaSlider' => $beritaSlider,
            'beritaBawah'  => $beritaBawah,
        ]);
    }
}
