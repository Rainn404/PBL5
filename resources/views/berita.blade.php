<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Home & Berita</title>

<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

<style>
  :root{
    --brand:#007BFF;
    --brand-dark:#0056b3;
    --accent:#f7b500;
    --muted:#6b7280;
    --bg-soft:#eaf7e9;
    --card-shadow:0 10px 30px rgba(31,79,214,.10), 0 2px 6px rgba(0,0,0,.06);
  }

  /* Reset & Font */
  *{box-sizing:border-box}
  html{scroll-behavior:smooth}
  html,body{
    margin:0;
    color:#0f172a;
    background:#f9fafb;
    font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Arial,Helvetica,sans-serif;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
  }

  /* NAVBAR (gaya seperti screenshot) */
  .navbar{
    position:sticky; top:0; z-index:50;
    background:#fff;
    border-bottom:1px solid #edf0f4;
    box-shadow:0 4px 16px rgba(0,0,0,.06);
  }
  .nav-wrap{
    max-width:1100px; margin:auto;
    display:flex; align-items:center; gap:16px;
    padding:12px 18px; height:70px;
  }
  .brand-logo{
    display:flex; align-items:center; gap:10px;
    text-decoration:none; color:#1f2937; font-weight:700; font-size:20px;
  }
  .brand-logo svg{ background-color:var(--brand); border-radius:6px; padding:4px }

  /* MENU modern underline */
  .menu{ display:flex; gap:8px; margin-left:auto; flex-wrap:wrap; align-items:center }
  .menu a{
    position:relative; text-decoration:none; color:#1f2937;
    font-size:15px; font-weight:500; padding:8px 12px; border-radius:8px;
    transition:color .25s ease;
  }
  .menu a:hover{ color:var(--brand) }
  .menu a::after{
    content:''; position:absolute; left:12px; right:12px; bottom:6px;
    height:2px; background:var(--brand); width:0%; transition:width .25s ease;
  }
  .menu a:hover::after, .menu a.active::after{ width:calc(100% - 24px) }
  .menu a.active{ color:var(--brand); font-weight:600 }

  .btn-solid{
    background:var(--brand); color:#fff; padding:10px 18px;
    border-radius:10px; font-weight:600; cursor:pointer; text-decoration:none;
    transition:background .25s ease, transform .1s ease;
    margin-left:8px;
  }
  .btn-solid:hover{ background:var(--brand-dark) }
  .btn-solid:active{ transform:translateY(1px) }

  /* HERO */
  .hero{
    background: linear-gradient(135deg, #64b5f6 0%, #1a73e8 100%);
    color:#fff; text-align:left; padding:72px 18px 60px;
  }
  .hero-content{ max-width:1100px; margin:0 auto }
  .hero-content h1{
    margin:0 0 14px; font-size:48px; font-weight:700; letter-spacing:-0.5px;
  }
  .hero-content p{
    margin:0; font-size:18px; opacity:.95; max-width:640px;
  }

  /* GRID BERITA */
  .container{max-width:1100px;margin:18px auto 40px;padding:0 18px;text-align:center}
  .section-title{margin:12px 0 8px;font-size:22px;letter-spacing:.6px}
  .grid{margin-top:14px;display:grid;gap:18px;grid-template-columns:repeat(3,1fr)}
  .card-link{text-decoration:none;color:inherit;display:block;transition:transform .2s ease, box-shadow .2s ease;}
  .card-link:hover{transform:translateY(-5px);box-shadow:0 12px 24px rgba(0,0,0,0.1);}
  .card{border:1px solid #e5e7eb; border-radius:12px;overflow:hidden;background:#fff;box-shadow:0 2px 6px rgba(0,0,0,.04)}
  .card-inner{background:#fff; padding:14px;display:flex;flex-direction:column;align-items:center;height:100%;}
  .photo{width:100%;height:160px;background:#e5e7eb;border-radius:10px;display:grid;place-items:center;color:#555;font-weight:700;margin-bottom:12px;overflow:hidden;}
  .photo img{width:100%;height:100%;object-fit:cover;}
  .card-title{
    color:#1f2937; font-weight:700; margin-top:auto; font-size:16px;
    text-align:left; width:100%; margin-bottom:8px; flex-grow:1; padding:5px 5px;
  }

  /* LIST VIEW */
  .list-view-container{ margin-top:60px }
  .news-list-item{
    display:flex; gap:24px; margin-bottom:24px; text-align:left; background:#fff;
    border:1px solid #e5e7eb; border-radius:12px; padding:16px; transition: box-shadow .2s ease;
  }
  .news-list-item:hover{ box-shadow:0 8px 16px rgba(0,0,0,0.08) }
  .news-list-image{ flex-shrink:0; width:250px; height:160px; border-radius:8px; overflow:hidden }
  .news-list-image img{ width:100%; height:100%; object-fit:cover }
  .news-list-content h2{ margin:0 0 8px; font-size:20px }
  .news-list-content h2 a{ text-decoration:none; color:#1f2937 }
  .news-list-content h2 a:hover{ color:var(--brand) }
  .news-meta{ font-size:12px; color:var(--muted); margin-bottom:12px }
  .news-meta span{ margin-right:16px }
  .news-excerpt{ font-size:14px; line-height:1.7; color:#374151; margin-bottom:16px }
  .btn-read-more{
    display:inline-block; background:var(--accent); color:#1f2937; padding:8px 16px;
    border-radius:8px; font-weight:700; font-size:13px; text-decoration:none; transition:filter .2s;
  }
  .btn-read-more:hover{ filter:brightness(.95) }

  /* DETAIL BERITA */
  .article-container{max-width:900px;margin:40px auto;padding:24px;background:#fff;border-radius:16px;box-shadow:0 4px 12px rgba(0,0,0,0.08);text-align:left;}
  .article-title{font-size:34px;font-weight:800;margin-bottom:8px;line-height:1.25;}
  .article-date{color:var(--muted);margin-bottom:24px;font-size:14px;}
  .article-image{width:100%;border-radius:12px;margin-bottom:24px;}
  .article-content h3{font-size:20px;margin-top:30px;}
  .article-content p{line-height:1.9;color:#1f2937;text-align:justify;}

  .back-button{display:inline-block;margin-bottom:20px;color:var(--brand);font-weight:700;text-decoration:none;cursor:pointer;}
  .back-button:hover{text-decoration:underline;}

  /* KOMENTAR */
  .discussion-forum{margin-top:40px;}
  .discussion-forum h3{font-size:20px;margin-bottom:16px;}
  .discussion-forum textarea{width:100%;min-height:100px;padding:12px;border:1px solid #ddd;border-radius:10px;font-family:'Poppins',Arial,sans-serif;font-size:15px;resize:vertical;}
  .discussion-forum .submit-btn{display:block;margin-top:12px;margin-left:auto;padding:10px 24px;border:none;background-color:#28a745;color:white;font-weight:700;border-radius:10px;cursor:pointer;transition:filter .2s;}
  .discussion-forum .submit-btn:hover{filter:brightness(.95)}

  .comments-list{ margin-top:20px; display:flex; flex-direction:column; gap:12px; }
  .comment-item{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:12px; box-shadow:0 1px 2px rgba(0,0,0,.04) }
  .comment-meta{ font-size:12px; color:var(--muted); margin-bottom:8px; display:flex; gap:10px; flex-wrap:wrap; }
  .comment-text{ font-size:14px; line-height:1.7; color:#1f2937; white-space:pre-wrap; }
  .comment-actions{ display:flex; gap:10px; margin-top:10px; }
  .comment-actions .btn{ border:none; padding:6px 10px; border-radius:8px; font-weight:600; cursor:pointer }
  .comment-actions .btn-edit{ background:#e0f2fe; color:#0369a1 }
  .comment-actions .btn-edit:hover{ filter:brightness(.95) }
  .comment-actions .btn-delete{ background:#fee2e2; color:#b91c1c }
  .comment-actions .btn-delete:hover{ filter:brightness(.95) }

  /* FOOTER (full width) */
  .footer{
    background-color:#2c3e50; color:#ecf0f1; padding:50px 18px 20px; margin-top:60px;
  }
  .footer-container{
    max-width:1100px; margin:auto; display:grid; grid-template-columns:2fr 1fr 1.5fr; gap:40px;
  }
  .footer-col h3{ font-size:18px; margin-bottom:20px; position:relative; padding-bottom:10px; color:#fff }
  .footer-col h3::after{ content:''; position:absolute; left:0; bottom:0; background-color:var(--brand); height:2px; width:50px }
  .footer-col p{ font-size:14px; line-height:1.8; color:#bdc3c7 }
  .social-links{ margin-top:20px }
  .social-links a{
    display:inline-flex; align-items:center; justify-content:center; height:40px; width:40px;
    background-color:rgba(255,255,255,0.1); margin-right:10px; border-radius:50%; color:#ffffff; transition:all .3s ease;
  }
  .social-links a:hover{ background-color:#ffffff; color:#2c3e50 }
  .social-links a svg{ width:20px; height:20px }
  .footer-col ul{ list-style:none; padding:0 }
  .footer-col ul li:not(:last-child){ margin-bottom:10px }
  .footer-col ul li a{ font-size:15px; text-decoration:none; color:#bdc3c7; transition:color .3s ease, padding-left .3s ease }
  .footer-col ul li a:hover{ color:#ffffff; padding-left:5px }
  .contact-info li{ display:flex; align-items:flex-start; gap:12px; margin-bottom:15px !important; color:#bdc3c7; font-size:15px }
  .contact-info li svg{ flex-shrink:0; margin-top:4px }
  .footer-bottom{ text-align:center; padding-top:20px; margin-top:40px; border-top:1px solid #3a4b60; font-size:14px; color:#95a5a6 }

  /* RESPONSIVE */
  @media (max-width:900px){
    .grid{grid-template-columns:repeat(2,1fr)}
    .footer-container{grid-template-columns: 1fr 1fr;}
  }
  @media (max-width:768px){
    .menu{display:none}
    .hero-content h1, .article-title{font-size:28px}
    .news-list-item{flex-direction:column}
    .news-list-image{width:100%;height:200px}
  }
  @media (max-width:580px){
    .grid{grid-template-columns:1fr}
    .footer-container{grid-template-columns:1fr}
  }
  @media (max-width:480px){
    .hero-content h1{font-size:26px}
    .hero-content p{font-size:16px}
  }
</style>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="nav-wrap">
      <a href="#" class="brand-logo">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 17.2727V6.72727C4 6.27364 4.40455 5.81818 4.90909 5.81818H19.0909C19.5955 5.81818 20 6.27364 20 6.72727V17.2727C20 17.7264 19.5955 18.1818 19.0909 18.1818H4.90909C4.40455 18.1818 4 17.7264 4 17.2727Z" stroke="white" stroke-width="1.5"/>
          <path d="M14.5455 12.0002L9.45455 9.18201V14.8184L14.5455 12.0002Z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/>
        </svg>
        <span>HIMA-TI</span>
      </a>

      <div class="menu">
        <a href="#home" class="active">Home</a>
        <a href="#divisi">Divisi</a>
        <a href="#profil">Profil Anggota</a>
        <a href="#berita">Berita</a>
        <a href="#pendaftaran">Pendaftaran</a>
        <a href="#prestasi">Prestasi</a>
      </div>

      <a href="#" class="btn-solid">Masuk/Login</a>
    </div>
  </nav>

  <!-- HERO -->
  <header id="home" class="hero">
    <div class="hero-content">
      <h1>HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</h1>
      <p>Wadah pengembangan potensi mahasiswa Teknik Informatika dalam bidang teknologi, kepemimpinan, dan sosial.</p>
    </div>
  </header>

  <!-- LIST BERITA -->
  <div id="berita-container">
    <main id="berita-list" class="container">
      <h3 class="section-title">BERITA TERKINI</h3>
      <section class="grid">
        <a href="#" class="card-link" data-id="1">
          <article class="card">
            <div class="card-inner">
              <div class="photo"><img src="https://maukuliah.ap-south-1.linodeobjects.com/gallery/005039/Gedung%201%20Politala-thumbnail.jpg" alt="Gedung Politeknik Negeri Tanah Laut"></div>
              <div class="card-title">Pelantikan Direktur Baru Politeknik Negeri Tanah Laut Periode 2025-2029</div>
            </div>
          </article>
        </a>
        <a href="#" class="card-link" data-id="2">
          <article class="card">
            <div class="card-inner">
              <div class="photo"><img src="https://tse4.mm.bing.net/th/id/OIP.F4wM9aYCVO1Br5Re5wQCqQHaE7?pid=Api&P=0&h=220" alt="Mahasiswa berprestasi lomba public speaking"></div>
              <div class="card-title">Pencapaian Mahasiswa Berprestasi Dalam Mengikuti Perlombaan Public Speaking Tingkat Nasional</div>
            </div>
          </article>
        </a>
        <a href="#" class="card-link" data-id="3">
          <article class="card">
            <div class="card-inner">
              <div class="photo"><img src="https://tse3.mm.bing.net/th/id/OIP.tA36pmSxfAQwD4LwRf6TOQHaE8?pid=Api&P=0&h=220" alt="Suasana acara Dies Natalis Politala"></div>
              <div class="card-title">Dies Natalis Politeknik Negeri Tanah laut 2025</div>
            </div>
          </article>
        </a>
      </section>

      <div class="list-view-container">
        <h3 class="section-title">BERITA LAINNYA</h3>
        <section>
          <article class="news-list-item">
            <div class="news-list-image">
              <img src="https://politala.ac.id/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-02-at-09.03.30.jpeg" alt="Workshop Kurikulum">
            </div>
            <div class="news-list-content">
              <h2><a href="#" class="card-link" data-id="4">Workshop Pengembangan Kurikulum Program Studi Teknologi Informasi</a></h2>
              <div class="news-meta">
                <span>Posted by <strong>HUMAS TI</strong></span>
                <span>Categories <strong>AKADEMIK</strong></span>
              </div>
              <p class="news-excerpt">Program Studi Teknologi Informasi mengadakan workshop intensif untuk meninjau dan mengembangkan kurikulum agar sejalan dengan kebutuhan industri 4.0...</p>
              <a href="#" class="btn-read-more card-link" data-id="4">READ MORE</a>
            </div>
          </article>

          <article class="news-list-item">
            <div class="news-list-image">
              <img src="https://politala.ac.id/wp-content/uploads/2024/12/WhatsApp-Image-2024-12-16-at-15.13.50.jpeg" alt="Kompetisi Robotik">
            </div>
            <div class="news-list-content">
              <h2><a href="#" class="card-link" data-id="5">Mahasiswa TI Politala Raih Juara Harapan di Kompetisi Robotik Nasional</a></h2>
              <div class="news-meta">
                <span>Posted by <strong>HUMAS TI</strong></span>
                <span>Categories <strong>PRESTASI</strong></span>
              </div>
              <p class="news-excerpt">Tim robotik dari HIMA-TI berhasil membawa pulang gelar Juara Harapan dalam ajang Kontes Robot Indonesia (KRI) yang diselenggarakan secara nasional...</p>
              <a href="#" class="btn-read-more card-link" data-id="5">READ MORE</a>
            </div>
          </article>

          <article class="news-list-item">
            <div class="news-list-image">
              <img src="https://politala.ac.id/wp-content/uploads/2023/03/IMG_0233-2048x1365.jpg" alt="Kerjasama Industri">
            </div>
            <div class="news-list-content">
              <h2><a href="#" class="card-link" data-id="6">Politala Jalin Kerjasama Strategis dengan Perusahaan Teknologi Ternama</a></h2>
              <div class="news-meta">
                <span>Posted by <strong>HUMAS TI</strong></span>
                <span>Categories <strong>KERJASAMA</strong></span>
              </div>
              <p class="news-excerpt">Dalam upaya meningkatkan kualitas lulusan, Politala menandatangani Nota Kesepahaman (MoU) dengan beberapa perusahaan teknologi terkemuka di Indonesia...</p>
              <a href="#" class="btn-read-more card-link" data-id="6">READ MORE</a>
            </div>
          </article>
        </section>
      </div>
    </main>

    <!-- DETAIL BERITA -->
    <main id="berita-detail" class="article-container" style="display:none;">
      <a id="back-to-list" href="#" class="back-button">&larr; Kembali ke Daftar Berita</a>
      <h1 id="detail-title" class="article-title"></h1>
      <p id="detail-date" class="article-date"></p>
      <img id="detail-image" src="" alt="" class="article-image">
      <div id="detail-content" class="article-content">
        <h3>Deskripsi Berita</h3>
        <p></p><p></p>
      </div>

      <div class="discussion-forum">
        <h3>Forum Diskusi</h3>
        <textarea id="comment-input" placeholder="Tulis komentar Anda di sini..."></textarea>
        <button id="comment-submit" class="submit-btn">Kirim</button>

        <!-- Daftar komentar -->
        <div id="comments-list" class="comments-list"></div>
      </div>
    </main>
  </div>

  <!-- FOOTER -->
  <footer id="footer" class="footer">
    <div class="footer-container">
      <div class="footer-col">
        <h3>HIMA-TI</h3>
        <p>Himpunan Mahasiswa Teknik Informatika - Wadah bagi mahasiswa untuk mengembangkan potensi dan berkontribusi dalam dunia teknologi informasi.</p>
        <div class="social-links">
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/></svg></a>
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z"/></svg></a>
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"/></svg></a>
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M10,15L15.19,12L10,9V15M21.56,7.17C21.69,7.64 21.78,8.27 21.84,9.07C21.91,9.87 21.94,10.56 21.94,11.16L22,12C22,14.19 21.84,15.8 21.56,16.83C21.31,17.73 20.73,18.31 19.83,18.56C19.36,18.69 18.73,18.78 17.93,18.84C17.13,18.91 16.44,18.94 15.84,18.94L15,19C12.81,19 11.2,18.84 10.17,18.56C9.27,18.31 8.69,17.73 8.44,16.83C8.31,16.36 8.22,15.73 8.16,14.93C8.09,14.13 8.06,13.44 8.06,12.84L8,12C8,9.81 8.16,8.2 8.44,7.17C8.69,6.27 9.27,5.69 10.17,5.44C10.64,5.31 11.27,5.22 12.07,5.16C12.87,5.09 13.56,5.06 14.16,5.06L15,5C17.19,5 18.8,5.16 19.83,5.44C20.73,5.69 21.31,6.27 21.56,7.17Z"/></svg></a>
        </div>
      </div>
      <div class="footer-col">
        <h3>Menu Cepat</h3>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#berita">Berita</a></li>
          <li><a href="#">Profil Anggota</a></li>
          <li><a href="#">Pendaftaran</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Kontak</h3>
        <ul class="contact-info">
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/></svg>
            <span>Gedung Teknik Informatika, Kampus Universitas</span>
          </li>
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/></svg>
            <span>himati@universitas.ac.id</span>
          </li>
          <li>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/></svg>
            <span>+62 812 3456 7890</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2023 HIMA-TI. All rights reserved.
    </div>
  </footer>

<script>
  // --- DATABASE MINI BERITA ---
  const newsData = {
    "1":{title:"Pelantikan Direktur Baru Politeknik Negeri Tanah Laut Periode 2025-2029",date:"30 September 2025",image:"https://maukuliah.ap-south-1.linodeobjects.com/gallery/005039/Gedung%201%20Politala-thumbnail.jpg",content:[
      "Prosesi pelantikan direktur baru Politeknik Negeri Tanah Laut (Politala) untuk periode 2025-2029 telah berhasil dilaksanakan dengan khidmat. Acara ini menandai dimulainya era kepemimpinan baru yang diharapkan dapat membawa inovasi dan kemajuan signifikan bagi institusi.",
      "Dalam sambutannya, direktur terpilih menyampaikan visi dan misinya untuk menjadikan Politala sebagai pusat pendidikan vokasi unggulan yang mampu bersaing di tingkat nasional maupun internasional."
    ]},
    "2":{title:"Pencapaian Mahasiswa Berprestasi Dalam Mengikuti Perlombaan Public Speaking Tingkat Nasional",date:"15 Agustus 2025",image:"https://tse4.mm.bing.net/th/id/OIP.F4wM9aYCVO1Br5Re5wQCqQHaE7?pid=Api&P=0&h=220",content:[
      "Mahasiswa dari Program Studi Teknologi Informasi berhasil mengharumkan nama Politeknik Negeri Tanah Laut dengan meraih juara kedua dalam ajang Lomba Public Speaking tingkat nasional. Kompetisi ini diikuti oleh puluhan mahasiswa dari berbagai perguruan tinggi di Indonesia.",
      "Prestasi ini membuktikan bahwa kualitas mahasiswa Politala tidak hanya unggul dalam bidang teknis, tetapi juga dalam kemampuan berkomunikasi dan penyampaian gagasan yang efektif."
    ]},
    "3":{title:"Dies Natalis Politeknik Negeri Tanah laut 2025",date:"25 Juli 2025",image:"https://tse3.mm.bing.net/th/id/OIP.tA36pmSxfAQwD4LwRf6TOQHaE8?pid=Api&P=0&h=220",content:[
      "Perayaan Dies Natalis Politeknik Negeri Tanah Laut ke-16 berlangsung meriah dengan berbagai rangkaian acara, mulai dari seminar nasional, kompetisi olahraga, hingga malam puncak pentas seni. Acara ini bertujuan untuk mempererat tali persaudaraan di antara seluruh civitas academica.",
      "Tema yang diusung tahun ini adalah 'Inovasi Berkelanjutan untuk Kemajuan Bangsa', yang mencerminkan komitmen Politala untuk terus berkontribusi dalam pembangunan melalui pendidikan dan teknologi."
    ]},
    "4":{title:"Workshop Pengembangan Kurikulum Program Studi Teknologi Informasi",date:"20 Juli 2025",image:"https://politala.ac.id/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-02-at-09.03.30.jpeg",content:[
      "Program Studi Teknologi Informasi mengadakan workshop intensif selama dua hari untuk meninjau dan mengembangkan kurikulum agar sejalan dengan kebutuhan industri 4.0. Acara ini melibatkan para akademisi, praktisi industri, dan alumni.",
      "Hasil dari workshop ini diharapkan dapat menghasilkan lulusan yang lebih siap kerja dan mampu beradaptasi dengan perkembangan teknologi yang pesat."
    ]},
    "5":{title:"Mahasiswa TI Politala Raih Juara Harapan di Kompetisi Robotik Nasional",date:"10 Juni 2025",image:"https://politala.ac.id/wp-content/uploads/2024/12/WhatsApp-Image-2024-12-16-at-15.13.50.jpeg",content:[
      "Tim robotik dari HIMA-TI, 'RoboTala', berhasil membawa pulang gelar Juara Harapan dalam ajang Kontes Robot Indonesia (KRI) yang diselenggarakan secara nasional. Kompetisi ini menantang peserta untuk merancang dan membangun robot cerdas.",
      "Keberhasilan ini menjadi motivasi bagi mahasiswa lain untuk terus berinovasi dan berprestasi di kancah nasional."
    ]},
    "6":{title:"Politala Jalin Kerjasama Strategis dengan Perusahaan Teknologi Ternama",date:"05 Mei 2025",image:"https://politala.ac.id/wp-content/uploads/2023/03/IMG_0233-2048x1365.jpg",content:[
      "Dalam upaya meningkatkan kualitas lulusan dan relevansi kurikulum, Politala menandatangani Nota Kesepahaman (MoU) dengan beberapa perusahaan teknologi terkemuka di Indonesia. Kerjasama ini mencakup program magang, kuliah tamu, dan riset bersama.",
      "Langkah strategis ini diharapkan dapat menjembatani kesenjangan antara dunia akademik dan industri, serta membuka peluang karir yang lebih luas bagi para lulusan."
    ]}
  };

  // --- STATE & ELEM
  const beritaList = document.getElementById('berita-list');
  const beritaDetail = document.getElementById('berita-detail');
  const cardLinks = document.querySelectorAll('.card-link');
  const backButton = document.getElementById('back-to-list');

  let currentNewsId = null;

  // --- UTIL
  const commentsKey = id => `comments_${id}`;
  const escapeHTML = str => { const d=document.createElement('div'); d.textContent=str; return d.innerHTML; };
  const formatDateTime = ts => new Date(ts).toLocaleString('id-ID',{day:'2-digit',month:'short',year:'numeric',hour:'2-digit',minute:'2-digit'});

  const loadComments = id => {
    try{ const raw=localStorage.getItem(commentsKey(id)); const arr=raw?JSON.parse(raw):[]; return Array.isArray(arr)?arr:[]; }
    catch{ return []; }
  };
  const saveComments = (id,arr) => localStorage.setItem(commentsKey(id), JSON.stringify(arr));

  // --- RENDER KOMENTAR
  function renderComments() {
    const listEl = document.getElementById('comments-list');
    if (!listEl || !currentNewsId) return;
    const comments = loadComments(currentNewsId);

    if (comments.length === 0) {
      listEl.innerHTML = `<div class="comment-item"><div class="comment-text" style="color:var(--muted)">Belum ada komentar. Jadilah yang pertama!</div></div>`;
      return;
    }

    listEl.innerHTML = comments.map((c, idx) => `
      <div class="comment-item" data-idx="${idx}">
        <div class="comment-meta">
          <span><strong>Anonim</strong></span><span>•</span>
          <span>${formatDateTime(c.createdAt || Date.now())}</span>
        </div>
        <div class="comment-text">${escapeHTML(c.text || '')}</div>
        <div class="comment-actions">
          <button class="btn btn-edit" data-action="edit" data-idx="${idx}">Edit</button>
          <button class="btn btn-delete" data-action="delete" data-idx="${idx}">Hapus</button>
        </div>
      </div>
    `).join('');
  }

  // --- SHOW DETAIL
  function showDetail(newsId){
    const data = newsData[newsId]; if(!data) return;
    currentNewsId = newsId;

    document.getElementById('detail-title').textContent = data.title;
    document.getElementById('detail-date').textContent = data.date;
    const img = document.getElementById('detail-image');
    img.src = data.image; img.alt = data.title;
    const ps = document.getElementById('detail-content').querySelectorAll('p');
    ps[0].textContent = data.content[0] || '';
    ps[1].textContent = data.content[1] || '';

    beritaList.style.display='none';
    beritaDetail.style.display='block';
    window.scrollTo(0,0);

    renderComments();
  }

  // --- BACK
  function showList(){
    beritaDetail.style.display='none';
    beritaList.style.display='block';
    currentNewsId=null;
  }

  // Events
  cardLinks.forEach(link=>{
    link.addEventListener('click',e=>{
      e.preventDefault();
      showDetail(link.dataset.id);
    });
  });
  backButton.addEventListener('click',e=>{ e.preventDefault(); showList(); });

  // Komentar: submit/edit/delete (delegasi)
  document.addEventListener('click', function(e){
    const t = e.target;

    if (t.id === 'comment-submit') {
      const textarea = document.getElementById('comment-input');
      const text = (textarea.value||'').trim();
      if (!currentNewsId) return alert('Silakan pilih berita terlebih dahulu.');
      if (!text) { textarea.focus(); return; }
      const arr = loadComments(currentNewsId);
      arr.push({ text, createdAt: Date.now() });
      saveComments(currentNewsId, arr);
      textarea.value = '';
      renderComments();
      return;
    }

    if (t.matches('[data-action="edit"]')) {
      const idx = Number(t.dataset.idx);
      const arr = loadComments(currentNewsId);
      const cur = arr[idx]; if (!cur) return;
      const newText = prompt('Edit komentar:', cur.text || '');
      if (newText === null) return;
      const trimmed = newText.trim(); if (!trimmed) return alert('Komentar tidak boleh kosong.');
      arr[idx].text = trimmed; saveComments(currentNewsId, arr); renderComments();
      return;
    }

    if (t.matches('[data-action="delete"]')) {
      const idx = Number(t.dataset.idx);
      const arr = loadComments(currentNewsId);
      if (arr[idx] == null) return;
      if (!confirm('Hapus komentar ini?')) return;
      arr.splice(idx,1); saveComments(currentNewsId, arr); renderComments();
      return;
    }
  });
</script>
</body>
</html>
