@extends('layouts.app_admin')

@section('title', 'Statistik')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Prestasi</h6>
                            <h3>0</h3>
                        </div>
                        <i class="fas fa-trophy fa-3x" style="opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Kehadiran</h6>
                            <h3>0%</h3>
                        </div>
                        <i class="fas fa-chart-pie fa-3x" style="opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Pelanggaran</h6>
                            <h3>0</h3>
                        </div>
                        <i class="fas fa-exclamation-triangle fa-3x" style="opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Status</h6>
                            <h3>Aktif</h3>
                        </div>
                        <i class="fas fa-user-check fa-3x" style="opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-bar me-2"></i>Statistik Detail</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Data statistik sedang dalam pengembangan. Detail statistik Anda akan ditampilkan di sini.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
