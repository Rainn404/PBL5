@extends('layouts.admin.app')

@section('title', 'Kelola Jabatan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h3 mb-0 text-gray-800">Data Jabatan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.jabatan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>
                Tambah Jabatan
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Data Jabatan dalam Tabel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Jabatan</h6>
            <div class="text-muted small">
                Total: {{ $jabatans->count() }} Jabatan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Jabatan</th>
                            <th width="10%">Level</th>
                            <th width="35%">Deskripsi</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jabatans as $index => $jabatan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $jabatan->nama_jabatan }}</strong>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">Level {{ $jabatan->level }}</span>
                            </td>
                            <td>
                                <p class="mb-0 text-muted small">
                                    {{ $jabatan->deskripsi ?: 'Tidak ada deskripsi' }}
                                </p>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $jabatan->status ? 'bg-success' : 'bg-warning' }}">
                                    {{ $jabatan->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.jabatan.edit', $jabatan->id_jabatan) }}" 
                                       class="btn btn-warning btn-sm" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Jabatan">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.jabatan.toggle-status', $jabatan->id_jabatan) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn {{ $jabatan->status ? 'btn-secondary' : 'btn-success' }} btn-sm"
                                                data-bs-toggle="tooltip" 
                                                title="{{ $jabatan->status ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas {{ $jabatan->status ? 'fa-pause' : 'fa-play' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.jabatan.destroy', $jabatan->id_jabatan) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')"
                                                data-bs-toggle="tooltip" 
                                                title="Hapus Jabatan">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-user-tie fa-3x mb-3"></i>
                                    <h5>Belum ada data jabatan</h5>
                                    <p>Mulai dengan menambahkan jabatan pertama Anda</p>
                                    <a href="{{ route('admin.jabatan.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i>Tambah Jabatan
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Contoh Data Default (jika diperlukan) -->
    @if($jabatans->isEmpty())
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contoh Struktur Jabatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Jabatan</th>
                            <th width="10%">Level</th>
                            <th width="35%">Deskripsi</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td><strong>Ketua HIMA</strong></td>
                            <td class="text-center"><span class="badge bg-info">Level 4</span></td>
                            <td>
                                <p class="mb-0 text-muted small">
                                    Memimpin organisasi HIMA dan bertanggung jawab atas semua kegiatan serta koordinasi antar divisi.
                                </p>
                            </td>
                            <td class="text-center"><span class="badge bg-success">Aktif</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-warning btn-sm" disabled>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td><strong>Wakil Ketua</strong></td>
                            <td class="text-center"><span class="badge bg-info">Level 3</span></td>
                            <td>
                                <p class="mb-0 text-muted small">
                                    Membantu ketua dalam menjalankan tugas dan menggantikan ketua ketika berhalangan.
                                </p>
                            </td>
                            <td class="text-center"><span class="badge bg-success">Aktif</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-warning btn-sm" disabled>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td><strong>Sekretaris</strong></td>
                            <td class="text-center"><span class="badge bg-info">Level 3</span></td>
                            <td>
                                <p class="mb-0 text-muted small">
                                    Bertanggung jawab atas administrasi, dokumentasi, dan korespondensi organisasi.
                                </p>
                            </td>
                            <td class="text-center"><span class="badge bg-success">Aktif</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-warning btn-sm" disabled>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.table th {
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    border-bottom: 2px solid #e3e6f0;
}

.table td {
    vertical-align: middle;
    font-size: 0.9rem;
}

.btn-group .btn {
    border-radius: 0.25rem;
    margin: 0 2px;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
</style>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>
@endsection