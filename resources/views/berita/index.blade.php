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
      no-repeat center center fixed;
    background-size: cover;
    padding: 60px 0;
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
  <section class="hero {{ $mode === 'utama' ? 'hero-utama' : 'hero-berita' }}">
    @if(isset($mode) && $mode === 'utama')
      <h1>HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</h1>
      <p>Wadah pengembangan potensi mahasiswa Teknik Informatika dalam bidang teknologi, kepemimpinan, dan sosial.</p>
    @else
      <h1>BERITA HIMA-TI</h1>
      <p>Kumpulan berita, kegiatan, dan prestasi terkini dari Himpunan Mahasiswa Teknik Informatika Politeknik Negeri Tanah Laut.</p>
    @endif
  </section>
</main>

  <!-- ===== BERITA SECTION ===== -->
  <section class="news-section" style="margin-top: -30px;">
  <div class="container">

    @if(isset($mode) && $mode === 'utama')
      <h3 class="section-title">BERITA TERKINI</h3>
    @else
      <h3 class="section-title">BERITA LAINNYA</h3>
    @endif

    @forelse($highlight as $b)
      <div class="card-news">
        <!-- Gambar di kiri -->
        @if($b->foto)
          <img src="{{ Storage::url($b->foto) }}" alt="Foto Berita">
        @else
          <img src="https://via.placeholder.com/250x180?text=No+Image" alt="Tidak ada foto">
        @endif

        <!-- Teks di kanan -->
        <div class="card-body">
          <h5>{{ $b->judul }}</h5>
          <p class="text-muted mb-1">
            Posted by <strong>{{ $b->nama_penulis ?? 'Anonim' }}</strong> — {{ $b->created_at?->format('d M Y') }}
          </p>
          <p>{{ Str::limit(strip_tags($b->isi), 180, '...') }}</p>
<a href="{{ route('berita.show', $b->id_berita) }}" 
   class="btn px-3 py-2 text-white" 
   style="background-color: #1f2942;">
  READ MORE
</a>

          </a>
        </div>
      </div>
    @empty
      <p class="text-center text-muted mt-4 mb-5">Belum ada berita yang tersedia.</p>
    @endforelse

<!-- Tombol lihat semua (hanya muncul di halaman utama) -->
@if(isset($mode) && $mode === 'utama')
  <div class="text-center mt-4 mb-5">
    <a href="{{ route('berita.lainnya') }}" class="btn btn-berita px-4 py-2">
      <i class="fas fa-layer-group me-2"></i> Lihat Semua Berita
    </a>
  </div>
@endif
  </div>
  </section>
</main>
@endsection
