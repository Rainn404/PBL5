<?php

use Illuminate\Support\Facades\Route;

Route::get('home/', function () {
    return view('home');
});

Route::get('/divisi', function () {
    return view('divisi');
});

Route::get('/anggota', function () {
    return view('anggota');
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});

Route::get('/prestasi', function () {
    return view('prestasi');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::prefix('admin')->group(function () {
    // Dashboard utama admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Kelola Prestasi
    Route::prefix('prestasi')->group(function () {
        Route::get('/', function () {
            return view('admin.prestasi.index');
        })->name('admin.prestasi');
        Route::get('/create', function () {
            return view('admin.prestasi.create');
        })->name('admin.prestasi.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.prestasi.edit', compact('id'));
        })->name('admin.prestasi.edit');
        Route::get('/validate', function () {
            return view('admin.prestasi.validate');
        })->name('admin.prestasi.validate');
    });
    
    // Kelola Pendaftaran
    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', function () {
            return view('admin.pendaftaran.index');
        })->name('admin.pendaftaran');
        Route::get('/validate', function () {
            return view('admin.pendaftaran.validate');
        })->name('admin.pendaftaran.validate');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.pendaftaran.edit', compact('id'));
        })->name('admin.pendaftaran.edit');
    });
    
    // Kelola Anggota
    Route::prefix('anggota')->group(function () {
        Route::get('/', function () {
            return view('admin.anggota.index');
        })->name('admin.anggota');
        Route::get('/create', function () {
            return view('admin.anggota.create');
        })->name('admin.anggota.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.anggota.edit', compact('id'));
        })->name('admin.anggota.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.anggota.view', compact('id'));
        })->name('admin.anggota.view');
    });
    
    // Kelola Divisi
    Route::prefix('divisi')->group(function () {
        Route::get('/', function () {
            return view('admin.divisi.index');
        })->name('admin.divisi');
        Route::get('/create', function () {
            return view('admin.divisi.create');
        })->name('admin.divisi.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.divisi.edit', compact('id'));
        })->name('admin.divisi.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.divisi.view', compact('id'));
        })->name('admin.divisi.view');
    });
    
    // Kelola Jabatan
    Route::prefix('jabatan')->group(function () {
        Route::get('/', function () {
            return view('admin.jabatan.index');
        })->name('admin.jabatan');
        Route::get('/create', function () {
            return view('admin.jabatan.create');
        })->name('admin.jabatan.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.jabatan.edit', compact('id'));
        })->name('admin.jabatan.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.jabatan.view', compact('id'));
        })->name('admin.jabatan.view');
    });
    
    // Kelola Mahasiswa Bermasalah
    Route::prefix('mahasiswa-bermasalah')->group(function () {
        Route::get('/', function () {
            return view('admin.mahasiswa-bermasalah.index');
        })->name('admin.mahasiswa-bermasalah');
        Route::get('/create', function () {
            return view('admin.mahasiswa-bermasalah.create');
        })->name('admin.mahasiswa-bermasalah.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.mahasiswa-bermasalah.edit', compact('id'));
        })->name('admin.mahasiswa-bermasalah.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.mahasiswa-bermasalah.view', compact('id'));
        })->name('admin.mahasiswa-bermasalah.view');
    });
    
    // Kelola Sanksi
    Route::prefix('sanksi')->group(function () {
        Route::get('/', function () {
            return view('admin.sanksi.index');
        })->name('admin.sanksi');
        Route::get('/create', function () {
            return view('admin.sanksi.create');
        })->name('admin.sanksi.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.sanksi.edit', compact('id'));
        })->name('admin.sanksi.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.sanksi.view', compact('id'));
        })->name('admin.sanksi.view');
    });
    
    // Kelola Pelanggaran
    Route::prefix('pelanggaran')->group(function () {
        Route::get('/', function () {
            return view('admin.pelanggaran.index');
        })->name('admin.pelanggaran');
        Route::get('/create', function () {
            return view('admin.pelanggaran.create');
        })->name('admin.pelanggaran.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.pelanggaran.edit', compact('id'));
        })->name('admin.pelanggaran.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.pelanggaran.view', compact('id'));
        })->name('admin.pelanggaran.view');
    });
    
    // Kelola Berita
    Route::prefix('berita')->group(function () {
        Route::get('/', function () {
            return view('admin.berita.index');
        })->name('admin.berita');
        Route::get('/create', function () {
            return view('admin.berita.create');
        })->name('admin.berita.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.berita.edit', compact('id'));
        })->name('admin.berita.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.berita.view', compact('id'));
        })->name('admin.berita.view');
    });
    
    // Kelola Komentar
    Route::prefix('komentar')->group(function () {
        Route::get('/', function () {
            return view('admin.komentar.index');
        })->name('admin.komentar');
        Route::get('/create', function () {
            return view('admin.komentar.create');
        })->name('admin.komentar.create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.komentar.edit', compact('id'));
        })->name('admin.komentar.edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.komentar.view', compact('id'));
        })->name('admin.komentar.view');
    });
    
    // Authentication Admin
    Route::prefix('auth')->group(function () {
        Route::get('/login', function () {
            return view('admin.auth.login');
        })->name('admin.login');
        Route::post('/logout', function () {
            return redirect('/admin/login');
        })->name('admin.logout');
    });
    
    // Data Management (sesuai dengan dashboard requirements)
    Route::prefix('data')->group(function () {
        Route::get('/users', function () {
            return view('admin.data.users');
        })->name('admin.data.users');
        Route::get('/auggets', function () {
            return view('admin.data.auggets');
        })->name('admin.data.auggets');
        Route::get('/applets', function () {
            return view('admin.data.applets');
        })->name('admin.data.applets');
        Route::get('/process-files', function () {
            return view('admin.data.process-files');
        })->name('admin.data.process-files');
        Route::get('/scripts', function () {
            return view('admin.data.scripts');
        })->name('admin.data.scripts');
        Route::get('/chat', function () {
            return view('admin.data.chat');
        })->name('admin.data.chat');
    });
});

// Redirect root to admin dashboard
Route::redirect('/', '/admin/dashboard');