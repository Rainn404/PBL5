@extends('layouts.admin.app')

@section('title', 'Tambah Divisi - Admin HIMA-TI')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Divisi</h1>
        <a href="{{ route('admin.divisi.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Divisi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.divisi.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Divisi -->
                        <div class="form-group">
                            <label for="nama_divisi" class="font-weight-bold">Nama Divisi *</label>
                            <input type="text" class="form-control @error('nama_divisi') is-invalid @enderror" 
                                   id="nama_divisi" name="nama_divisi" 
                                   value="{{ old('nama_divisi') }}" 
                                   placeholder="Masukkan nama divisi" required>
                            @error('nama_divisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ketua Divisi -->
                        <div class="form-group">
                            <label for="ketua_divisi" class="font-weight-bold">Ketua Divisi *</label>
                            <input type="text" class="form-control @error('ketua_divisi') is-invalid @enderror" 
                                   id="ketua_divisi" name="ketua_divisi" 
                                   value="{{ old('ketua_divisi') }}" 
                                   placeholder="Masukkan nama ketua divisi" required>
                            @error('ketua_divisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi" class="font-weight-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" 
                                      rows="4" placeholder="Masukkan deskripsi divisi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <!-- Buttons -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                            <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i> 
                        Field yang ditandai dengan (*) wajib diisi.
                    </small>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-lightbulb mr-1"></i> 
                        Pastikan nama divisi belum pernah digunakan sebelumnya.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection