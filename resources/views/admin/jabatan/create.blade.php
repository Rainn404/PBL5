@extends('layouts.admin.app')

@section('title', 'Tambah Jabatan Baru')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jabatan Baru</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.jabatan.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jabatan</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.jabatan.store') }}" id="jabatanForm">
                        @csrf
                        
                        <!-- Pilih Level -->
                        <div class="mb-4">
                            <label for="level" class="form-label fw-bold">Pilih Level <span class="text-danger">*</span></label>
                            <select class="form-select form-control @error('level') is-invalid @enderror" 
                                    id="level" name="level" required onchange="updateNamaJabatan()">
                                <option value="">-- Pilih Level Jabatan --</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('level') == $i ? 'selected' : '' }}>
                                        Level {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted mt-1">
                                Pilih level jabatan untuk mengisi otomatis nama jabatan
                            </div>
                        </div>

                        <!-- Nama Jabatan (Auto-filled) -->
                        <div class="mb-4">
                            <label for="nama_jabatan" class="form-label fw-bold">Nama Jabatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" 
                                   id="nama_jabatan" name="nama_jabatan" 
                                   value="{{ old('nama_jabatan') }}" 
                                   maxlength="100" required readonly>
                            @error('nama_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted mt-1">
                                Nama jabatan akan terisi otomatis berdasarkan level yang dipilih
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi Jabatan</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4" 
                                      placeholder="Masukkan deskripsi jabatan...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted mt-1">
                                Deskripsi opsional untuk menjelaskan tugas dan tanggung jawab jabatan
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                       id="status" name="status" value="1" 
                                       {{ old('status', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="status">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-text text-muted mt-1">
                                Jabatan aktif dapat digunakan dalam sistem
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-start gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan
                            </button>
                            <a href="{{ route('admin.jabatan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Informasi Level -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Level Jabatan</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-primary me-2">1</span>
                                <small class="fw-bold">Ketua Himpunan</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-primary me-2">2</span>
                                <small class="fw-bold">Wakil Ketua</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-primary me-2">3</span>
                                <small class="fw-bold">Sekretaris Umum</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-primary me-2">4</span>
                                <small class="fw-bold">Bendahara Umum</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-info me-2">5</span>
                                <small class="fw-bold">Kepala Divisi</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-info me-2">6</span>
                                <small class="fw-bold">Wakil Kepala Divisi</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-success me-2">7</span>
                                <small class="fw-bold">Staf Divisi Senior</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-success me-2">8</span>
                                <small class="fw-bold">Staf Divisi Junior</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-warning me-2">9</span>
                                <small class="fw-bold">Panitia Kegiatan</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="badge bg-secondary me-2">10</span>
                                <small class="fw-bold">Anggota Biasa</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Pilih level untuk mengisi otomatis nama jabatan sesuai struktur organisasi
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Mapping level ke nama jabatan
const levelToJabatan = {
    1: 'Ketua Himpunan',
    2: 'Wakil Ketua',
    3: 'Sekretaris Umum',
    4: 'Bendahara Umum',
    5: 'Kepala Divisi',
    6: 'Wakil Kepala Divisi',
    7: 'Staf Divisi Senior',
    8: 'Staf Divisi Junior',
    9: 'Panitia Kegiatan',
    10: 'Anggota Biasa'
};

function updateNamaJabatan() {
    const levelSelect = document.getElementById('level');
    const namaJabatanInput = document.getElementById('nama_jabatan');
    const selectedLevel = levelSelect.value;
    
    if (selectedLevel && levelToJabatan[selectedLevel]) {
        namaJabatanInput.value = levelToJabatan[selectedLevel];
    } else {
        namaJabatanInput.value = '';
    }
}

// Initialize form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('jabatanForm');
    const levelSelect = document.getElementById('level');
    
    // Jika ada nilai old level, update nama jabatan
    if (levelSelect.value) {
        updateNamaJabatan();
    }
    
    // Validasi form sebelum submit
    form.addEventListener('submit', function(e) {
        const level = levelSelect.value;
        const namaJabatan = document.getElementById('nama_jabatan').value;
        
        if (!level) {
            e.preventDefault();
            alert('Silakan pilih level jabatan');
            levelSelect.focus();
            return false;
        }
        
        if (!namaJabatan) {
            e.preventDefault();
            alert('Nama jabatan harus diisi');
            return false;
        }
    });
});

// Allow manual editing of nama jabatan if needed
document.getElementById('nama_jabatan').addEventListener('dblclick', function() {
    this.readOnly = false;
    this.focus();
    alert('Sekarang Anda dapat mengedit nama jabatan secara manual. Klik di luar untuk mengunci kembali.');
});

document.getElementById('nama_jabatan').addEventListener('blur', function() {
    this.readOnly = true;
});
</script>

<style>
.form-label {
    font-weight: 600;
    color: #495057;
}

.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.list-group-item {
    border: none;
    padding: 0.75rem 0;
}

.badge {
    font-size: 0.7rem;
    min-width: 30px;
}

.form-switch .form-check-input {
    width: 3em;
    height: 1.5em;
}

.form-text {
    font-size: 0.8rem;
}

.btn {
    min-width: 100px;
}
</style>
@endsection