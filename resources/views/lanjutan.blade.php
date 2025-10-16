<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Berita Terkini — Halaman 2</title>
  <style>
    :root{ --blue:#2f67ff; --blue2:#2c5bea; }
    body{margin:0;font-family:Arial,Helvetica,sans-serif;color:#0f172a;background:#fff}
    .container{max-width:1100px;margin:24px auto;padding:0 18px;text-align:center}
    h2{margin:0 0 14px}
    .grid{display:grid;gap:18px;grid-template-columns:repeat(3,1fr)}
    @media (max-width:900px){.grid{grid-template-columns:repeat(2,1fr)}}
    @media (max-width:580px){.grid{grid-template-columns:1fr}}
    .card{border:3px solid #c9d6ff;border-radius:12px;overflow:hidden;background:#2f3a56;color:#fff}
    .card-inner{padding:14px}
    .foto{height:150px;background:#e5e7eb;border-radius:10px;margin-bottom:12px;
          display:grid;place-items:center;color:#444;font-weight:700}
    .judul{font-weight:700;line-height:1.35}
    .cta{margin:22px 0;display:flex;gap:10px;justify-content:center}
    .btn{background:var(--blue);border:none;color:#fff;padding:10px 18px;border-radius:10px;
         font-weight:700;text-decoration:none;display:inline-block}
    .btn:hover{background:var(--blue2)}
  </style>
</head>
<body>
  <main class="container">
    <h2>BERITA TERKINI — Halaman 2</h2>

    <section class="grid">
      <article class="card"><div class="card-inner">
        <div class="foto">Foto</div>
        <div class="judul">Workshop Cloud & DevOps untuk Mahasiswa TI 2025</div>
      </div></article>

      <article class="card"><div class="card-inner">
        <div class="foto">Foto</div>
        <div class="judul">HIMA-TI Gelar Pengabdian Masyarakat: Literasi Digital untuk UMKM</div>
      </div></article>

      <article class="card"><div class="card-inner">
        <div class="foto">Foto</div>
        <div class="judul">Tim Politala Juara 2 Gemastik Bidang Keamanan Siber</div>
      </div></article>
    </section>

    <div class="cta">
      <a href="{{ route('berita') }}" class="btn">Kembali ke Halaman 1</a>
      {{-- kalau mau lanjut ke halaman 3, aktifkan ini & buat routenya --}}
      {{-- <a href="{{ route('berita.halaman3') }}" class="btn">Berita Lainnya</a> --}}
    </div>
  </main>
</body>
</html>
