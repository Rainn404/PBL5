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

<section class="berita">
    <div class="container berita-wrapper">

       <div class="berita-slider" id="beritaSlider">
    @foreach($beritaSlider as $berita)
        <div class="slider-item">
            <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}">

            <div class="slider-overlay">
                <span>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</span>
                <h3>{{ $berita->judul }}</h3>
                <p>{{ \Str::limit(strip_tags($berita->isi), 160) }}</p>
                <a href="{{ route('berita.show', $berita->id_berita) }}" class="btn-berita-slider">
    Baca Selengkapnya
</a>

            </div>
        </div>
    @endforeach
</div>

              <div class="berita-bawah">
            @foreach($beritaBawah as $berita)
                <div class="berita-kecil">
                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}">

                    <div>
                        <span>
                            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
                        </span>

                        <h4>{{ $berita->judul }}</h4>

                        <a href="{{ route('berita.show', $berita->id_berita) }}" class="btn-berita-mini">
    Baca
</a>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="berita-action">
           <a href="{{ route('berita.index') }}" class="btn-lihat-semua">
    Lihat Semua Berita
</a>

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