<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PendaftaranController;

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

Route::get('/index', function () {
    return view('index');
});

