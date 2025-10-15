<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaBermasalahController;
use App\Http\Controllers\PelanggaranSanksiController;

/* =========================
   STATIC PAGES (tetap)
   ========================= */
Route::get('/', function () {
    return view('welcome'); // atau ubah ke tampilan home kamu
})->name('home');
Route::get('/divisi', fn () => view('divisi'));
Route::get('/anggota', fn () => view('anggota'));
// NOTE: HAPUS rute view '/berita' yang lama agar tidak bentrok dengan rute controller
// Route::get('/berita', fn () => view('berita'));
// NOTE: Hapus juga rute view '/pendaftaran' (nanti pakai controller di bawah)
// Route::get('/pendaftaran', fn () => view('pendaftaran'));

Route::get('/login', fn () => view('auth.login'))->name('login');

/* =========================
   ADMIN AREA
   ========================= */
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* ----- Admin: BERITA ----- */
    Route::get('/berita',            [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create',     [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita',           [BeritaController::class, 'store'])->name('berita.store');
Route::get('/berita/{id}', [BeritaController::class, 'adminShow'])->name('berita.show');
    Route::get('/berita/{id}/edit',  [BeritaController::class, 'edit'])->name('berita.edit');
    Route::match(['put','patch'],'/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}',    [BeritaController::class, 'destroy'])->name('berita.destroy');

    /* ----- Admin: PENDAFTARAN (controller) ----- */
    Route::get('/pendaftaran',               [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create',        [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran',              [PendaftaranController::class, 'store'])->name('pendaftaran.store')->middleware('auth');
    Route::get('/pendaftaran/{id}',          [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{id}/edit',     [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{id}',          [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::put('/pendaftaran/{id}/status',   [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    Route::delete('/pendaftaran/{id}',       [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');

    /* ----- Admin: ANGGOTA (controller) ----- */
    Route::get('/anggota',           [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota',          [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{id}',      [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}',   [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    /* ----- Admin: DIVISI (controller) ----- */
    Route::get('/divisi',            [DivisiController::class, 'index'])->name('divisi.index');
    Route::post('/divisi',           [DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/{id}',       [DivisiController::class, 'update'])->name('divisi.update');
    Route::delete('/divisi/{id}',    [DivisiController::class, 'destroy'])->name('divisi.destroy');

    /* ----- Admin: PRESTASI (controller, perbaiki path agar tidak jadi /admin/admin/prestasi) ----- */
    Route::get('/prestasi',          [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::post('/prestasi',         [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::put('/prestasi/{id}',     [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}',  [PrestasiController::class, 'destroy'])->name('prestasi.destroy');

    /* ----- Admin: Mahasiswa Bermasalah & Pelanggaran/Sanksi ----- */
    Route::resource('mahasiswa-bermasalah', MahasiswaBermasalahController::class);
    Route::resource('pelanggaran-sanksi', PelanggaranSanksiController::class);
    Route::post('/pelanggaran-sanksi', [MahasiswaBermasalahController::class, 'storePelanggaranSanksi'])
        ->name('pelanggaran-sanksi.store');
    Route::get('/pelanggaran-sanksi-form', fn () => view('admin.pelanggaran-sanksi'))
        ->name('pelanggaran-sanksi.form');

    /* ----- Admin: Menu berbasis view statis (biarkan, tidak konflik) ----- */
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

    Route::prefix('pelanggaran')->group(function () {
        Route::get('/', fn () => view('admin.pelanggaran.index'))->name('pelanggaran');
        Route::get('/create', fn () => view('admin.pelanggaran.create'))->name('pelanggaran.create');
        Route::get('/edit/{id}', fn ($id) => view('admin.pelanggaran.edit', compact('id')))->name('pelanggaran.edit');
        Route::get('/view/{id}', fn ($id) => view('admin.pelanggaran.view', compact('id')))->name('pelanggaran.view');
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
   PUBLIK: BERITA
   ========================= */
Route::get('/berita',      [BeritaController::class, 'publicIndex'])->name('berita.index');
Route::get('/berita-lainnya', [BeritaController::class, 'lainnya'])->name('berita.lainnya');
Route::get('/berita/{id}', [BeritaController::class, 'publicShow'])->name('berita.show');
Route::post('/berita/{id}/komentar', [BeritaController::class, 'publicCommentStore'])->name('berita.comment.store');

/* =========================
   PUBLIK: PRESTASI (tetap)
   ========================= */
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

/* =========================
   PUBLIK: PENDAFTARAN (index)
   ========================= */
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

/* =========================
   HALAMAN TAMBAHAN (tetap)
   ========================= */
Route::get('/index', fn () => view('index'));
Route::get('/beritaTerkini', fn () => view('beritaTerkini'));
Route::get('/lanjutan', fn () => view('lanjutan'));

/* =========================
   TEST & ROOT/FALLBACK
   ========================= */
Route::get('/test', fn () => 'Aplikasi berjalan!');

Route::redirect('/', '/admin/dashboard');
Route::fallback(fn () => redirect('/admin/dashboard'));

Route::post('/berita/{id}/komentar', [BeritaController::class, 'publicCommentStore'])->name('berita.komentar.store');

// Komentar publik
Route::post('/berita/{id}/komentar', [\App\Http\Controllers\BeritaController::class, 'publicCommentStore'])
    ->name('berita.komentar.store');

Route::put('/berita/{id}/komentar/{komentar}', [\App\Http\Controllers\BeritaController::class, 'publicCommentUpdate'])
    ->name('berita.komentar.update');

Route::delete('/berita/{id}/komentar/{komentar}', [\App\Http\Controllers\BeritaController::class, 'publicCommentDestroy'])
    ->name('berita.komentar.destroy');

use Illuminate\Support\Facades\Auth;

/* =========================
   GLOBAL LOGOUT ROUTE (untuk semua user)
   ========================= */
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'Berhasil logout.');
})->name('logout');

