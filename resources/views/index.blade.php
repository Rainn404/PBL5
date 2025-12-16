@extends('layouts.app')

@section('title', 'HIMA-TI - Beranda')
<style>
    
    </style>
@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>HIMPUNAN MAHASISWA TEKNOLOGI INFORMASI</h1>
            <p>Wadah pengembangan potensi mahasiswa Teknik Informatika dalam bidang teknologi, kepemimpinan, dan sosial.</p>
            <div class="hero-buttons">
                <a href="{{ url('/pendaftaran') }}" class="btn btn-primary">Daftar Sekarang</a>
                <a href="{{ url('/berita') }}" class="btn btn-secondary">Lihat Berita Terbaru</a>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="about">
        <div class="container">
            <h2 class="section-title">Tentang HIMA-TI</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>Himpunan Mahasiswa Teknik Informatika (HIMA-TI) merupakan organisasi kemahasiswaan yang mewadahi mahasiswa Program Studi Teknik Informatika. Organisasi ini bertujuan untuk mengembangkan potensi akademik, minat, bakat, serta kepedulian sosial mahasiswa.</p>
                    <p>Kami menyelenggarakan berbagai kegiatan seperti pelatihan, seminar, kompetisi, dan pengabdian masyarakat untuk meningkatkan kompetensi anggota di bidang teknologi informasi.</p>
                </div>
                <div class="about-stats">
                    <div class="stat">
                        <h3>150+</h3>
                        <p>Anggota Aktif</p>
                    </div>
                    <div class="stat">
                        <h3>25+</h3>
                        <p>Kegiatan/Tahun</p>
                    </div>
                    <div class="stat">
                        <h3>50+</h3>
                        <p>Prestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divisi Section -->
    <section class="divisi">
        <div class="container">
            <h2 class="section-title">Divisi Kami</h2>
            <div class="divisi-grid">
                <div class="divisi-card">
                    <div class="divisi-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Divisi Teknologi</h3>
                    <p>Mengembangkan kemampuan teknis anggota dalam pemrograman, pengembangan web, dan teknologi terkini.</p>
                </div>
                <div class="divisi-card">
                    <div class="divisi-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Divisi Keanggotaan</h3>
                    <p>Mengelola data anggota, pendaftaran, dan pengembangan soft skills melalui berbagai pelatihan.</p>
                </div>
                <div class="divisi-card">
                    <div class="divisi-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3>Divisi Media & Komunikasi</h3>
                    <p>Mengelola konten media sosial, website, dan publikasi kegiatan HIMA-TI.</p>
                </div>
                <div class="divisi-card">
                    <div class="divisi-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Divisi Kewirausahaan</h3>
                    <p>Mengembangkan jiwa kewirausahaan dan mengelola unit usaha HIMA-TI.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru Section -->
    <section class="berita">
        <div class="container">
            <h2 class="section-title">Berita Terbaru</h2>
            <div class="berita-grid">
                <div class="berita-card">
                    <div class="berita-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Workshop HIMA-TI">
                    </div>
                    <div class="berita-content">
                        <span class="berita-date">15 Oktober 2023</span>
                        <h3>Workshop Web Development Modern</h3>
                        <p>HIMA-TI menyelenggarakan workshop web development dengan teknologi terkini untuk meningkatkan kompetensi anggota.</p>
                        <a href="#" class="berita-link">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="berita-card">
                    <div class="berita-image">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Prestasi HIMA-TI">
                    </div>
                    <div class="berita-content">
                        <span class="berita-date">10 Oktober 2023</span>
                        <h3>Anggota HIMA-TI Raih Juara 1 Hackathon Nasional</h3>
                        <p>Tim dari HIMA-TI berhasil meraih juara 1 dalam kompetisi hackathon tingkat nasional yang diadakan di Jakarta.</p>
                        <a href="#" class="berita-link">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="berita-card">
                    <div class="berita-image">
                        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Kegiatan Sosial HIMA-TI">
                    </div>
                    <div class="berita-content">
                        <span class="berita-date">5 Oktober 2023</span>
                        <h3>HIMA-TI Gelar Bakti Sosial di Desa Tertinggal</h3>
                        <p>Sebagai bentuk pengabdian masyarakat, HIMA-TI mengadakan kegiatan bakti sosial dan pelatihan komputer dasar.</p>
                        <a href="#" class="berita-link">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="berita-more">
                <a href="{{ url('/berita') }}" class="btn btn-outline">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <section class="prestasi">
        <div class="container">
            <h2 class="section-title">Prestasi Anggota</h2>
            <div class="prestasi-grid">
                <div class="prestasi-card">
                    <div class="prestasi-badge">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Juara 1 Web Design Competition</h3>
                    <p>National IT Festival 2023</p>
                    <span class="prestasi-anggota">Oleh: Ahmad Fauzi</span>
                </div>
                <div class="prestasi-card">
                    <div class="prestasi-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3>Juara 2 Mobile App Development</h3>
                    <p>Indonesia Developer Conference 2023</p>
                    <span class="prestasi-anggota">Oleh: Siti Rahayu</span>
                </div>
                <div class="prestasi-card">
                    <div class="prestasi-badge">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>Best Paper Award</h3>
                    <p>International Conference on Informatics 2023</p>
                    <span class="prestasi-anggota">Oleh: Rizki Pratama</span>
                </div>
            </div>
            <div class="prestasi-more">
                <a href="{{ url('/prestasi') }}" class="btn btn-outline">Lihat Semua Prestasi</a>
            </div>
        </div>
    </section>
@endsection