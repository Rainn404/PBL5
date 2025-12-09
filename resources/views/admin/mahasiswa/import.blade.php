@extends('layouts.admin.app')

@section('title', 'Import Data Mahasiswa - Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Data Mahasiswa</h1>
        <a href="{{ route('admin.mahasiswa.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #e6f2ff;">
                    <h6 class="m-0 font-weight-bold text-center" style="color: #1a73e8;">Import Data Mahasiswa dari Excel</h6>
                </div>
                <div class="card-body">
                    <!-- Info Alert -->
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong> Pastikan file Excel yang diupload sesuai dengan format template yang tersedia.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <!-- Template Download -->
                    <div class="mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Template Excel
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            Download template untuk format yang benar
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.mahasiswa.template') }}" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-download"></i>
                                            </span>
                                            <span class="text">Download Template</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <form action="{{ route('admin.mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <label for="file" class="form-label fw-bold text-gray-700 mb-3">
                                    Pilih File Excel <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="file"
                                    id="file"
                                    name="file"
                                    class="form-control form-control-lg @error('file') is-invalid @enderror"
                                    accept=".xlsx,.xls"
                                    required
                                >
                                <div class="form-text">
                                    Format file yang didukung: .xlsx atau .xls (Maksimal 2MB)
                                </div>
                                @error('file')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="my-5">

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-lg btn-secondary px-5">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-lg btn-success px-5">
                                <i class="fas fa-upload me-2"></i>Import Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-1 text-center">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        </div>
                        <div class="col-md-11">
                            <div class="text-warning font-weight-bold mb-2">
                                Instruksi Import Data
                            </div>
                            <div class="text-gray-800">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-2"><i class="fas fa-check text-warning me-2"></i>Download template Excel terlebih dahulu</p>
                                        <p class="mb-2"><i class="fas fa-check text-warning me-2"></i>Isi data mahasiswa sesuai kolom yang tersedia</p>
                                        <p class="mb-2"><i class="fas fa-check text-warning me-2"></i>Pastikan NIM unik dan tidak duplikat</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2"><i class="fas fa-check text-warning me-2"></i>Angkatan dalam format tahun (contoh: 2021)</p>
                                        <p class="mb-2"><i class="fas fa-check text-warning me-2"></i>Status: Aktif, Tidak Aktif, atau Cuti</p>
                                        <p class="mb-2"><i class="fas fa-check text-warning me-2"></i>Data yang sudah ada akan diupdate jika NIM sama</p>
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
    border: 1px solid #e3e6f0;
    border-radius: 0.5rem;
}

.card-body {
    padding: 2.5rem;
}

.form-control-lg {
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border: 2px solid #e3e6f0;
    border-radius: 0.5rem;
    transition: all 0.3s;
    width: 100%;
}

.form-control-lg:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.form-label {
    font-size: 1rem;
    color: #4a5568;
    display: block;
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-weight: 600;
    border-radius: 0.5rem;
    min-width: 120px;
}

.btn-success {
    background-color: #1cc88a;
    border-color: #1cc88a;
}

.btn-success:hover {
    background-color: #17a673;
    border-color: #17a673;
}

.btn-secondary {
    background-color: #858796;
    border-color: #858796;
}

.btn-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-info {
    background-color: #36b9cc;
    border-color: #36b9cc;
}

.btn-info:hover {
    background-color: #2c9faf;
    border-color: #2c9faf;
}

hr {
    border: 0;
    border-top: 2px solid #e3e6f0;
    opacity: 1;
}

.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}

.border-left-info {
    border-left: 4px solid #36b9cc !important;
}

.alert {
    border-radius: 0.5rem;
    border: none;
}

.btn-icon-split {
    padding: 0.375rem 0.75rem;
    position: relative;
    display: inline-block;
}

.btn-icon-split .icon {
    position: relative;
    width: 2rem;
    height: 2rem;
    display: inline-block;
    padding: 0.375rem;
    border-radius: 0.25rem 0 0 0.25rem;
    background-color: rgba(0, 0, 0, 0.15);
}

.btn-icon-split .text {
    padding: 0.375rem 0.75rem;
    display: inline-block;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .btn-lg {
        padding: 0.6rem 1.5rem;
        min-width: 100px;
    }

    .btn-icon-split {
        padding: 0.25rem 0.5rem;
    }

    .btn-icon-split .text {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file');

    // File validation
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (2MB max)
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            if (file.size > maxSize) {
                alert('Ukuran file maksimal 2MB!');
                this.value = '';
                return;
            }

            // Check file extension
            const allowedExtensions = ['xlsx', 'xls'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                alert('Format file harus .xlsx atau .xls!');
                this.value = '';
                return;
            }
        }
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const fileInput = document.getElementById('file');

        if (!fileInput.files[0]) {
            e.preventDefault();
            alert('Harap pilih file Excel terlebih dahulu!');
            return;
        }

        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengimport...';
        submitBtn.disabled = true;

        // Re-enable button after 30 seconds (in case of error)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 30000);
    });
});
</script>

@endsection
