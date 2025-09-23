<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PendaftaranController;


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
});



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


