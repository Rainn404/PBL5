@extends('layouts.app')

@section('content')
<style>
/* ====== GLOBAL ====== */
.dashboard-container {
    padding: 30px 0;
    background: #f5f8ff;
}

/* ====== HERO MINI ====== */
.dashboard-hero {
    background: linear-gradient(90deg, #1d8cf8, #007bff);
    color: #fff;
    padding: 32px;
    border-radius: 16px;
    text-align: center;
    margin-bottom: 40px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.12);
}

/* ====== GRID MENU ====== */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
}

/* ====== CARD ====== */
.menu-card {
    background: #fff;
    border-radius: 14px;
    padding: 28px 20px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.25s ease;
}

.menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 18px rgba(0,0,0,0.12);
}

.menu-icon {
    font-size: 42px;
    color: #1d8cf8;
    margin-bottom: 15px;
}

.menu-card h4 {
    font-size: 1.1rem;
    font-weight: 700;
}

.menu-card p {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 18px;
}

/* BUTTON */
.menu-btn {
    display: inline-block;
    background: #1d8cf8;
    color: white;
    padding: 8px 18px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.25s;
}

.menu-btn:hover {
    background: #007bff;
    color: white;
}

/* ===== BUTTON EDLINK ===== */
.btn-edlink {
    display: inline-block;
    margin-top: 35px;
    background: #097e18;
    color: #fff;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 10px;
    font-size: 1rem;
    text-decoration: none;
    transition: 0.25s ease;
    box-shadow: 0 4px 12px rgba(15, 122, 229, 0.25);
}

.btn-edlink:hover {
    background: #0b5fc0;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(15, 122, 229, 0.35);
}
</style>

<div class="dashboard-container container">

    <!-- HERO MINI -->
    <div class="dashboard-hero">
        <h3>Dashboard Anggota</h3>
        <p>Halo, {{ auth()->user()->nim }} {{ auth()->user()->name }}! Selamat datang kembali.</p>
    </div>

    <!-- MENU GRID -->
    <div class="dashboard-grid">

        <!-- PROFIL -->
        <div class="menu-card">
            <div class="menu-icon">🧑</div>
            <h4>Profil Saya</h4>
            <p>Kelola dan edit informasi pribadi Anda.</p>
            <a href="#" class="menu-btn">Lihat Profil</a>
        </div>

        <!-- PESAN -->
        <div class="menu-card">
            <div class="menu-icon">✉️</div>
            <h4>Pesan</h4>
            <p>Cek inbox dan kirim pesan baru.</p>
            <a href="#" class="menu-btn">Buka Pesan</a>
        </div>

        <!-- STATISTIK -->
        <div class="menu-card">
            <div class="menu-icon">📊</div>
            <h4>Statistik</h4>
            <p>Lihat rangkuman aktivitas dan pencapaian Anda.</p>
            <a href="#" class="menu-btn">Lihat Statistik</a>
        </div>

    </div> <!-- END GRID -->

    <!-- ===== BUTTON EDLINK (CENTERED) ===== -->
    <div class="text-center">
        <a href="https://edlink.id/login" target="_blank" class="btn-edlink">
            📘 Buka EdLink
        </a>
    </div>

</div>
@endsection
