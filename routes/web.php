<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\DivisiController as AdminDivisiController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\AnggotaController as AdminAnggotaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\MahasiswaBermasalahController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\SanksiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AnggotaHimaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\Admin\AdminKomentarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================
// Authentication Routes
// ========================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post'); // ← ini WAJIB ada
Route::post('/logout', function () {
    Auth::logout();
    session()->flush();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'Anda telah logout. Silakan login kembali.');
})->name('logout');
// Public Routes (Frontend)
// ========================
Route::get('/', [IndexController::class, 'index'])->name('home');
// Redirect /home ke /
Route::get('/home', function () {
    return redirect()->route('home');
});

// Berita Routes (Public)
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'publicIndex'])->name('index');
    Route::get('/lainnya', [BeritaController::class, 'lainnya'])->name('lainnya');
    Route::get('/{id}', [BeritaController::class, 'publicShow'])->name('show');
    
    // Komentar Routes
    Route::post('/{id}/komentar', [BeritaController::class, 'publicCommentStore'])->name('komentar.store');
    Route::put('/{id}/komentar/{komentarId}', [BeritaController::class, 'publicCommentUpdate'])->name('komentar.update');
    Route::delete('/{id}/komentar/{komentarId}', [BeritaController::class, 'publicCommentDestroy'])->name('komentar.destroy');
});

// Divisi Routes (Public)
Route::prefix('divisi')->name('divisi.')->group(function () {
    Route::get('/', [DivisiController::class, 'publicIndex'])->name('index');
    Route::get('/{id}', [DivisiController::class, 'publicShow'])->name('show');
});

// Anggota HIMA Routes (Public)
Route::resource('anggota', AnggotaHimaController::class)->only(['index', 'show']);

// Prestasi Routes (Public)
Route::prefix('prestasi')->name('prestasi.')->group(function () {
    Route::get('/', [PrestasiController::class, 'index'])->name('index');
    Route::get('/create', [PrestasiController::class, 'create'])->name('create');
    Route::post('/', [PrestasiController::class, 'store'])->name('store');
    Route::get('/{id}', [PrestasiController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PrestasiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PrestasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [PrestasiController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/validate', [PrestasiController::class, 'validatePrestasi'])->name('validate');
    Route::post('/{id}/reject', [PrestasiController::class, 'rejectPrestasi'])->name('reject');
});

// Pendaftaran Routes (Public)

Route::get('/pendaftaran/closed', [PendaftaranController::class, 'closed'])->name('pendaftaran.closed');
Route::get('/pendaftaran/quota-full', [PendaftaranController::class, 'quotaFull'])->name('pendaftaran.quota-full');
Route::get('/pendaftaran/status/{id}', [PendaftaranController::class, 'status'])->name('pendaftaran.status');
Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])->name('pendaftaran.success');
Route::get('/pendaftaran/check-status', [PendaftaranController::class, 'showCheckStatus'])->name('pendaftaran.check-status');
Route::post('/pendaftaran/check-status', [PendaftaranController::class, 'checkStatus'])->name('pendaftaran.check-status.post');

// Resource route harus di paling bawah
Route::resource('pendaftaran', PendaftaranController::class)->only([
    'index', 'create', 'store', 'show'
]);

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'showApi'])->name('api.pendaftaran.show');
    Route::get('/pendaftaran-status', [PendaftaranController::class, 'getStatus'])->name('api.pendaftaran-status');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
        // Komentar Management (ADMIN)
    Route::middleware(['isadmin'])->group(function () {
        Route::get('komentar', [AdminKomentarController::class, 'index'])
            ->name('komentar.index');

        Route::delete('komentar/{id}', [AdminKomentarController::class, 'destroy'])
            ->name('komentar.destroy');
    });

    // Anggota Management
    Route::resource('anggota', AdminAnggotaController::class);

    // Divisi Management
    Route::resource('divisi', AdminDivisiController::class);
    
    // Jabatan Management
    Route::resource('jabatan', JabatanController::class);
    Route::post('/jabatan/{id}/toggle-status', [JabatanController::class, 'toggleStatus'])->name('jabatan.toggle-status');
    
  // Prestasi Management - ADMIN
Route::prefix('prestasi')->name('prestasi.')->group(function () {

    Route::get('/', [AdminPrestasiController::class, 'index'])->name('index');
    Route::get('/create', [AdminPrestasiController::class, 'create'])->name('create');
    Route::post('/', [AdminPrestasiController::class, 'store'])->name('store');
    Route::get('/{id}', [AdminPrestasiController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AdminPrestasiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminPrestasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminPrestasiController::class, 'destroy'])->name('destroy');
Route::match(['put', 'patch'], '/{id}/validasi', [AdminPrestasiController::class, 'validasi'])->name('validasi');

    Route::post('/bulk-action', [AdminPrestasiController::class, 'bulkAction'])->name('bulk-action');
});

    // Mahasiswa Management
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::post('/mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::get('/mahasiswa/template', [MahasiswaController::class, 'template'])->name('mahasiswa.template');
    
    // Mahasiswa Bermasalah Management
    Route::resource('mahasiswa-bermasalah', MahasiswaBermasalahController::class);
    // TAMBAHKAN ROUTE INI UNTUK MULTIPLE MAHASISWA
    Route::post('/mahasiswa-bermasalah/store-multiple', [MahasiswaBermasalahController::class, 'storeMultiple'])->name('mahasiswa-bermasalah.store-multiple');
    Route::get('/mahasiswa-bermasalah/get-mahasiswa/{nim}', [MahasiswaBermasalahController::class, 'getMahasiswaByNim'])->name('mahasiswa-bermasalah.get-mahasiswa');
    
    
    // Pendaftaran Management
    Route::resource('pendaftaran', AdminPendaftaranController::class);
    Route::post('/pendaftaran/buka-sesi', [AdminPendaftaranController::class, 'bukaSesi'])->name('pendaftaran.buka-sesi');
    Route::post('/pendaftaran/tutup-sesi', [AdminPendaftaranController::class, 'tutupSesi'])->name('pendaftaran.tutup-sesi');
Route::post('/pendaftaran/settings', [AdminPendaftaranController::class, 'updateSettings'])
    ->name('pendaftaran.update-settings');

    Route::post('/pendaftaran/{id}/status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftaran.update-status');
    
    // Berita Management
    Route::resource('berita', AdminBeritaController::class);
  
    // Pelanggaran Management
    Route::resource('pelanggaran', PelanggaranController::class);
    
    // Sanksi Management
    Route::resource('sanksi', SanksiController::class);
    
    // Data & Reports
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('/users', function () { return view('admin.data.users'); })->name('users');
        Route::get('/auggets', function () { return view('admin.data.auggets'); })->name('auggets');
        Route::get('/applets', function () { return view('admin.data.applets'); })->name('applets');
        Route::get('/process-files', function () { return view('admin.data.process-files'); })->name('process-files');
        Route::get('/scripts', function () { return view('admin.data.scripts'); })->name('scripts');
        Route::get('/chat', function () { return view('admin.data.chat'); })->name('chat');
    });
});

// ========================
// User Dashboard (After Login)
// ========================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ========================
// Register
// ========================
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

// ========================
// Redirects & Fallback
// ========================
Route::redirect('/admin', '/admin/dashboard');
Route::fallback(function () {
    return view('errors.404');
});

Route::get('/profil', [UserDashboardController::class, 'profil'])->name('user.profil');

Route::get('/pesan', [UserDashboardController::class, 'pesan'])->name('user.pesan');

Route::get('/statistik', [UserDashboardController::class, 'statistik'])->name('user.statistik');
