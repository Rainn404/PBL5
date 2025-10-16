@extends('layouts.app')

@section('title', 'Pendaftaran Anggota - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Pendaftaran Anggota HIMA-TI</h1>
            <p>Bergabunglah dengan kami untuk mengembangkan potensi dan berkontribusi dalam dunia teknologi informasi</p>
        </div>
    </section>

    <!-- Pendaftaran Process -->
    <section class="pendaftaran-process">
        <div class="container">
            <h2 class="section-title">Proses Pendaftaran</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Isi Formulir</h3>
                        <p>Lengkapi formulir pendaftaran dengan data diri yang valid</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Verifikasi Data</h3>
                        <p>Tim kami akan memverifikasi data yang Anda submit</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Interview</h3>
                        <p>Proses wawancara untuk mengenal minat dan bakat Anda</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Pengumuman</h3>
                        <p>Hasil seleksi akan diumumkan melalui email dan website</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Pendaftaran -->
    <section class="pendaftaran-form-section">
        <div class="container">
            <div class="form-container">
                <h2>Formulir Pendaftaran</h2>
                <form action="{{ route('pendaftaran.store') }}" method="POST" class="pendaftaran-form" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
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
                                <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                                <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                                <option value="3" {{ old('semester') == '3' ? 'selected' : '' }}>Semester 3</option>
                                <option value="4" {{ old('semester') == '4' ? 'selected' : '' }}>Semester 4</option>
                                <option value="5" {{ old('semester') == '5' ? 'selected' : '' }}>Semester 5</option>
                                <option value="6" {{ old('semester') == '6' ? 'selected' : '' }}>Semester 6</option>
                                <option value="7" {{ old('semester') == '7' ? 'selected' : '' }}>Semester 7</option>
                                <option value="8" {{ old('semester') == '8' ? 'selected' : '' }}>Semester 8</option>
                            </select>
                            @error('semester')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP *</label>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="divisi">Divisi yang Diminati *</label>
                        <select id="divisi" name="divisi" required>
                            <option value="">Pilih Divisi</option>
                            <option value="1" {{ old('divisi') == '1' ? 'selected' : '' }}>Divisi Teknologi</option>
                            <option value="2" {{ old('divisi') == '2' ? 'selected' : '' }}>Divisi Keanggotaan</option>
                            <option value="3" {{ old('divisi') == '3' ? 'selected' : '' }}>Divisi Media & Komunikasi</option>
                            <option value="4" {{ old('divisi') == '4' ? 'selected' : '' }}>Divisi Kewirausahaan</option>
                        </select>
                        @error('divisi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pengalaman">Pengalaman Organisasi/Kepanitiaan</label>
                        <textarea id="pengalaman" name="pengalaman" rows="3" placeholder="Jelaskan pengalaman organisasi atau kepanitiaan yang pernah diikuti">{{ old('pengalaman') }}</textarea>
                        @error('pengalaman')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alasan_mendaftar">Alasan Bergabung dengan HIMA-TI *</label>
                        <textarea id="alasan_mendaftar" name="alasan_mendaftar" rows="4" required placeholder="Jelaskan alasan Anda ingin bergabung dengan HIMA-TI">{{ old('alasan_mendaftar') }}</textarea>
                        @error('alasan_mendaftar')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="skill">Kemampuan/Keterampilan</label>
                        <textarea id="skill" name="skill" rows="3" placeholder="Sebutkan kemampuan atau keterampilan yang Anda miliki">{{ old('skill') }}</textarea>
                        @error('skill')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dokumen">Upload CV/Portofolio (Opsional)</label>
                        <input type="file" id="dokumen" name="dokumen" accept=".pdf,.doc,.docx">
                        <small>Format: PDF, DOC, DOCX (Maks. 2MB)</small>
                        @error('dokumen')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-agreement">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agree" name="agree" required>
                            <span class="checkmark"></span>
                            Saya menyetujui bahwa data yang saya berikan adalah benar dan siap mengikuti proses seleksi
                        </label>
                        @error('agree')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit">Daftar Sekarang</button>
                </form>
            </div>

            <div class="pendaftaran-info">
                <h3>Informasi Penting</h3>
                <div class="info-cards">
                    <div class="info-card">
                        <i class="fas fa-calendar-alt"></i>
                        <h4>Periode Pendaftaran</h4>
                        <p>1 - 30 November 2024</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-users"></i>
                        <h4>Kuota Penerimaan</h4>
                        <p>30 Anggota Baru</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-clock"></i>
                        <h4>Proses Seleksi</h4>
                        <p>1-2 Minggu setelah pendaftaran</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-envelope"></i>
                        <h4>Pengumuman</h4>
                        <p>Via Email dan Website</p>
                    </div>
                </div>

                <div class="contact-info">
                    <h4>Butuh Bantuan?</h4>
                    <p>Hubungi kami melalui:</p>
                    <div class="contact-methods">
                        <p><i class="fas fa-envelope"></i> pendaftaran@himati.ac.id</p>
                        <p><i class="fas fa-phone"></i> +62 812 3456 7890 (Admin)</p>
                        <p><i class="fas fa-clock"></i> Senin - Jumat, 08:00 - 16:00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Pertanyaan Umum</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Apa syarat untuk bergabung dengan HIMA-TI?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Syarat utama adalah mahasiswa aktif Program Studi Teknik Informatika dengan semangat belajar dan berkontribusi. Tidak ada batasan IPK minimum.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Apakah ada biaya pendaftaran?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Tidak ada biaya pendaftaran. Proses seleksi dan pendaftaran sepenuhnya gratis.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Berapa lama proses seleksi berlangsung?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Proses seleksi membutuhkan waktu 1-2 minggu setelah periode pendaftaran ditutup.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Bolehkah memilih lebih dari satu divisi?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Anda hanya boleh memilih satu divisi utama. Namun, Anda dapat menyebutkan minat lainnya dalam kolom alasan bergabung.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Pendaftaran Process Styles */
    .pendaftaran-process {
        padding: 60px 0;
        background-color: var(--white);
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .process-step {
        text-align: center;
        padding: 30px 20px;
        background: var(--gray-light);
        border-radius: 12px;
        transition: var(--transition);
        position: relative;
    }

    .process-step:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow);
    }

    .step-number {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 auto 20px;
    }

    .process-step h3 {
        color: var(--primary-color);
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .process-step p {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Form Section Styles */
    .pendaftaran-form-section {
        padding: 80px 0;
        background-color: var(--gray-light);
    }

    .pendaftaran-form-section .container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 50px;
    }

    .form-container {
        background: var(--white);
        padding: 40px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    .form-container h2 {
        color: var(--primary-color);
        margin-bottom: 30px;
        text-align: center;
        font-size: 1.8rem;
    }

    .pendaftaran-form .form-group {
        margin-bottom: 25px;
    }

    .pendaftaran-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .pendaftaran-form input,
    .pendaftaran-form select,
    .pendaftaran-form textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: var(--transition);
        background-color: var(--white);
    }

    .pendaftaran-form input:focus,
    .pendaftaran-form select:focus,
    .pendaftaran-form textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-agreement {
        margin: 30px 0;
    }

    .checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        cursor: pointer;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .checkbox-label input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}


  .checkmark {
    width: 20px;
    height: 20px;
    min-width: 20px; /* biar nggak gepeng kalau flex */
    display: inline-block;
    border: 2px solid #ddd;
    border-radius: 4px;
    position: relative;
    flex-shrink: 0; /* jangan mengecil saat dalam flexbox */
    margin-top: 2px;
}


    .checkbox-label input:checked + .checkmark {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .checkbox-label input:checked + .checkmark::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 14px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Error Messages */
    .error-message {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 5px;
        display: block;
    }

    /* Info Sidebar */
    .pendaftaran-info h3 {
        color: var(--primary-color);
        margin-bottom: 30px;
        font-size: 1.5rem;
    }

    .info-cards {
        display: grid;
        gap: 20px;
        margin-bottom: 40px;
    }

    .info-card {
        background: var(--white);
        padding: 20px;
        border-radius: 8px;
        box-shadow: var(--shadow);
        text-align: center;
        transition: var(--transition);
    }

    .info-card:hover {
        transform: translateY(-3px);
    }

    .info-card i {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .info-card h4 {
        margin-bottom: 5px;
        color: var(--text-dark);
    }

    .info-card p {
        color: var(--text-light);
        margin: 0;
        font-size: 0.9rem;
    }

    .contact-info {
        background: var(--white);
        padding: 25px;
        border-radius: 8px;
        box-shadow: var(--shadow);
    }

    .contact-info h4 {
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .contact-info > p {
        color: var(--text-light);
        margin-bottom: 15px;
    }

    .contact-methods p {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    .contact-methods i {
        color: var(--primary-color);
        width: 20px;
    }

    /* FAQ Section */
    .faq-section {
        padding: 80px 0;
        background-color: var(--white);
    }

    .faq-list {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        background: var(--white);
        border-radius: 8px;
        box-shadow: var(--shadow);
        margin-bottom: 15px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .faq-question {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .faq-question:hover {
        background-color: var(--gray-light);
    }

    .faq-question h3 {
        margin: 0;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .faq-question i {
        transition: var(--transition);
        color: var(--primary-color);
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: var(--transition);
    }

    .faq-item.active .faq-answer {
        padding: 0 20px 20px;
        max-height: 200px;
    }

    .faq-answer p {
        margin: 0;
        color: var(--text-light);
        line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .pendaftaran-form-section .container {
            grid-template-columns: 1fr;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .process-steps {
            grid-template-columns: 1fr;
        }
        
        .form-container {
            padding: 25px;
        }
    }

    @media (max-width: 576px) {
        .pendaftaran-process,
        .pendaftaran-form-section,
        .faq-section {
            padding: 40px 0;
        }
        
        .form-container h2 {
            font-size: 1.5rem;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ Toggle
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.parentElement;
                faqItem.classList.toggle('active');
            });
        });

        // Form Validation
        const form = document.querySelector('.pendaftaran-form');
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let valid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '';
                }
            });

            const agreeCheckbox = document.getElementById('agree');
            if (!agreeCheckbox.checked) {
                valid = false;
                agreeCheckbox.parentElement.style.color = '#dc3545';
            } else {
                agreeCheckbox.parentElement.style.color = '';
            }

            if (!valid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi dan setujui persyaratan!');
            }
        });

        // File input validation
        const fileInput = document.getElementById('dokumen');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const fileSize = file.size / 1024 / 1024; // in MB
                    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap upload file PDF, DOC, atau DOCX.');
                        this.value = '';
                    } else if (fileSize > 2) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.value = '';
                    }
                }
            });
        }
    });
    </script>
@endsection