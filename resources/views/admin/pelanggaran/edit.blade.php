<!-- resources/views/admin/pelanggaran/edit.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Edit Pelanggaran')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pelanggaran</h1>
        <a href="{{ route('admin.pelanggaran.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #e6f2ff;">
                    <h6 class="m-0 font-weight-bold text-center" style="color: #1a73e8;">Form Edit Pelanggaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pelanggaran.update', $pelanggaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Kode Pelanggaran</label>
                                    <input type="text" 
                                           value="{{ $pelanggaran->kode_pelanggaran }}"
                                           disabled
                                           class="form-control bg-light">
                                    <small class="form-text text-muted">
                                        Kode pelanggaran tidak dapat diubah
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nama_pelanggaran" class="font-weight-bold">Nama Pelanggaran *</label>
                                    <input type="text" 
                                           name="nama_pelanggaran" 
                                           id="nama_pelanggaran"
                                           required
                                           placeholder="Masukkan nama pelanggaran"
                                           class="form-control @error('nama_pelanggaran') is-invalid @enderror"
                                           value="{{ old('nama_pelanggaran', $pelanggaran->nama_pelanggaran) }}">
                                    @error('nama_pelanggaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_pelanggaran" class="font-weight-bold">Jenis Pelanggaran *</label>
                                    <select name="jenis_pelanggaran" 
                                            id="jenis_pelanggaran"
                                            required
                                            class="form-control @error('jenis_pelanggaran') is-invalid @enderror">
                                        <option value="ringan" {{ old('jenis_pelanggaran', $pelanggaran->jenis_pelanggaran) == 'ringan' ? 'selected' : '' }}>Ringan</option>
                                        <option value="sedang" {{ old('jenis_pelanggaran', $pelanggaran->jenis_pelanggaran) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                        <option value="berat" {{ old('jenis_pelanggaran', $pelanggaran->jenis_pelanggaran) == 'berat' ? 'selected' : '' }}>Berat</option>
                                    </select>
                                    @error('jenis_pelanggaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.pelanggaran.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Pelanggaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection