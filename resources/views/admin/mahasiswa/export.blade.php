@extends('layouts.admin.app')

@section('title', 'Export Data Mahasiswa - HIMA-TI')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Export Data Mahasiswa</h1>
        <a href="{{ route('admin.mahasiswa.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-file-export me-2"></i>Pilihan Export
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Export Semua Data -->
                        <div class="col-md-4 mb-4">
                            <div class="card border-left-success h-100">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-database fa-3x text-success mb-3"></i>
                                        <h5 class="font-weight-bold text-success">Semua Data</h5>
                                        <p class="text-muted">Export seluruh data mahasiswa</p>
                                        <a href="{{ route('admin.mahasiswa.export') }}" class="btn btn-success">
                                            <i class="fas fa-download me-2"></i>Export Semua
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Export Mahasiswa Aktif -->
                        <div class="col-md-4 mb-4">
                            <div class="card border-left-primary h-100">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-user-check fa-3x text-primary mb-3"></i>
                                        <h5 class="font-weight-bold text-primary">Mahasiswa Aktif</h5>
                                        <p class="text-muted">Export data mahasiswa aktif saja</p>
                                        <a href="{{ route('admin.mahasiswa.export', ['status' => 'Aktif']) }}" class="btn btn-primary">
                                            <i class="fas fa-download me-2"></i>Export Aktif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Export Mahasiswa Tidak Aktif -->
                        <div class="col-md-4 mb-4">
                            <div class="card border-left-warning h-100">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-user-times fa-3x text-warning mb-3"></i>
                                        <h5 class="font-weight-bold text-warning">Mahasiswa Tidak Aktif</h5>
                                        <p class="text-muted">Export data mahasiswa tidak aktif</p>
                                        <a href="{{ route('admin.mahasiswa.export', ['status' => 'Tidak Aktif']) }}" class="btn btn-warning">
                                            <i class="fas fa-download me-2"></i>Export Tidak Aktif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-1 text-center">
                            <i class="fas fa-info-circle fa-2x text-info"></i>
                        </div>
                        <div class="col-md-11">
                            <div class="text-info font-weight-bold mb-2">
                                Informasi Export
                            </div>
                            <div class="text-gray-800">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="mb-2"><i class="fas fa-file-excel text-success me-2"></i>Format file: Excel (.xlsx)</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-2"><i class="fas fa-columns text-primary me-2"></i>Data terstruktur dengan kolom lengkap</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-2"><i class="fas fa-clock text-warning me-2"></i>Nama file include timestamp</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 0.5rem;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.border-left-success {
    border-left: 4px solid #1cc88a !important;
}

.border-left-primary {
    border-left: 4px solid #4e73df !important;
}

.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}

.btn {
    border-radius: 0.35rem;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
}

.fa-3x {
    font-size: 3em;
}
</style>
@endsection