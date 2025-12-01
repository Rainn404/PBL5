@extends('layouts.admin.app')

@section('title', 'Detail Divisi - Admin HIMA-TI')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Divisi</h1>
        <a href="{{ route('admin.divisi.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Divisi</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- ID Divisi -->
                            <div class="info-item border-bottom pb-3 mb-3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong>ID Divisi</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $divisi->id_divisi }}
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Divisi -->
                            <div class="info-item border-bottom pb-3 mb-3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong>Nama Divisi</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="font-weight-bold text-dark">{{ $divisi->nama_divisi }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Jumlah Anggota -->
                            <div class="info-item border-bottom pb-3 mb-3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong>Jumlah Anggota</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge badge-primary">
                                            {{ $divisi->anggota_hima_count }} Anggota
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div class="info-item border-bottom pb-3 mb-3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong>Tanggal Dibuat</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $divisi->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Terakhir Diupdate -->
                            <div class="info-item">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong>Terakhir Diupdate</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $divisi->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Divisi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Deskripsi Divisi</h6>
                </div>
                <div class="card-body">
                    @if($divisi->deskripsi)
                        <p class="mb-0">{{ $divisi->deskripsi }}</p>
                    @else
                        <p class="text-muted mb-0">Tidak ada deskripsi untuk divisi ini.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.divisi.edit', $divisi->id_divisi) }}" 
                           class="btn btn-warning btn-block mb-2">
                            <i class="fas fa-edit mr-1"></i> Edit Divisi
                        </a>
                        
                        <form action="{{ route('admin.divisi.destroy', $divisi->id_divisi) }}" method="POST" class="d-grid">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block mb-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')">
                                <i class="fas fa-trash mr-1"></i> Hapus Divisi
                            </button>
                        </form>

                        <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-list mr-1"></i> Daftar Divisi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    padding: 8px 0;
}

.border-bottom {
    border-bottom: 1px solid #e3e6f0 !important;
}

.d-grid {
    display: grid;
}
</style>
@endsection