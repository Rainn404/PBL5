<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaBermasalahController;
use App\Http\Controllers\PelanggaranSanksiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MahasiswaController;

// ========================
// Authentication Routes
// ========================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// ========================
// Public Routes
// ========================
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/home', [IndexController::class, 'index'])->name('home.public');

// Berita (public)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Divisi (public)
Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
Route::get('/divisi/{divisi}', [DivisiController::class, 'show'])->name('divisi.show');

// Anggota (public)
Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');

// ========================
// Pendaftaran Routes (Free User)
// ========================
Route::get('/pendaftaran', [PendaftaranController::class, 'checkPendaftaranStatus'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/status/{id}', [PendaftaranController::class, 'status'])->name('pendaftaran.status');
Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])->name('pendaftaran.success');
Route::get('/pendaftaran/check-status', [PendaftaranController::class, 'showCheckStatus'])->name('pendaftaran.check-status');
Route::post('/pendaftaran/check-status', [PendaftaranController::class, 'checkStatus'])->name('pendaftaran.check-status.post');
Route::get('/pendaftaran/closed', [PendaftaranController::class, 'closed'])->name('pendaftaran.closed');
Route::get('/pendaftaran/quota-full', [PendaftaranController::class, 'quotaFull'])->name('pendaftaran.quota-full');

// ========================
// Protected Routes - Mahasiswa (Setelah login)
// ========================
Route::middleware(['auth'])->group(function () {
    // Dashboard mahasiswa
    Route::get('/dashboard', function () {
        return view('pendaftaran.dashboard');
    })->name('dashboard');
    
    // Prestasi routes untuk users (mahasiswa)
    Route::prefix('users')->name('users.')->group(function () {
        Route::resource('prestasi', PrestasiController::class);
    });
});

// ========================
// Admin Routes - SEMENTARA tanpa middleware admin
// ========================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Anggota Management
    Route::resource('anggota', AnggotaController::class)->except(['show']);
    Route::get('/anggota/view/{id}', [AnggotaController::class, 'show'])->name('anggota.view');
    
    

  // Admin Prestasi Routes
Route::prefix('prestasi')->name('prestasi.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\PrestasiController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Admin\PrestasiController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\Admin\PrestasiController::class, 'store'])->name('store');

    
    Route::put('/bulk-action', [\App\Http\Controllers\Admin\PrestasiController::class, 'bulkAction'])->name('bulk-action');
    
    // Route validasi individual
    Route::put('/{id}/validasi', [\App\Http\Controllers\Admin\PrestasiController::class, 'validasi'])->name('validasi');
    
    // CRUD untuk 1 prestasi
    Route::get('/{id}', [\App\Http\Controllers\Admin\PrestasiController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [\App\Http\Controllers\Admin\PrestasiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [\App\Http\Controllers\Admin\PrestasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\Admin\PrestasiController::class, 'destroy'])->name('destroy');
});


    // Mahasiswa Management
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::post('/mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::get('/mahasiswa/template', [MahasiswaController::class, 'template'])->name('mahasiswa.template');

    // Pendaftaran Management
    Route::resource('pendaftaran', AdminPendaftaranController::class)->except(['create', 'store']);
    Route::post('/pendaftaran/{pendaftaran}/accept', [AdminPendaftaranController::class, 'quickAccept'])->name('pendaftaran.quick-accept');
    Route::post('/pendaftaran/{pendaftaran}/reject', [AdminPendaftaranController::class, 'quickReject'])->name('pendaftaran.quick-reject');
    Route::get('/pendaftaran/export/pdf', [AdminPendaftaranController::class, 'exportPdf'])->name('pendaftaran.export-pdf');
    Route::post('/pendaftaran/{id}/status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftaran.update-status');

    // Pendaftaran System Settings
    Route::get('/pendaftaran-settings', [AdminPendaftaranController::class, 'settings'])->name('pendaftaran-settings');
    Route::post('/pendaftaran/buka-sesi', [AdminPendaftaranController::class, 'bukaSesi'])->name('pendaftaran.buka-sesi');
    Route::post('/pendaftaran/tutup-sesi', [AdminPendaftaranController::class, 'tutupSesi'])->name('pendaftaran.tutup-sesi');
    Route::post('/pendaftaran/update-settings', [AdminPendaftaranController::class, 'updateSettings'])->name('pendaftaran.update-settings');

    // Mahasiswa Bermasalah
    Route::resource('mahasiswa-bermasalah', MahasiswaBermasalahController::class);
    
    // Pelanggaran & Sanksi
    Route::resource('pelanggaran-sanksi', PelanggaranSanksiController::class);
    
    // Divisi Management
    Route::resource('divisi', DivisiController::class);
    
    // Berita Management
    Route::resource('berita', BeritaController::class);
    
    // Data Management
    Route::prefix('data')->group(function () {
        Route::get('/users', function () {
            return view('admin.data.users');
        })->name('data.users');
        Route::get('/auggets', function () {
            return view('admin.data.auggets');
        })->name('data.auggets');
        Route::get('/applets', function () {
            return view('admin.data.applets');
        })->name('data.applets');
        Route::get('/process-files', function () {
            return view('admin.data.process-files');
        })->name('data.process-files');
        Route::get('/scripts', function () {
            return view('admin.data.scripts');
        })->name('data.scripts');
        Route::get('/chat', function () {
            return view('admin.data.chat');
        })->name('data.chat');
    });

});

// ========================
// API Routes
// ========================
Route::prefix('api')->group(function () {
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'showApi'])->name('api.pendaftaran.show');
    Route::get('/statistics', [DashboardController::class, 'getStatistics'])->name('api.statistics');
    Route::get('/pendaftaran-status', [PendaftaranController::class, 'getStatus'])->name('api.pendaftaran-status');
});

// ========================
// Testing & Development Routes
// ========================
Route::get('/test', function () {
    return 'Aplikasi berjalan!';
})->name('test');

// ========================
// Redirect & Fallback
// ========================
Route::redirect('/admin', '/admin/dashboard');
Route::fallback(function () {
    return view('errors.404');
})->name('fallback');





   