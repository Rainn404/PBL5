<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PendaftaranController;

// Halaman awal
Route::get('/', function () {
    return view('welcome'); 
});

// Route pendaftaran
Route::get('/index', [IndexController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
