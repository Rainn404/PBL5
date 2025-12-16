<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ $berita->judul }} | HIMA-TI</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
<style>
  :root{ --brand:#007BFF; --muted:#6b7280; --card:#fff; --ring:#edf0f4; }
  *{box-sizing:border-box}
  body{ margin:0; color:#0f172a; background:#f3f4f6; font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Arial,Helvetica,sans-serif; }

  /* Navbar full width */
  .navbar{ position:sticky; top:0; z-index:50; background:#fff; border-bottom:1px solid var(--ring); box-shadow:0 4px 16px rgba(0,0,0,.06); }
  .nav-wrap{ max-width:1200px; margin:0 auto; display:flex; align-items:center; gap:16px; padding:12px 18px; height:70px; }
  .brand-logo{ display:flex; align-items:center; gap:10px; text-decoration:none; color:#1f2937; font-weight:700; font-size:20px; }
  .brand-logo svg{ background:var(--brand); border-radius:6px; padding:4px }

  /* Page layout */
  .page{ max-width:1200px; margin:28px auto; display:grid; grid-template-columns:minmax(0, 1.8fr) 380px; gap:24px; padding:0 18px; }
  .article{ background:var(--card); border:1px solid var(--ring); border-radius:16px; padding:22px; box-shadow:0 4px 12px rgba(0,0,0,.06); }
  .article h1{ font-size:34px; line-height:1.25; margin:8px 0 10px }
  .article .meta{ color:var(--muted); font-size:13px; margin-bottom:18px }
  .article img{ width:100%; height:auto; border-radius:12px; margin:14px 0 16px; display:block; }
  .article p{ line-height:1.9; text-align:justify; }

  /* Sidebar komentar */
  .sidebar{ position:relative; }
  .sticky{ position:sticky; top:90px; }
  .card{ background:#fff; border:1px solid var(--ring); border-radius:14px; box-shadow:0 4px 12px rgba(0,0,0,.05); }
  .card .card-header{ padding:14px 16px; border-bottom:1px solid var(--ring); font-weight:700 }
  .card .card-body{ padding:14px 16px }
  .form-group{ margin-bottom:12px }
  .form-control{ width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:10px; font:inherit; }
  textarea.form-control{ min-height:110px; resize:vertical }
  .btn{ display:inline-block; padding:10px 16px; border:none; border-radius:10px; font-weight:700; cursor:pointer }
  .btn-primary{ background:var(--brand); color:#fff }
  .btn-icon{ padding:6px 10px; border:1px solid #d1d5db; background:#fff; border-radius:8px; font-weight:600; font-size:12px; cursor:pointer }
  .btn-icon:hover{ border-color:#9ca3af }
  .btn-danger{ background:#ef4444; color:#fff; border:1px solid #ef4444 }
  .btn-danger:hover{ filter:brightness(.95) }
  .alert{ background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; padding:10px 12px; border-radius:10px; margin-bottom:12px; font-size:14px }

  .komentar{ display:flex; flex-direction:column; gap:10px; }
  .komentar-item{ border-bottom:1px dashed var(--ring); padding-bottom:10px }
  .komentar .meta{ font-size:12px; color:var(--muted); margin-bottom:6px; display:flex; gap:8px; align-items:center }
  .komentar .text{ white-space:pre-wrap; line-height:1.7 }
  .row-actions{ margin-left:auto; display:flex; gap:8px }
  .hidden{ display:none }
</style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="nav-wrap">
      <a href="{{ route('berita.index') }}" class="brand-logo">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 17.3V6.7A.9.9 0 0 1 4.9 5.8H19.1A.9.9 0 0 1 20 6.7V17.3A.9.9 0 0 1 19.1 18.2H4.9A.9.9 0 0 1 4 17.3Z" stroke="#1f2937" stroke-width="1.5"/>
          <path d="M14.55 12L9.45 9.18V14.82L14.55 12Z" stroke="#1f2937" stroke-width="1.5" stroke-linejoin="round"/>
        </svg>
        <span>HIMA-TI</span>
      </a>
    </div>
  </nav>

  <!-- ISI HALAMAN -->
  <main class="page">

    <!-- Artikel berita -->
    <a href="{{ route('berita.index') }}" style="text-decoration:none;color:#007BFF;font-weight:700">
  &larr; Kembali ke Daftar Berita
</a>

      <h1>{{ $berita->judul }}</h1>
      @if(!empty($berita->kategori))
  <div style="margin-bottom:10px">
    <span style="
      display:inline-block;
      padding:4px 10px;
      font-size:12px;
      font-weight:600;
      color:#1d4ed8;
      background:#e0ecff;
      border-radius:999px;
    ">
      {{ strtoupper($berita->kategori) }}
    </span>
  </div>
@endif

      <div class="meta">
        @php
          $tgl = $berita->tanggal ?? $berita->Tanggal_berita ?? $berita->created_at;
        @endphp
        {{ $tgl ? \Carbon\Carbon::parse($tgl)->format('d F Y') : '' }}
        @if($berita->nama_penulis) • Penulis: {{ $berita->nama_penulis }} @endif
      </div>

    <img 
  src="{{ $berita->foto_url }}" 
  alt="{{ $berita->judul }}" 
  loading="lazy"
/>


      <div class="content">
        {!! nl2br(e($berita->isi)) !!}
      </div>
    </article>

    <!-- Sidebar komentar -->
    <aside class="sidebar">
      <div class="sticky">
        @if(session('success'))
          <div class="alert">{{ session('success') }}</div>
        @endif

        {{-- FORM KOMENTAR --}}
        <div class="card" style="margin-bottom:16px">
          <div class="card-header">Tulis Komentar</div>
          <div class="card-body">
            <form action="{{ route('berita.komentar.store', $berita->id_berita) }}" method="POST">
              @csrf
              <div class="form-group">
                <input type="text" name="nama" class="form-control" placeholder="Nama (opsional)" value="{{ old('nama') }}">
              </div>
              <div class="form-group">
                <textarea name="isi" class="form-control" placeholder="Tulis komentar..." required>{{ old('isi') }}</textarea>
                @error('isi') <div style="color:#b91c1c;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
              </div>
              <button class="btn btn-primary" type="submit">Kirim</button>
            </form>
          </div>
        </div>

        {{-- DAFTAR KOMENTAR --}}
        <div class="card">
          <div class="card-header">Komentar</div>
          <div class="card-body">
            @php($komentar = collect($berita->komentar))
            @if($komentar->isEmpty())
              <div style="color:var(--muted);font-size:14px">Belum ada komentar.</div>
            @else
              <div class="komentar">
                @foreach($komentar as $c)
                  <div class="komentar-item">
                    <div class="meta">
                      <strong>{{ $c->nama ?? 'Anonim' }}</strong>
                      <span>• {{ optional($c->created_at)->format('d M Y H:i') }}</span>

                      <div class="row-actions">
                        <button class="btn-icon" type="button" onclick="toggleEdit({{ $c->id }})">Edit</button>
                        <form action="{{ route('berita.komentar.destroy', [$berita->id_berita, $c->id]) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                          @csrf @method('DELETE')
                          <button class="btn-icon btn-danger" type="submit">Hapus</button>
                        </form>
                      </div>
                    </div>

                    {{-- Mode lihat --}}
                    <div id="view-text-{{ $c->id }}" class="text">{{ e($c->isi) }}</div>

                    {{-- Mode edit --}}
                    <form id="edit-form-{{ $c->id }}" class="hidden" action="{{ route('berita.komentar.update', [$berita->id_berita, $c->id]) }}" method="POST" style="margin-top:8px">
                      @csrf @method('PUT')
                      <div class="form-group">
                        <input type="text" name="nama" class="form-control" value="{{ $c->nama }}" placeholder="Nama">
                      </div>
                      <div class="form-group">
                        <textarea name="isi" class="form-control" rows="3" required>{{ $c->isi }}</textarea>
                      </div>
                      <div style="display:flex; gap:8px; justify-content:flex-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn-icon" type="button" onclick="toggleEdit({{ $c->id }})">Batal</button>
                      </div>
                    </form>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    </aside>
  </main>

  <script>
    function toggleEdit(id){
      const editForm = document.getElementById('edit-form-'+id);
      const viewText = document.getElementById('view-text-'+id);
      if(editForm){ editForm.classList.toggle('hidden'); }
      if(viewText){ viewText.classList.toggle('hidden'); }
      if(editForm && !editForm.classList.contains('hidden')) {
        editForm.scrollIntoView({behavior:'smooth', block:'center'});
      }
    }
  </script>
</body>
</html>
