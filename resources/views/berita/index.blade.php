@extends('layouts.app')

@section('title', 'Berita HIMA-TI')

@section('content')
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f8fafc;
  }

  /* ===== HERO SECTION ===== */
  .hero {
    background: linear-gradient(90deg, #1d8cf8, #007bff);
    color: white;
    text-align: center;
    padding: 60px 20px;
    border-radius: 0 0 20px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 200px;
  }

  .hero h1 {
    font-weight: 800;
    font-size: 2rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    text-align: center;
  }

  .hero p {
    max-width: 700px;
    font-size: 1rem;
    opacity: 0.95;
    margin: 0 auto;
    text-align: center;
  }

  /* ===== SECTION BERITA ===== */
.news-section {
  background:
    linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
    url('https://maukuliah.ap-south-1.linodeobjects.com/gallery/005039/Gedung%202%20Politala-thumbnail.jpg')
    no-repeat center center;
  background-size: cover;
}

  /* ===== JUDUL SECTION ===== */
  .section-title {
    text-align: center;
    font-weight: 700;
    font-size: 1.5rem;
    margin: 40px 0 25px;
    color: #111827;
  }

  /* ===== CARD BERITA ===== */
  .card-news {
    display: flex;
    align-items: flex-start;
    background: rgba(255, 255, 255, 0.85);
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    margin-bottom: 24px;
    overflow: hidden;
    transition: transform 0.2s ease-in-out;
    backdrop-filter: blur(4px);
  }

  .card-news:hover {
    transform: translateY(-4px);
  }

  .card-news img {
    width: 250px;
    height: 180px;
    object-fit: cover;
    border-radius: 16px 0 0 16px;
  }

  .card-body {
    flex: 1;
    padding: 20px 24px;
  }

  .card-body h5 {
    font-weight: 700;
    font-size: 1.1rem;
    color: #111827;
  }

  .card-body p {
    font-size: 0.95rem;
    color: #374151;
  }

  .btn-warning {
    background-color: #ffc107;
    border: none;
    color: #000;
    font-weight: 700;
    border-radius: 8px;
    transition: 0.3s;
  }
  
body.page-berita {
  background:
    linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
    url('https://maukuliah.ap-south-1.linodeobjects.com/gallery/005039/Gedung%202%20Politala-thumbnail.jpg')
    no-repeat center center fixed;
  background-size: cover;
  background-attachment: fixed;
}

  .btn-warning:hover {
    background-color: #ffb300;
    color: #fff;
  }
/* ===== Tombol Lihat Semua Berita ===== */
.btn-berita {
  background: linear-gradient(90deg, #1d8cf8, #007bff); /* gradasi biru khas HIMA-TI */
  color: #fff !important;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.3px;
  padding: 10px 28px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
}

.btn-berita:hover {
  background: linear-gradient(90deg, #007bff, #0056b3);
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(0, 123, 255, 0.35);
}
/* ===== Tombol Lihat Semua Berita ===== */
.btn-berita {
  background: linear-gradient(90deg, #1d8cf8, #007bff); /* gradasi biru khas HIMA-TI */
  color: #fff !important;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.3px;
  padding: 10px 28px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
}

.btn-berita:hover {
  background: linear-gradient(90deg, #007bff, #0056b3);
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(0, 123, 255, 0.35);
}

  @media (max-width: 768px) {
    .card-news {
      flex-direction: column;
    }

    .card-news img {
      width: 100%;
      height: 220px;
      border-radius: 16px 16px 0 0;

    }
  }
</style>

<main class="content">
  <!-- ===== HERO ===== -->
<section class="hero">
  <h1>BERITA HIMA-TI</h1>
  <p>
    Kumpulan berita, kegiatan, dan prestasi terkini dari
    Himpunan Mahasiswa Teknik Informatika Politeknik Negeri Tanah Laut.
  </p>
</section>
</main>

<section class="news-section">
  <div class="container">

    <h3 class="section-title">DAFTAR BERITA</h3>

   @php
  $featured = $berita->take(4);
  $utama = $featured->first();
  $samping = $featured->slice(1);
  $rest = $berita->skip(4);
@endphp

{{-- ===============================
     FEATURED (1 KIRI + 3 KANAN)
================================ --}}
<div class="news-featured">

  {{-- KIRI --}}
  <div class="news-featured-main">
    <img src="{{ Storage::url($utama->foto) }}" alt="">
    <div class="news-content">
      <h3>{{ $utama->judul }}</h3>
      <p>{{ Str::limit(strip_tags($utama->isi), 180) }}</p>

      <a href="{{ route('berita.show', $utama->id_berita) }}"
         class="btn-readmore">
        READ MORE
      </a>
    </div>
  </div>

  {{-- KANAN --}}
  <div class="news-featured-side">
    @foreach($samping as $item)
      <div class="news-side-item">
        <img src="{{ Storage::url($item->foto) }}" alt="">
        <div>
          <h4 class="fw-bold">
    {{ Str::limit($item->judul, 60) }}
</h4>
          <a href="{{ route('berita.show', $item->id_berita) }}"
             class="btn-readmore-sm">
            READ MORE
          </a>
        </div>
      </div>
    @endforeach
  </div>

</div>

{{-- ===============================
     GRID BAWAH (SISA BERITA)
================================ --}}
<div class="news-grid">
  @foreach($rest as $item)
    <div class="news-card">
      <img src="{{ Storage::url($item->foto) }}" alt="">
      <div class="news-body">
        <h5>{{ $item->judul }}</h5>
        <p>{{ Str::limit(strip_tags($item->isi), 100) }}</p>
      </div>
      <div class="news-footer">
        <a href="{{ route('berita.show', $item->id_berita) }}"
           class="btn-readmore">
          READ MORE
        </a>
      </div>
    </div>
  @endforeach
</div>

<!-- Tombol lihat semua (hanya muncul di halaman utama) -->
@if(isset($mode) && $mode === 'utama')
  <div class="text-center mt-4 mb-5">
  </div>
@endif
  </div>
  </section>
</main>
@endsection
