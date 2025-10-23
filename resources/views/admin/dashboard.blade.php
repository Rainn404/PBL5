@extends('layouts.admin.app')

@section('title', 'Dashboard - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Dashboard</h1>
            <p class="text-muted">Selamat datang di Sistem Manajemen HIMA</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">
                <i class="fas fa-download me-2"></i>Export
            </button>
            <button class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card h-100 p-4">
                <div class="d-flex align-items-center">
                    <div class="stats-icon primary me-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="h2 fw-bold mb-1">{{ $totalAnggota ?? 0 }}</h3>
                        <p class="text-muted mb-0">Total Anggota</p>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>12% dari bulan lalu
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card h-100 p-4">
                <div class="d-flex align-items-center">
                    <div class="stats-icon success me-3">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="h2 fw-bold mb-1">{{ $totalDivisi ?? 0 }}</h3>
                        <p class="text-muted mb-0">Total Divisi</p>
                        <small class="text-success">
                            <i class="fas fa-plus me-1"></i>1 divisi baru
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card h-100 p-4">
                <div class="d-flex align-items-center">
                    <div class="stats-icon warning me-3">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="h2 fw-bold mb-1">{{ $totalPrestasi ?? 0 }}</h3>
                        <p class="text-muted mb-0">Prestasi Bulan Ini</p>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>25% dari bulan lalu
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card h-100 p-4">
                <div class="d-flex align-items-center">
                    <div class="stats-icon info me-3">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="h2 fw-bold mb-1">{{ $totalBerita ?? 0 }}</h3>
                        <p class="text-muted mb-0">Berita Aktif</p>
                        <small class="text-primary">
                            <i class="fas fa-bell me-1"></i>2 berita terbaru
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Charts -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dashboard-card p-4 h-100">
                <h5 class="fw-bold mb-4">Aktivitas Terbaru</h5>
                <div class="activity-timeline">
                    @foreach($recentActivities as $activity)
                    <div class="activity-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1">{{ $activity['text'] }}</p>
                                <small class="text-muted">{{ $activity['time'] }}</small>
                            </div>
                            <span class="badge bg-{{ $activity['color'] }}">{{ $activity['type'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="dashboard-card p-4 h-100">
                <h5 class="fw-bold mb-4">Statistik Cepat</h5>
                <div class="d-grid gap-3">
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <span>Anggota Aktif</span>
                        <strong class="text-primary">{{ $anggotaAktif ?? 0 }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <span>Prestasi Tervalidasi</span>
                        <strong class="text-success">{{ $prestasiValid ?? 0 }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <span>Pendaftaran Baru</span>
                        <strong class="text-warning">{{ $pendaftaranBaru ?? 0 }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection