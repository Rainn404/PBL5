@extends('layouts.app_admin')

@section('title', 'Tambah Pendaftaran - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Tambah Pendaftaran</h1>
            <p class="text-muted">Tambah data pendaftaran anggota baru</p>
        </div>
        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                   id="nim" name="nim" value="{{ old('nim') }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select class="form-select @error('semester') is-invalid @enderror" 
                                    id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                   id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alasan_mendaftar" class="form-label">Alasan Mendaftar <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alasan_mendaftar') is-invalid @enderror" 
                              id="alasan_mendaftar" name="alasan_mendaftar" rows="4" required>{{ old('alasan_mendaftar') }}</textarea>
                    @error('alasan_mendaftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dokumen" class="form-label">Dokumen Pendaftaran</label>
                    <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                           id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="form-text">Format: PDF, JPG, JPEG, PNG (Max: 2MB)</div>
                    @error('dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Judul Berita</label>
        <input type="text" name="judul_berita" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Isi Berita</label>
        <textarea name="isi_berita" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Berita</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
