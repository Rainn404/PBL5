<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DivisiController;


Route::get('/home', function () {
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

})->name('login');


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



use App\Http\Controllers\PrestasiController;

// Prestasi Routes
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create')->middleware('auth');
Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store')->middleware('auth');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');
Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit')->middleware('auth');
Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update')->middleware('auth');
Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy')->middleware('auth');
Route::post('/prestasi/{id}/validate', [PrestasiController::class, 'validatePrestasi'])->name('prestasi.validate')->middleware('auth');
Route::post('/prestasi/{id}/reject', [PrestasiController::class, 'rejectPrestasi'])->name('prestasi.reject')->middleware('auth');
Route::get('/prestasi/validasi', [PrestasiController::class, 'validasiIndex'])->name('prestasi.validasi')->middleware('auth');

Route::get('/index', function () {
    return view('index');
});




use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;


// Route untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Anggota Management
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    
    // Divisi Management
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
    Route::post('/divisi', [DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/{id}', [DivisiController::class, 'update'])->name('divisi.update');
    Route::delete('/divisi/{id}', [DivisiController::class, 'destroy'])->name('divisi.destroy');
    
});

// Redirect root to admin dashboard
Route::redirect('/', '/admin/dashboard');

// Fallback route
Route::fallback(function () {
    return redirect('/admin/dashboard');
});



use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\MahasiswaBermasalahController;
use App\Http\Controllers\PelanggaranSanksiController;


// Route untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Anggota Management
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    
    // Divisi Management
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
    Route::post('/divisi', [DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/{id}', [DivisiController::class, 'update'])->name('divisi.update');
    Route::delete('/divisi/{id}', [DivisiController::class, 'destroy'])->name('divisi.destroy');
    
    // Prestasi Management
    Route::get('admin/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::post('admin/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::put('admin/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('admin/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    
    // Mahasiswa Bermasalah Management
    
    Route::resource('mahasiswa-bermasalah', MahasiswaBermasalahController::class);
    Route::resource('pelanggaran-sanksi', PelanggaranSanksiController::class);
});



// Redirect root to admin dashboard
Route::redirect('/', '/admin/dashboard');

// Fallback route
Route::fallback(function () {
    return redirect('/admin/dashboard');
});

//berita cuy


Route::prefix('admin')->group(function () {
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});
Route::prefix('admin')->group(function () {
    // Route untuk menyimpan pelanggaran dan sanksi baru
    Route::post('/pelanggaran-sanksi', [MahasiswaBermasalahController::class, 'storePelanggaranSanksi'])
        ->name('admin.pelanggaran-sanksi.store');
        
});

Route::get('/admin/pelanggaran-sanksi', function() {
    return view('admin.pelanggaran-sanksi');
})->name('admin.pelanggaran-sanksi.form');






// Routes untuk Pendaftaran
Route::prefix('admin')->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('admin.pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('admin.pendaftaran.store');
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
    Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('admin.pendaftaran.edit');
    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('admin.pendaftaran.update');
    Route::put('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('admin.pendaftaran.updateStatus');
    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('admin.pendaftaran.destroy');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
    ->middleware('auth')
    ->name('admin.pendaftaran.store');

});

// Route untuk test
Route::get('/test', function () {
    return 'Aplikasi berjalan!';
});