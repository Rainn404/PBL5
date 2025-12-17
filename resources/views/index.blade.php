@extends('layouts.app')

@section('title', 'HIMA-TI - Beranda')
<style>
.news-grid{
    display: flex;
    gap: 20px;
    margin-top: 30px;
    align-items: stretch;
}

.news-card{
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-body{
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-body a{
    margin-top: auto;
}
.btn-read {
    align-self: flex-start;   /* tidak full width */
    padding: 6px 14px;        /* kecil & rapi */
    font-size: 12px;
    border-radius: 8px;
    margin-top: auto;
}

/* SLIDER */
#headlineCarousel {
    height: 300px;
    overflow: hidden;
    position: relative;
}

#headlineCarousel .carousel-item,
#headlineCarousel img {
    height: 300px;
}

#headlineCarousel img {
    object-fit: cover;
}

/* CAPTION */
.carousel-caption-custom {
    position: absolute;
    bottom: 20px;
    left: 20px;
    max-width: 55%;
    background: rgba(0,0,0,0.6);
    padding: 14px 16px;
    border-radius: 10px;
    color: #fff;
    z-index: 5;
}

/* JUDUL */
.carousel-caption-custom h5 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 6px;
    line-height: 1.3;
    color: #fff;
}

/* DESKRIPSI */
.carousel-caption-custom p {
    font-size: 13px;
    line-height: 1.4;
    margin-bottom: 10px;
    color: #ddd;
}

/* BUTTON */
.carousel-caption-custom a {
    font-size: 13px;
    padding: 6px 12px;
}


/* Responsive HP */
@media(max-width:768px){
    .news-grid{
        flex-direction: column;
    }
}

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

@if($berita->count() > 0)
<div class="container mt-4">

    <div id="headlineCarousel"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">

            @foreach($berita->take(1) as $key => $item)
            <div class="carousel-item active">

                <img src="{{ asset('storage/'.$item->foto) }}"
                     class="d-block w-100"
                     alt="{{ $item->judul }}">

                <div class="carousel-caption-custom">
                    <h5>{{ $item->judul }}</h5>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}</p>
                    <a href="{{ route('berita.show', $item->id_berita) }}"
                       class="btn btn-primary btn-sm">
                        Baca Selengkapnya
                    </a>
                </div>

            </div>
            @endforeach

        </div>

    </div>

</div>
@endif


@if($berita->count() > 1)
<div class="container mt-4">
    <div class="news-grid">

        @foreach($berita->skip(1)->take(3) as $item)
        <div class="news-card">

            <img src="{{ asset('storage/'.$item->foto) }}"
                 alt="{{ $item->judul }}">

            <div class="news-body">
                <h6>{{ $item->judul }}</h6>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 80) }}</p>
                <a href="{{ route('berita.show', $item->id_berita) }}"
   class="btn btn-primary btn-sm mt-auto">
   Baca Selengkapnya
</a>

            </div>

        </div>
        @endforeach

    </div>
</div>
@endif




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