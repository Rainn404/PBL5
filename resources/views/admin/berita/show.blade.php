<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $berita->judul }} | HIMA-TI</title>

  <!-- Fonts & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    :root { --muted:#6b7280 }
    body {
      margin:0;
      color:#0f172a;
      background:#f9fafb;
      font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Arial,Helvetica,sans-serif;
    }

    /* Navbar */
    .navbar {
      position:sticky; top:0; z-index:50;
      background:#fff; border-bottom:1px solid #edf0f4;
      box-shadow:0 4px 16px rgba(0,0,0,.06);
    }
    .nav-wrap {
      max-width:1100px; margin:auto; display:flex;
      align-items:center; gap:16px; padding:12px 18px; height:70px;
    }
    .brand-logo {
      display:flex; align-items:center; gap:10px;
      text-decoration:none; color:#1f2937; font-weight:700; font-size:20px;
    }

    /* Layout Grid */
    .page-grid {
      max-width:1100px; margin:30px auto; padding:0 18px;
      display:grid; grid-template-columns:2fr 1fr; gap:24px;
    }
    @media (max-width:992px) { .page-grid{ grid-template-columns:1fr } }

    /* Artikel */
    .card-article {
      background:#fff; border-radius:16px; box-shadow:0 4px 12px rgba(0,0,0,.08);
    }
    .article-wrap { padding:24px; }
    .article-title { font-size:30px; font-weight:800; margin-bottom:8px; }
    .article-date { color:var(--muted); margin-bottom:24px; font-size:14px; }
    .article-image { width:100%; border-radius:12px; margin-bottom:24px; }
    .article-content p { line-height:1.9; color:#1f2937; text-align:justify; }

    /* Komentar */
    .card-side {
      background:#fff; border-radius:16px;
      box-shadow:0 4px 12px rgba(0,0,0,.08);
      padding:16px;
    }
    .comment-meta { color:var(--muted); font-size:12px }
    .comment-divider { border-top:1px solid #edf0f4 }

    /* Footer */
    footer { background:#2c3e50; color:#ecf0f1; margin-top:50px; padding:50px 18px 20px; }
    .footer-container {
      max-width:1100px; margin:auto;
      display:grid; grid-template-columns:2fr 1fr 1.5fr; gap:40px;
    }
    .footer-container h3 { font-size:18px; margin-bottom:20px; color:#fff; }
    .footer-container p, .footer-container li { font-size:14px; line-height:1.8; color:#bdc3c7; }
    .footer-container ul { list-style:none; padding:0; margin:0; }
    .footer-container a { text-decoration:none; color:#bdc3c7; transition:.3s; }
    .footer-container a:hover { color:#fff; padding-left:4px; }
    .footer-bottom { text-align:center; padding-top:20px; margin-top:40px; border-top:1px solid #3a4b60; font-size:14px; color:#95a5a6; }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="nav-wrap">
      <a href="{{ url('/') }}" class="brand-logo">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 17.2727V6.72727C4 6.27364 4.40455 5.81818 4.90909 5.81818H19.0909C19.5955 5.81818 20 6.27364 20 6.72727V17.2727C20 17.7264 19.5955 18.1818 19.0909 18.1818H4.90909C4.40455 18.1818 4 17.7264 4 17.2727Z" stroke="white" stroke-width="1.5"/>
          <path d="M14.5455 12.0002L9.45455 9.18201V14.8184L14.5455 12.0002Z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/>
        </svg>
        <span>HIMA-TI</span>
      </a>
      <div class="ms-auto d-none d-lg-flex gap-3">
        <a href="{{ url('/') }}" class="text-decoration-none">Home</a>
        <a href="{{ route('berita.index') }}" class="text-decoration-none fw-semibold text-primary">Berita</a>
      </div>
    </div>
  </nav>

  @if (session('success'))
    <div class="container mt-3">
      <div class="alert alert-success">{{ session('success') }}</div>
    </div>
  @endif

  <div class="page-grid">
    <!-- ======== Artikel ======== -->
    <article class="card-article">
      <div class="article-wrap">
        <a href="{{ route('berita.index') }}" class="btn btn-light mb-3">&larr; Kembali</a>

        <h1 class="article-title">{{ $berita->judul }}</h1>
        <p class="article-date">
          @php
            $tgl = $berita->tanggal ?? ($berita->tanggal_berita ?? null);
          @endphp
          {{ $tgl ? \Carbon\Carbon::parse($tgl)->format('d F Y') : ($berita->created_at?->format('d F Y') ?? '') }}
          @if($berita->nama_penulis) • Penulis: {{ $berita->nama_penulis }} @endif
        </p>

        @if($berita->foto)
          <img src="{{ Storage::url($berita->foto) }}" class="article-image" alt="{{ $berita->judul }}">
        @endif

        <div class="article-content">
          {!! $berita->isi !!}
        </div>
      </div>
    </article>

    <!-- ======== Komentar ======== -->
    <aside>
      <section id="komentar" class="card-side mb-3">
        <h5 class="mb-3">Tulis Komentar</h5>
        <form action="{{ route('berita.komentar.store', $berita->Id_berita) }}" method="POST">
          @csrf
          <input type="text" name="nama" class="form-control mb-2" placeholder="Nama (opsional)">
          <textarea name="isi" rows="4" class="form-control mb-3" placeholder="Tulis komentar..." required></textarea>
          <button class="btn btn-primary">Kirim</button>
        </form>
      </section>

      <section class="card-side">
        <h5 class="mb-3">Komentar</h5>

        @forelse(($berita->komentar ?? collect()) as $c)
          <div class="comment-divider pt-3 mt-3">
            <div class="d-flex justify-content-between align-items-start">
              <div class="comment-meta">
                <strong>{{ $c->nama ?: 'Anonim' }}</strong>
                • {{ \Carbon\Carbon::parse($c->created_at)->format('d M Y H:i') }}
              </div>

              <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleEdit({{ $c->id }})">Edit</button>
                <form action="{{ route('berita.komentar.destroy', [$berita->Id_berita, $c->id]) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-outline-danger">Hapus</button>
                </form>
              </div>
            </div>

            <p class="mb-2" id="view-text-{{ $c->id }}">{{ $c->isi }}</p>

            <form id="edit-form-{{ $c->id }}" class="d-none"
                  action="{{ route('berita.komentar.update', [$berita->Id_berita, $c->id]) }}" method="POST">
              @csrf @method('PUT')
              <input type="text" name="nama" class="form-control form-control-sm mb-2" value="{{ $c->nama }}">
              <textarea name="isi" rows="3" class="form-control form-control-sm mb-2" required>{{ $c->isi }}</textarea>
              <div class="text-end">
                <button class="btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="btn btn-sm btn-light" onclick="toggleEdit({{ $c->id }})">Batal</button>
              </div>
            </form>
          </div>
        @empty
          <p class="text-muted mb-0">Belum ada komentar.</p>
        @endforelse
      </section>
    </aside>
  </div>

  <!-- ======== FOOTER ======== -->
  <footer>
    <div class="footer-container">
      <div>
        <h3>HIMA-TI</h3>
        <p>Himpunan Mahasiswa Teknik Informatika - Wadah bagi mahasiswa untuk mengembangkan potensi dan berkontribusi dalam dunia teknologi informasi.</p>
      </div>
      <div>
        <h3>Menu Cepat</h3>
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ route('berita.index') }}">Berita</a></li>
        </ul>
      </div>
      <div>
        <h3>Kontak</h3>
        <ul>
          <li>Gedung Teknik Informatika, Kampus Universitas</li>
          <li>himati@universitas.ac.id</li>
          <li>+62 812 3456 7890</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; {{ date('Y') }} HIMA-TI. All rights reserved.
    </div>
  </footer>

  <script>
    function toggleEdit(id){
      const form=document.getElementById('edit-form-'+id);
      const view=document.getElementById('view-text-'+id);
      if(form) form.classList.toggle('d-none');
      if(view) view.classList.toggle('d-none');
      if(form && !form.classList.contains('d-none')) form.scrollIntoView({behavior:'smooth', block:'center'});
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
