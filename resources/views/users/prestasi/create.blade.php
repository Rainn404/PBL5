@extends('layouts.app')

@section('title', 'Ajukan Prestasi - HIMA-TI')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-2 text-gray-800">
                        <i class="fas fa-trophy text-primary me-2"></i>
                        Form Pengajuan Prestasi
                    </h1>
                    <p class="text-muted mb-0">Isi form berikut untuk mengajukan prestasi Anda</p>
                </div>
                <a href="{{ route('users.prestasi.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>

            <!-- Progress Steps -->
            <div class="card mb-4">
                <div class="card-body py-3">
                    <div class="steps">
                        <div class="step active">
                            <div class="step-number">1</div>
                            <div class="step-label">Data Diri</div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-label">Prestasi</div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-label">Dokumen</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>
                        Data Prestasi
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-1">Terjadi kesalahan:</h6>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('users.prestasi.store') }}" method="POST" enctype="multipart/form-data" id="prestasiForm">
                        @csrf

                        <!-- Step 1: Data Diri -->
                        <div class="form-step active" data-step="1">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="section-header d-flex align-items-center mb-4">
                                        <span class="step-badge bg-primary text-white rounded-circle me-3">1</span>
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-user me-2"></i>Informasi Pribadi
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" 
                                               value="{{ old('nama', auth()->user()->name ?? '') }}" 
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nim" class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-id-card text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                               id="nim" name="nim" 
                                               value="{{ old('nim', auth()->user()->nim ?? '') }}" 
                                               placeholder="Masukkan NIM" required maxlength="15">
                                        @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               value="{{ old('email', auth()->user()->email ?? '') }}" 
                                               placeholder="nama@contoh.com" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label fw-semibold">No. HP/WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" 
                                               id="no_hp" name="no_hp" 
                                               value="{{ old('no_hp') }}" 
                                               placeholder="08xxxxxxxxxx" required maxlength="15">
                                        @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="semester" class="form-label fw-semibold">Semester Saat Ini <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-graduation-cap text-muted"></i>
                                        </span>
                                        <select class="form-select @error('semester') is-invalid @enderror" 
                                                id="semester" name="semester" required>
                                            <option value="" selected disabled>Pilih semester</option>
                                            @for($i = 1; $i <= 8; $i++)
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
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary next-step" data-next="2">
                                        Lanjut ke Informasi Prestasi <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Informasi Prestasi -->
                        <div class="form-step" data-step="2">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="section-header d-flex align-items-center mb-4">
                                        <span class="step-badge bg-primary text-white rounded-circle me-3">2</span>
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-trophy me-2"></i>Informasi Prestasi
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="nama_prestasi" class="form-label fw-semibold">Nama Prestasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-award text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror" 
                                               id="nama_prestasi" name="nama_prestasi" 
                                               value="{{ old('nama_prestasi') }}" 
                                               placeholder="Masukkan nama prestasi yang diraih" required>
                                        @error('nama_prestasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label fw-semibold">Kategori Prestasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-tags text-muted"></i>
                                        </span>
                                        <select class="form-select @error('kategori') is-invalid @enderror" 
                                                id="kategori" name="kategori" required>
                                            <option value="" selected disabled>Pilih kategori prestasi</option>
                                            <option value="akademik" {{ old('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                            <option value="non-akademik" {{ old('kategori') == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                            <option value="olahraga" {{ old('kategori') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                            <option value="seni" {{ old('kategori') == 'seni' ? 'selected' : '' }}>Seni</option>
                                            <option value="teknologi" {{ old('kategori') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="ipk" class="form-label fw-semibold">IPK (Indeks Prestasi Kumulatif)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-chart-line text-muted"></i>
                                        </span>
                                        <input type="number" step="0.01" min="0" max="4" 
                                               class="form-control @error('ipk') is-invalid @enderror" 
                                               id="ipk" name="ipk" 
                                               value="{{ old('ipk') }}" 
                                               placeholder="Contoh: 3.75">
                                        @error('ipk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Opsional. Kosongkan jika tidak relevan dengan prestasi
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-calendar text-muted"></i>
                                        </span>
                                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                               id="tanggal_mulai" name="tanggal_mulai" 
                                               value="{{ old('tanggal_mulai') }}" required>
                                        @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_selesai" class="form-label fw-semibold">Tanggal Selesai <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-calendar-check text-muted"></i>
                                        </span>
                                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                               id="tanggal_selesai" name="tanggal_selesai" 
                                               value="{{ old('tanggal_selesai') }}" required>
                                        @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi Prestasi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" 
                                              rows="5" 
                                              placeholder="Jelaskan prestasi yang Anda raih secara lengkap, termasuk tingkat kompetisi, pencapaian, penyelenggara, dan detail lainnya" 
                                              required>{{ old('deskripsi') }}</textarea>
                                    <div class="form-text text-muted">
                                        <span id="charCount">0</span>/500 karakter
                                    </div>
                                    @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-primary prev-step" data-prev="1">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Data Diri
                                    </button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-primary next-step" data-next="3">
                                        Lanjut ke Unggah Dokumen <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Dokumen -->
                        <div class="form-step" data-step="3">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="section-header d-flex align-items-center mb-4">
                                        <span class="step-badge bg-primary text-white rounded-circle me-3">3</span>
                                        <h5 class="mb-0 text-primary">
                                            <i class="fas fa-file-upload me-2"></i>Unggah Dokumen
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="bukti_prestasi" class="form-label fw-semibold">Bukti Prestasi <span class="text-danger">*</span></label>
                                    
                                    <div class="file-upload-card border rounded p-4 text-center">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                        <h5 class="mb-2">Klik untuk mengunggah file</h5>
                                        <p class="text-muted mb-3">
                                            Seret file ke sini atau klik untuk memilih
                                        </p>
                                        <div class="file-types mb-3">
                                            <span class="badge bg-light text-dark me-2">PDF</span>
                                            <span class="badge bg-light text-dark me-2">JPG</span>
                                            <span class="badge bg-light text-dark">PNG</span>
                                        </div>
                                        <p class="text-muted small">Maksimal ukuran file: 5MB</p>
                                        <input type="file" class="form-control d-none" 
                                               id="bukti_prestasi" name="bukti_prestasi" 
                                               accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    
                                    <div id="filePreview" class="mt-3 d-none">
                                        <div class="alert alert-success d-flex align-items-center">
                                            <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                                            <div class="flex-grow-1">
                                                <strong>File berhasil diunggah:</strong>
                                                <span id="fileName" class="ms-1"></span>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-danger" id="removeFile">
                                                <i class="fas fa-times me-1"></i>Hapus
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @error('bukti_prestasi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <div class="d-flex">
                                            <i class="fas fa-info-circle mt-1 me-3 fs-5"></i>
                                            <div>
                                                <strong>Informasi Penting</strong>
                                                <p class="mb-0 mt-1">
                                                    Pastikan bukti prestasi yang diunggah jelas dan terbaca. 
                                                    Prestasi akan melalui proses validasi oleh admin sebelum disetujui.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-primary prev-step" data-prev="2">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Prestasi
                                    </button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Ajukan Prestasi
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

<style>
.steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    max-width: 600px;
    margin: 0 auto;
}

.steps::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 3px;
    background: #e9ecef;
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    flex: 1;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-bottom: 0.5rem;
    border: 3px solid white;
}

.step.active .step-number {
    background: #4361ee;
    color: white;
}

.step-label {
    font-weight: 600;
    color: #6c757d;
    font-size: 0.875rem;
}

.step.active .step-label {
    color: #4361ee;
}

.form-step {
    display: none;
}

.form-step.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.step-badge {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.section-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 1rem;
}

.file-upload-card {
    background: #f8f9fa;
    border: 2px dashed #dee2e6 !important;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-upload-card:hover {
    border-color: #4361ee !important;
    background: rgba(67, 97, 238, 0.05);
}

.input-group-text {
    background: #f8f9fa !important;
    border: 1px solid #ced4da !important;
}

.form-control, .form-select {
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #4361ee;
    box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.btn-success {
    background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
    border: none;
}

.btn-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(76, 201, 240, 0.3);
}

.btn-outline-primary {
    border: 2px solid #4361ee;
    color: #4361ee;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #4361ee;
    color: white;
    transform: translateY(-1px);
}

.alert {
    border-radius: 8px;
    border: none;
}

.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

@media (max-width: 768px) {
    .steps {
        flex-direction: column;
        gap: 1rem;
    }
    
    .steps::before {
        display: none;
    }
    
    .step {
        flex-direction: row;
        gap: 1rem;
        width: 100%;
    }
    
    .step-number {
        margin-bottom: 0;
    }
    
    .step-label {
        text-align: left;
    }
    
    .btn {
        padding: 10px 20px;
        font-size: 0.875rem;
    }
    
    .file-upload-card {
        padding: 2rem 1rem !important;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
    }
    
    .step-badge {
        align-self: flex-start;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Multi-step form functionality
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.step');
    let currentStep = 1;

    function showStep(stepNumber) {
        steps.forEach(step => {
            step.classList.remove('active');
            if (parseInt(step.dataset.step) === stepNumber) {
                step.classList.add('active');
            }
        });

        progressSteps.forEach(step => {
            step.classList.remove('active');
            if (parseInt(step.dataset.step) <= stepNumber) {
                step.classList.add('active');
            }
        });

        currentStep = stepNumber;
        
        // Scroll to top of form
        document.querySelector('.card-body').scrollIntoView({ behavior: 'smooth' });
    }

    // Next step buttons
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = parseInt(this.dataset.next);
            if (validateStep(currentStep)) {
                showStep(nextStep);
            }
        });
    });

    // Previous step buttons
    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = parseInt(this.dataset.prev);
            showStep(prevStep);
        });
    });

    // Step validation
    function validateStep(step) {
        const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
        const inputs = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
        
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            // Scroll to first invalid input
            const firstInvalid = currentStepElement.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
            
            // Show error message
            const errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-danger alert-dismissible fade show mb-4';
            errorAlert.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3"></i>
                    <div>Silakan lengkapi semua field yang diperlukan</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            const existingAlert = currentStepElement.querySelector('.alert-danger');
            if (!existingAlert) {
                currentStepElement.prepend(errorAlert);
            }
        }

        return isValid;
    }

    // Character counter for description
    const deskripsi = document.getElementById('deskripsi');
    const charCount = document.getElementById('charCount');
    
    if (deskripsi && charCount) {
        deskripsi.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 500) {
                charCount.classList.add('text-danger');
                this.classList.add('is-invalid');
            } else {
                charCount.classList.remove('text-danger');
                this.classList.remove('is-invalid');
            }
        });
    }

    // File upload functionality
    const fileUploadCard = document.querySelector('.file-upload-card');
    const fileInput = document.getElementById('bukti_prestasi');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const removeFile = document.getElementById('removeFile');

    if (fileUploadCard && fileInput) {
        fileUploadCard.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB');
                    this.value = '';
                    return;
                }

                // Validate file type
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Hanya file PDF, JPG, dan PNG yang diizinkan');
                    this.value = '';
                    return;
                }

                fileName.textContent = file.name;
                filePreview.classList.remove('d-none');
                fileUploadCard.style.display = 'none';
            }
        });
    }

    if (removeFile) {
        removeFile.addEventListener('click', function() {
            fileInput.value = '';
            filePreview.classList.add('d-none');
            fileUploadCard.style.display = 'block';
        });
    }

    // Date validation
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    if (tanggalMulai && tanggalSelesai) {
        tanggalMulai.addEventListener('change', function() {
            if (tanggalSelesai.value && this.value > tanggalSelesai.value) {
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai');
                this.value = '';
            }
        });
        
        tanggalSelesai.addEventListener('change', function() {
            if (tanggalMulai.value && this.value < tanggalMulai.value) {
                alert('Tanggal selesai tidak boleh lebih kecil dari tanggal mulai');
                this.value = '';
            }
        });
    }

    // Auto-format inputs
    const nimInput = document.getElementById('nim');
    if (nimInput) {
        nimInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    const noHpInput = document.getElementById('no_hp');
    if (noHpInput) {
        noHpInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });
    }

    // Form submission
    const prestasiForm = document.getElementById('prestasiForm');
    if (prestasiForm) {
        prestasiForm.addEventListener('submit', function(e) {
            if (!validateStep(currentStep)) {
                e.preventDefault();
                showStep(currentStep);
            }
        });
    }

    // Initialize first step
    showStep(1);
});
</script>
@endsection