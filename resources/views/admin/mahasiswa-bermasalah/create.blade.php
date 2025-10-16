@extends('layouts.admin.app')

@section('title', 'Tambah Mahasiswa Bermasalah')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Mahasiswa Bermasalah</h1>
        <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mahasiswa Bermasalah</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mahasiswa-bermasalah.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nim" id="nim" class="form-control" required 
                                   placeholder="Masukkan NIM mahasiswa" value="{{ old('nim') }}">
                            <small class="form-text text-muted"></small>
                            <div id="nim-error" class="text-danger small mt-1"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" readonly 
                                   placeholder="Nama akan terisi otomatis" value="{{ old('nama') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <input type="number" name="semester" id="semester" class="form-control" min="1" max="14" 
                                   placeholder="Masukkan semester" value="{{ old('semester') }}" required>
                            <small class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_orang_tua" class="form-label">Nama Orang Tua <span class="text-danger">*</span></label>
                            <input type="text" name="nama_orang_tua" id="nama_orang_tua" class="form-control" 
                                   placeholder="Masukkan nama orang tua" value="{{ old('nama_orang_tua') }}" required>
                            <small class="form-text text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pelanggaran_id" class="form-label">Pelanggaran <span class="text-danger">*</span></label>
                            <select name="pelanggaran_id" id="pelanggaran_id" class="form-control" required>
                                <option value="">-- Pilih Pelanggaran --</option>
                                @foreach ($pelanggaran as $p)
                                    <option value="{{ $p->id }}" {{ old('pelanggaran_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama_pelanggaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sanksi_id" class="form-label">Sanksi <span class="text-danger">*</span></label>
                            <select name="sanksi_id" id="sanksi_id" class="form-control" required>
                                <option value="">-- Pilih Sanksi --</option>
                                @foreach ($sanksi as $s)
                                    <option value="{{ $s->id }}" {{ old('sanksi_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->nama_sanksi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" 
                              placeholder="Masukkan deskripsi lengkap mengenai masalah yang terjadi..." required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nimInput = document.getElementById('nim');
    const namaInput = document.getElementById('nama');
    const nimError = document.getElementById('nim-error');

    nimInput.addEventListener('input', function() {
        const nim = this.value.trim();
        
        // Clear previous data
        namaInput.value = '';
        nimError.textContent = '';
        
        if (nim.length >= 8) {
            // Show loading state
            nimError.textContent = 'Mencari data mahasiswa...';
            
            console.log('Mencari NIM:', nim);
            
            fetch(/admin/mahasiswa-bermasalah/get-mahasiswa/${nim})
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Mahasiswa tidak ditemukan');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    
                    // Hanya isi nama saja (semester dan orang tua diisi manual)
                    namaInput.value = data.nama || '';
                    nimError.textContent = '';
                    
                    console.log('Nama terisi:', data.nama);
                    
                    // Enable form submission
                    document.querySelector('form').querySelector('button[type="submit"]').disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    nimError.textContent = error.message;
                    // Disable form submission if student not found
                    document.querySelector('form').querySelector('button[type="submit"]').disabled = true;
                });
        } else if (nim.length > 0) {
            nimError.textContent = 'NIM harus minimal 8 karakter';
        }
    });

    // Validate form before submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const nim = nimInput.value.trim();
        const nama = namaInput.value.trim();
        const semester = document.getElementById('semester').value.trim();
        const namaOrangTua = document.getElementById('nama_orang_tua').value.trim();
        const pelanggaran = document.getElementById('pelanggaran_id').value;
        const sanksi = document.getElementById('sanksi_id').value;
        const deskripsi = document.getElementById('deskripsi').value.trim();
        
        if (!nim || !nama) {
            e.preventDefault();
            alert('Harap isi NIM dan pastikan data mahasiswa ditemukan');
            return;
        }
        
        if (!semester || !namaOrangTua || !pelanggaran || !sanksi || !deskripsi) {
            e.preventDefault();
            alert('Harap lengkapi semua field yang wajib diisi');
            return;
        }
    });
});
</script>
@endsection