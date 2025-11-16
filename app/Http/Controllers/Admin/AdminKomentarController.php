<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class AdminKomentarController extends Controller
{
    public function index()
    {
        $komentars = Komentar::with('berita')->latest()->get();
        return view('admin.komentar.index', compact('komentars'));
    }

    public function destroy($id)
    {
        Komentar::findOrFail($id)->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
