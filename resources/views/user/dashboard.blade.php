@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS untuk tema biru */
    .dashboard-header {
        background: linear-gradient(135deg, #007bff, #0056b3); /* Gradien biru */
        color: white;
        padding: 40px 0;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    .card-blue {
        border: 1px solid #007bff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);
        transition: transform 0.3s ease;
    }
    .card-blue:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 123, 255, 0.2);
    }
    .btn-blue {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
    .btn-blue:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .icon-blue {
        color: #007bff;
        font-size: 2rem;
    }
</style>

<div class="container py-5">
    <!-- Header Dashboard dengan Tema Biru -->
    <div class="dashboard-header text-center">
        <h1 class="display-4">Dashboard Anggota</h1>
        <p class="lead">Selamat datang, {{ Auth::user()->name }}! Kelola akun dan aktivitas Anda di sini.</p>
    </div>

    <!-- Grid Kartu untuk Fitur Dashboard -->
    <div class="row g-4">
        <!-- Kartu Profil -->
        <div class="col-md-4">
            <div class="card card-blue h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user icon-blue mb-3"></i>
                    <h5 class="card-title">Profil Saya</h5>
                    <p class="card-text">Lihat dan edit informasi pribadi Anda.</p>
                    <a href="#" class="btn btn-blue">Lihat Profil</a>
                </div>
            </div>
        </div>

        <!-- Kartu Pesan -->
        <div class="col-md-4">
            <div class="card card-blue h-100">
                <div class="card-body text-center">
                    <i class="fas fa-envelope icon-blue mb-3"></i>
                    <h5 class="card-title">Pesan</h5>
                    <p class="card-text">Cek pesan masuk dan kirim pesan baru.</p>
                    <a href="#" class="btn btn-blue">Buka Pesan</a>
                </div>
            </div>
        </div>

        <!-- Kartu Statistik -->
        <div class="col-md-4">
            <div class="card card-blue h-100">
                <div class="card-body text-center">
                    <i class="fas fa-chart-bar icon-blue mb-3"></i>
                    <h5 class="card-title">Statistik</h5>
                    <p class="card-text">Lihat ringkasan aktivitas dan pencapaian Anda.</p>
                    <a href="#" class="btn btn-blue">Lihat Statistik</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Tambahan: Quick Actions -->
    <div class="mt-5">
        <h3 class="text-primary mb-4">Aksi Cepat</h3>
        <div class="d-flex flex-wrap gap-3">
            <a href="#" class="btn btn-outline-primary btn-lg">Update Profil</a>
            <a href="#" class="btn btn-outline-primary btn-lg">Kirim Pesan</a>
            <a href="#" class="btn btn-outline-primary btn-lg">Lihat Laporan</a>
        </div>
    </div>
</div>
@endsection