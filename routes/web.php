<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AnggotaHimaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\MahasiswaBermasalahController;

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

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/index', function () {
    return view('index');
})->name('index');

// Admin Routes Group - HANYA SATU GROUP ADMIN
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Authentication Admin
    Route::prefix('auth')->group(function () {
        Route::get('/login', function () {
            return view('admin.auth.login');
        })->name('login');
        Route::post('/logout', function () {
            return redirect('/admin/login');
        })->name('logout');
    });
    
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

// Fallback route
Route::fallback(function () {
    return redirect('/admin/dashboard');
});