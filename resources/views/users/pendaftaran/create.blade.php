@extends('layouts.app')

@section('title', 'Form Pendaftaran - HIMA-TI')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Form Pendaftaran Anggota HIMA-TI</h1>
        <p>Isi form berikut dengan data yang benar dan lengkap</p>
    </div>
</section>

<!-- Registration Form -->
<section class="registration-section">
    <div class="container">
        <div class="registration-card">
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> 
                    Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                </div>
            @endif

            <!-- Registration Info -->
            <div class="registration-info">
                <div class="info-item">
                    <i class="fas fa-calendar-check"></i>
                    <div>
                        <strong>Periode Pendaftaran</strong>
                        <span>{{ \Carbon\Carbon::parse($settings->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($settings->tanggal_selesai)->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-users"></i>
                    <div>
                        <strong>Kuota Tersedia</strong>
                        <span>{{ $settings->kuota - \App\Models\Pendaftaran::where('status_pendaftaran', 'diterima')->count() }} dari {{ $settings->kuota }} anggota</span>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Status</strong>
                        <span class="status-badge status-open">Pendaftaran Dibuka</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('pendaftaran.store') }}" method="POST" class="registration-form" enctype="multipart/form-data">
                @csrf
                
                <!-- Data Pribadi -->
                <div class="form-section">
                    <h3><i class="fas fa-user"></i> Data Pribadi</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nim">NIM *</label>
                            <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required>
                            @error('nim')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="semester">Semester *</label>
                            <select id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_hp">Nomor HP/WhatsApp *</label>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Alasan Mendaftar -->
                <div class="form-section">
                    <h3><i class="fas fa-edit"></i> Alasan Mendaftar</h3>
                    <div class="form-group">
                        <label for="alasan_mendaftar">Mengapa Anda ingin bergabung dengan HIMA-TI? *</label>
                        <textarea id="alasan_mendaftar" name="alasan_mendaftar" rows="5" required>{{ old('alasan_mendaftar') }}</textarea>
                        <small class="form-help">Minimal 50 karakter</small>
                        @error('alasan_mendaftar')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Pengalaman Organisasi -->
                <div class="form-section">
                    <h3><i class="fas fa-briefcase"></i> Pengalaman Organisasi</h3>
                    <div class="form-group">
                        <label for="pengalaman">Pengalaman Organisasi (Opsional)</label>
                        <textarea id="pengalaman" name="pengalaman" rows="4">{{ old('pengalaman') }}</textarea>
                        <small class="form-help">Sebutkan pengalaman organisasi sebelumnya (jika ada)</small>
                        @error('pengalaman')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Kemampuan/Keterampilan -->
                <div class="form-section">
                    <h3><i class="fas fa-star"></i> Kemampuan/Keterampilan</h3>
                    <div class="form-group">
                        <label for="skill">Kemampuan atau Keterampilan (Opsional)</label>
                        <textarea id="skill" name="skill" rows="4">{{ old('skill') }}</textarea>
                        <small class="form-help">Sebutkan kemampuan atau keterampilan yang Anda miliki</small>
                        @error('skill')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="form-section">
                    <h3><i class="fas fa-file-upload"></i> Dokumen Pendukung</h3>
                    <div class="form-group">
                        <label for="dokumen">Upload Dokumen (Opsional)</label>
                        <input type="file" id="dokumen" name="dokumen" accept=".pdf,.doc,.docx">
                        <small class="form-help">Format: PDF, DOC, DOCX (Maksimal 2MB)</small>
                        @error('dokumen')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Persetujuan -->
                <div class="form-section">
                    <div class="form-agreement">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agree" name="agree" value="1" {{ old('agree') ? 'checked' : '' }} required>
                            <span class="checkmark"></span>
                            Saya menyetujui bahwa data yang saya berikan adalah benar dan siap mengikuti proses seleksi
                        </label>
                        @error('agree')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
.registration-section {
    padding: 60px 0;
    background-color: var(--gray-light);
}

.registration-card {
    background: var(--white);
    padding: 40px;
    border-radius: 16px;
    box-shadow: var(--shadow);
    max-width: 800px;
    margin: 0 auto;
}

.registration-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
    padding: 20px;
    background: var(--gray-light);
    border-radius: 12px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 15px;
}

.info-item i {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-item strong {
    display: block;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.info-item span {
    color: var(--text-light);
    font-size: 0.9rem;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-open {
    background: #d4edda;
    color: #155724;
}

.form-section {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border-color);
}

.form-section h3 {
    color: var(--primary-color);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-dark);
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    transition: var(--transition);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: var(--primary-color);
    outline: none;
}

.form-help {
    display: block;
    margin-top: 5px;
    color: var(--text-light);
    font-size: 0.85rem;
}

.error-message {
    display: block;
    margin-top: 5px;
    color: #dc3545;
    font-size: 0.85rem;
}

.form-agreement {
    margin: 20px 0;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    cursor: pointer;
    font-weight: 500;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 4px;
    position: relative;
    flex-shrink: 0;
}

input[type="checkbox"]:checked + .checkmark {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    color: var(--white);
    font-size: 14px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
}

.btn {
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--primary-color);
    color: var(--white);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
}

.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 768px) {
    .registration-card {
        padding: 20px;
    }
    
    .registration-info {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for alasan_mendaftar
    const alasanTextarea = document.getElementById('alasan_mendaftar');
    const charCount = document.createElement('div');
    charCount.className = 'char-count';
    charCount.style.marginTop = '5px';
    charCount.style.fontSize = '0.8rem';
    charCount.style.color = '#6c757d';
    alasanTextarea.parentNode.appendChild(charCount);

    function updateCharCount() {
        const count = alasanTextarea.value.length;
        charCount.textContent = `${count} karakter`;
        
        if (count < 50) {
            charCount.style.color = '#dc3545';
        } else {
            charCount.style.color = '#28a745';
        }
    }

    alasanTextarea.addEventListener('input', updateCharCount);
    updateCharCount();

    // Form validation
    const form = document.querySelector('.registration-form');
    form.addEventListener('submit', function(e) {
        const agreeCheckbox = document.getElementById('agree');
        if (!agreeCheckbox.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui persyaratan pendaftaran');
            return false;
        }
    });
});
</script>
@endsection