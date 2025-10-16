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
                <form class="pendaftaran-form" id="pendaftaranForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nim">NIM *</label>
                            <input type="text" id="nim" name="nim" required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester *</label>
                            <select id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP *</label>
                            <input type="tel" id="no_hp" name="no_hp" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="divisi">Divisi yang Diminati *</label>
                        <select id="divisi" name="divisi" required>
                            <option value="">Pilih Divisi</option>
                            <option value="teknologi">Divisi Kaderisasi</option>
                            <option value="keanggotaan">Divisi Tecno</option>
                            <option value="media">Divisi Humas</option>
                            <option value="kewirausahaan">Divisi Media Informasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pengalaman">Pengalaman Organisasi/Kepanitiaan</label>
                        <textarea id="pengalaman" name="pengalaman" rows="3" placeholder="Jelaskan pengalaman organisasi atau kepanitiaan yang pernah diikuti"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="alasan">Alasan Bergabung dengan HIMA-TI *</label>
                        <textarea id="alasan" name="alasan" rows="4" required placeholder="Jelaskan alasan Anda ingin bergabung dengan HIMA-TI"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="skill">Kemampuan/Keterampilan</label>
                        <textarea id="skill" name="skill" rows="3" placeholder="Sebutkan kemampuan atau keterampilan yang Anda miliki"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="dokumen">Upload CV/Portofolio (Opsional)</label>
                        <input type="file" id="dokumen" name="dokumen" accept=".pdf,.doc,.docx">
                        <small>Format: PDF, DOC, DOCX (Maks. 2MB)</small>
                    </div>

                    <div class="form-agreement">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agree" name="agree" required>
                            <span class="checkmark"></span>
                            Saya menyetujui bahwa data yang saya berikan adalah benar dan siap mengikuti proses seleksi
                        </label>
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
                        <p>1 - 30 November 2023</p>
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
@endsection