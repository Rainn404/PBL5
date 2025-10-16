<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\DashboardController;
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AnggotaHimaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\MahasiswaBermasalahController;

<<<<<<< HEAD
// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Public Routes untuk Divisi
Route::get('/divisi', [DivisiController::class, 'publicIndex'])->name('divisi');
Route::get('/divisi/{id}', [DivisiController::class, 'publicShow'])->name('divisi.show');

// Public Routes untuk Anggota
Route::get('/anggota', [AnggotaHimaController::class, 'publicIndex'])->name('anggota.public');
Route::get('/anggota/{id}', [AnggotaHimaController::class, 'publicShow'])->name('anggota.public.show');

// Public Routes untuk Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Pendaftaran Public Routes
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Public Routes untuk Prestasi
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');
=======
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaBermasalahController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\SanksiController;
/* =========================
   STATIC PAGES (tetap)
   ========================= */

// NOTE: Hapus route view '/berita' agar tidak bentrok dengan controller di bagian PUBLIK
Route::get('/home', fn () => view('home'));
Route::get('/divisi', fn () => view('divisi'));
Route::get('/anggota', fn () => view('anggota'));
Route::get('/pendaftaran', fn () => view('pendaftaran'));
Route::get('/login', fn () => view('auth.login'))->name('login');

// Root diarahkan ke dashboard admin
Route::redirect('/', '/admin/dashboard');

/* =========================
   ADMIN AREA (pakai CONTROLLER)
   ========================= */
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* ----- Admin: BERITA ----- */
    Route::get('/berita',            [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create',     [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita',           [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}',       [BeritaController::class, 'adminShow'])->name('berita.show');
    Route::get('/berita/{id}/edit',  [BeritaController::class, 'edit'])->name('berita.edit');
    Route::match(['put','patch'],'/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}',    [BeritaController::class, 'destroy'])->name('berita.destroy');

    /* ----- Admin: PENDAFTARAN ----- */
    Route::get('/pendaftaran',               [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create',        [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran',              [PendaftaranController::class, 'store'])->name('pendaftaran.store')->middleware('auth');
    Route::get('/pendaftaran/{id}',          [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{id}/edit',     [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{id}',          [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::put('/pendaftaran/{id}/status',   [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    Route::delete('/pendaftaran/{id}',       [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');

    /* ----- Admin: ANGGOTA ----- */
    Route::get('/anggota',           [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota',          [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{id}',      [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}',   [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    /* ----- Admin: DIVISI ----- */
    Route::get('/divisi',            [DivisiController::class, 'index'])->name('divisi.index');
    Route::post('/divisi',           [DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/{id}',       [DivisiController::class, 'update'])->name('divisi.update');
    Route::delete('/divisi/{id}',    [DivisiController::class, 'destroy'])->name('divisi.destroy');

    /* ----- Admin: PRESTASI ----- */
    Route::get('/prestasi',          [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::post('/prestasi',         [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::put('/prestasi/{id}',     [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}',  [PrestasiController::class, 'destroy'])->name('prestasi.destroy');


    /* ----- Admin: Menu view statis (tidak bentrok URI controller) ----- */
    Route::prefix('komentar')->group(function () {
        Route::get('/', fn () => view('admin.komentar.index'))->name('komentar');
        Route::get('/create', fn () => view('admin.komentar.create'))->name('komentar.create');
        Route::get('/edit/{id}', fn ($id) => view('admin.komentar.edit', compact('id')))->name('komentar.edit');
        Route::get('/view/{id}', fn ($id) => view('admin.komentar.view', compact('id')))->name('komentar.view');
    });

    Route::prefix('jabatan')->group(function () {
        Route::get('/', fn () => view('admin.jabatan.index'))->name('jabatan');
        Route::get('/create', fn () => view('admin.jabatan.create'))->name('jabatan.create');
        Route::get('/edit/{id}', fn ($id) => view('admin.jabatan.edit', compact('id')))->name('jabatan.edit');
        Route::get('/view/{id}', fn ($id) => view('admin.jabatan.view', compact('id')))->name('jabatan.view');
    });

    Route::prefix('sanksi')->group(function () {
        Route::get('/', fn () => view('admin.sanksi.index'))->name('sanksi');
        Route::get('/create', fn () => view('admin.sanksi.create'))->name('sanksi.create');
        Route::get('/edit/{id}', fn ($id) => view('admin.sanksi.edit', compact('id')))->name('sanksi.edit');
        Route::get('/view/{id}', fn ($id) => view('admin.sanksi.view', compact('id')))->name('sanksi.view');
    });

   Route::controller(PelanggaranController::class)->group(function () {
    Route::get('/pelanggaran', 'index')->name('pelanggaran.index');
    Route::get('/pelanggaran/create', 'create')->name('pelanggaran.create');
    Route::post('/pelanggaran', 'store')->name('pelanggaran.store');
    Route::get('/pelanggaran/{id}/edit', 'edit')->name('pelanggaran.edit');
    Route::put('/pelanggaran/{id}', 'update')->name('pelanggaran.update');
    Route::delete('/pelanggaran/{id}', 'destroy')->name('pelanggaran.destroy');
});

    /* ----- Admin: Data & Auth (view) ----- */
    Route::prefix('auth')->group(function () {
        Route::get('/login', fn () => view('admin.auth.login'))->name('login');
        Route::post('/logout', fn () => redirect('/admin/login'))->name('logout');
    });

    Route::prefix('data')->group(function () {
        Route::get('/users', fn () => view('admin.data.users'))->name('data.users');
        Route::get('/auggets', fn () => view('admin.data.auggets'))->name('data.auggets');
        Route::get('/applets', fn () => view('admin.data.applets'))->name('data.applets');
        Route::get('/process-files', fn () => view('admin.data.process-files'))->name('data.process-files');
        Route::get('/scripts', fn () => view('admin.data.scripts'))->name('data.scripts');
        Route::get('/chat', fn () => view('admin.data.chat'))->name('data.chat');
    });
});

/* =========================
   PUBLIK: BERITA (Controller)
   ========================= */
Route::get('/berita',              [BeritaController::class, 'publicIndex'])->name('berita.index');
Route::get('/berita-lainnya',      [BeritaController::class, 'lainnya'])->name('berita.lainnya');
Route::get('/berita/{id}',         [BeritaController::class, 'publicShow'])->name('berita.show');
Route::post('/berita/{id}/komentar', [BeritaController::class, 'publicCommentStore'])->name('berita.komentar.store');
Route::put('/berita/{id}/komentar/{komentar}', [BeritaController::class, 'publicCommentUpdate'])->name('berita.komentar.update');
Route::delete('/berita/{id}/komentar/{komentar}', [BeritaController::class, 'publicCommentDestroy'])->name('berita.komentar.destroy');

/* =========================
   PUBLIK: PRESTASI (Controller)
   ========================= */
Route::get('/prestasi',                [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/create',         [PrestasiController::class, 'create'])->name('prestasi.create')->middleware('auth');
Route::post('/prestasi',               [PrestasiController::class, 'store'])->name('prestasi.store')->middleware('auth');
Route::get('/prestasi/{id}',           [PrestasiController::class, 'show'])->name('prestasi.show');
Route::get('/prestasi/{id}/edit',      [PrestasiController::class, 'edit'])->name('prestasi.edit')->middleware('auth');
Route::put('/prestasi/{id}',           [PrestasiController::class, 'update'])->name('prestasi.update')->middleware('auth');
Route::delete('/prestasi/{id}',        [PrestasiController::class, 'destroy'])->name('prestasi.destroy')->middleware('auth');
Route::post('/prestasi/{id}/validate', [PrestasiController::class, 'validatePrestasi'])->name('prestasi.validate')->middleware('auth');
Route::post('/prestasi/{id}/reject',   [PrestasiController::class, 'rejectPrestasi'])->name('prestasi.reject')->middleware('auth');
Route::get('/prestasi/validasi',       [PrestasiController::class, 'validasiIndex'])->name('prestasi.validasi')->middleware('auth');

/* =========================
   HALAMAN TAMBAHAN (tetap)
   ========================= */
Route::get('/index', fn () => view('index'));
Route::get('/beritaTerkini', fn () => view('beritaTerkini'));
Route::get('/lanjutan', fn () => view('lanjutan'));

/* =========================
   AUTH LOGOUT
   ========================= */
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'Berhasil logout.');
})->name('logout');


Route::get('/test', fn () => 'Aplikasi berjalan!');
Route::fallback(fn () => redirect('/admin/dashboard'));


// ==================== ROUTE FRONTEND (PUBLIC) ====================
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/divisi', function () {
    return view('divisi');
})->name('divisi');

Route::get('/anggota', function () {
    return view('anggota');
})->name('anggota');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/prestasi', function () {
    return view('prestasi');
})->name('prestasi');
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

<<<<<<< HEAD
Route::get('/index', function () {
    return view('index');
})->name('index');

// Admin Routes Group - HANYA SATU GROUP ADMIN
=======
// Route Data Mahasiswa untuk FRONTEND (hanya baca)
Route::get('/mahasiswa', [MahasiswaController::class, 'frontIndex'])->name('mahasiswa.index');

// ==================== ROUTE ADMIN PANEL ====================
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
<<<<<<< HEAD
=======

    
    // ========== TAMBAHKAN ROUTE MAHASISWA BERMASALAH DI SINI ==========
    // Mahasiswa Bermasalah Management
 
    Route::controller(MahasiswaBermasalahController::class)->group(function () {
        Route::get('/mahasiswa-bermasalah', 'index')->name('mahasiswa-bermasalah.index');
        Route::get('/mahasiswa-bermasalah/create', 'create')->name('mahasiswa-bermasalah.create');
        Route::post('/mahasiswa-bermasalah', 'store')->name('admin.mahasiswa-bermasalah.store');
        Route::get('/mahasiswa-bermasalah/{id}/edit', 'edit')->name('mahasiswa-bermasalah.edit');
        Route::put('/mahasiswa-bermasalah/{id}', 'update')->name('mahasiswa-bermasalah.update');
        Route::delete('/mahasiswa-bermasalah/{id}', 'destroy')->name('mahasiswa-bermasalah.destroy');
        Route::get('/mahasiswa-bermasalah/get-mahasiswa/{nim}', 'getMahasiswaByNim')->name('mahasiswa-bermasalah.get-mahasiswa');
    });

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
    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    

    
    // Berita Management
    Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('berita.index');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    
    // Pendaftaran Management
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::put('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154
    // Authentication Admin
    Route::prefix('auth')->group(function () {
        Route::get('/login', function () {
            return view('admin.auth.login');
        })->name('login');
        Route::post('/logout', function () {
            return redirect('/admin/login');
        })->name('logout');
    });
<<<<<<< HEAD
    
    // Anggota Management - PERBAIKI INI
    Route::prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', [AnggotaHimaController::class, 'index'])->name('index');
        Route::get('/create', [AnggotaHimaController::class, 'create'])->name('create');
        Route::post('/', [AnggotaHimaController::class, 'store'])->name('store');
        Route::get('/{id}', [AnggotaHimaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AnggotaHimaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AnggotaHimaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AnggotaHimaController::class, 'destroy'])->name('destroy');
    });
    
    // Divisi Management
    Route::prefix('divisi')->name('divisi.')->group(function () {
        Route::get('/', [DivisiController::class, 'index'])->name('index');
        Route::get('/create', [DivisiController::class, 'create'])->name('create');
        Route::post('/', [DivisiController::class, 'store'])->name('store');
        Route::get('/{id}', [DivisiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [DivisiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DivisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [DivisiController::class, 'destroy'])->name('destroy');
    });
    
    // Jabatan Management
    Route::prefix('jabatan')->name('jabatan.')->group(function () {
        Route::get('/', [JabatanController::class, 'index'])->name('index');
        Route::get('/create', [JabatanController::class, 'create'])->name('create');
        Route::post('/', [JabatanController::class, 'store'])->name('store');
        Route::get('/{id}', [JabatanController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [JabatanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [JabatanController::class, 'update'])->name('update');
        Route::delete('/{id}', [JabatanController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle-status', [JabatanController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Prestasi Management - PERBAIKI INI
    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [PrestasiController::class, 'index'])->name('index');
        Route::get('/create', [PrestasiController::class, 'create'])->name('create');
        Route::post('/', [PrestasiController::class, 'store'])->name('store');
        Route::get('/{id}', [PrestasiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PrestasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PrestasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [PrestasiController::class, 'destroy'])->name('destroy');
        Route::get('/validasi', [PrestasiController::class, 'validasiIndex'])->name('validasi');
        Route::post('/{id}/validate', [PrestasiController::class, 'validatePrestasi'])->name('validate.submit');
        Route::post('/{id}/reject', [PrestasiController::class, 'rejectPrestasi'])->name('reject');
    });
    
    // Pendaftaran Management
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/', [PendaftaranController::class, 'index'])->name('index');
        Route::get('/create', [PendaftaranController::class, 'create'])->name('create');
        Route::post('/', [PendaftaranController::class, 'store'])->name('store');
        Route::get('/{id}', [PendaftaranController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PendaftaranController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PendaftaranController::class, 'update'])->name('update');
        Route::put('/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{id}', [PendaftaranController::class, 'destroy'])->name('destroy');
    });
    
    // Berita Management - PERBAIKI INI
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/', [BeritaController::class, 'store'])->name('store');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('destroy');
    });
    
    // Mahasiswa Bermasalah Management - PERBAIKI INI
    Route::prefix('mahasiswa-bermasalah')->name('mahasiswa-bermasalah.')->group(function () {
        Route::get('/', [MahasiswaBermasalahController::class, 'index'])->name('index');
        Route::get('/create', [MahasiswaBermasalahController::class, 'create'])->name('create');
        Route::post('/', [MahasiswaBermasalahController::class, 'store'])->name('store');
        Route::get('/{id}', [MahasiswaBermasalahController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MahasiswaBermasalahController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MahasiswaBermasalahController::class, 'update'])->name('update');
        Route::delete('/{id}', [MahasiswaBermasalahController::class, 'destroy'])->name('destroy');
    });
    
    // Sanksi Management (Static Pages)
    Route::prefix('sanksi')->name('sanksi.')->group(function () {
        Route::get('/', function () {
            return view('admin.sanksi.index');
        })->name('index');
        Route::get('/create', function () {
            return view('admin.sanksi.create');
        })->name('create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.sanksi.edit', compact('id'));
        })->name('edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.sanksi.view', compact('id'));
        })->name('view');
    });
    
    // Pelanggaran Management (Static Pages)
    Route::prefix('pelanggaran')->name('pelanggaran.')->group(function () {
        Route::get('/', function () {
            return view('admin.pelanggaran.index');
        })->name('index');
        Route::get('/create', function () {
            return view('admin.pelanggaran.create');
        })->name('create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.pelanggaran.edit', compact('id'));
        })->name('edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.pelanggaran.view', compact('id'));
        })->name('view');
    });
    
    // Pelanggaran & Sanksi Management
    Route::prefix('pelanggaran-sanksi')->name('pelanggaran-sanksi.')->group(function () {
        Route::get('/', function() {
            return view('admin.pelanggaran-sanksi');
        })->name('form');
        Route::post('/', [MahasiswaBermasalahController::class, 'storePelanggaranSanksi'])
            ->name('store');
    });
    
    // Komentar Management (Static Pages)
    Route::prefix('komentar')->name('komentar.')->group(function () {
        Route::get('/', function () {
            return view('admin.komentar.index');
        })->name('index');
        Route::get('/create', function () {
            return view('admin.komentar.create');
        })->name('create');
        Route::get('/edit/{id}', function ($id) {
            return view('admin.komentar.edit', compact('id'));
        })->name('edit');
        Route::get('/view/{id}', function ($id) {
            return view('admin.komentar.view', compact('id'));
        })->name('view');
    });
    
    // Data Management (Static Pages)
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('/users', function () {
            return view('admin.data.users');
        })->name('users');
        Route::get('/auggets', function () {
            return view('admin.data.auggets');
        })->name('auggets');
        Route::get('/applets', function () {
            return view('admin.data.applets');
        })->name('applets');
        Route::get('/process-files', function () {
            return view('admin.data.process-files');
        })->name('process-files');
        Route::get('/scripts', function () {
            return view('admin.data.scripts');
        })->name('scripts');
        Route::get('/chat', function () {
            return view('admin.data.chat');
        })->name('chat');
    });
});

// Prestasi Auth Routes (jika masih diperlukan)
Route::middleware('auth')->group(function () {
    Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});

// Test route
Route::get('/test', function () {
    return 'Aplikasi berjalan!';
});
=======
});

// Prestasi Routes (public)
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create')->middleware('auth');
Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store')->middleware('auth');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');
Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit')->middleware('auth');
Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update')->middleware('auth');
Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy')->middleware('auth');

// Redirect root to admin dashboard
Route::redirect('/', '/admin/dashboard');
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154

// Fallback route
Route::fallback(function () {
    return redirect('/admin/dashboard');
<<<<<<< HEAD
});
=======
});

>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154
