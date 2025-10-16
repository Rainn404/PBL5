@extends('layouts.app_admin')

@section('title', $title . ' - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($prestasi))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Prestasi *</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" value="{{ old('nama', $prestasi->nama ?? '') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM *</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                           id="nim" name="nim" value="{{ old('nim', $prestasi->nim ?? '') }}" required>
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori *</label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                                           id="kategori" name="kategori" value="{{ old('kategori', $prestasi->kategori ?? '') }}" required>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="semester" class="form-label">Semester *</label>
                                    <input type="text" class="form-control @error('semester') is-invalid @enderror" 
                                           id="semester" name="semester" value="{{ old('semester', $prestasi->semester ?? '') }}" required>
                                    @error('semester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai *</label>
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                           id="tanggal_mulai" name="tanggal_mulai" 
                                           value="{{ old('tanggal_mulai', isset($prestasi) ? $prestasi->tanggal_mulai->format('Y-m-d') : '') }}" required>
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai *</label>
                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                           id="tanggal_selesai" name="tanggal_selesai" 
                                           value="{{ old('tanggal_selesai', isset($prestasi) ? $prestasi->tanggal_selesai->format('Y-m-d') : '') }}" required>
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $prestasi->email ?? '') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No. HP *</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                           id="no_hp" name="no_hp" value="{{ old('no_hp', $prestasi->no_hp ?? '') }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ipk" class="form-label">IPK</label>
                                    <input type="number" step="0.01" min="0" max="4" 
                                           class="form-control @error('ipk') is-invalid @enderror" 
                                           id="ipk" name="ipk" value="{{ old('ipk', $prestasi->ipk ?? '') }}">
                                    @error('ipk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="Menunggu Validasi" {{ old('status', $prestasi->status ?? '') == 'Menunggu Validasi' ? 'selected' : '' }}>Menunggu Validasi</option>
                                        <option value="Tervalidasi" {{ old('status', $prestasi->status ?? '') == 'Tervalidasi' ? 'selected' : '' }}>Tervalidasi</option>
                                        <option value="Ditolak" {{ old('status', $prestasi->status ?? '') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bukti" class="form-label">Bukti Prestasi</label>
                            <input type="file" class="form-control @error('bukti') is-invalid @enderror" 
                                   id="bukti" name="bukti">
                            @error('bukti')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(isset($prestasi) && $prestasi->bukti)
                                <div class="mt-2">
                                    <small>File saat ini: 
                                        <a href="{{ Storage::url($prestasi->bukti) }}" target="_blank">Lihat Bukti</a>
                                    </small>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Prestasi *</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection