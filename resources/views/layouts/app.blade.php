<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HIMA-TI - Himpunan Mahasiswa Teknik Informatika')</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* === Navbar Fix === */
        body {
            margin: 0;
            padding-top: 80px; /* Memberi ruang untuk navbar fixed */
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .user-menu {
    background: #fff;
    border-radius: 8px;
    padding: 8px 0;
    min-width: 160px;
    border: 1px solid #e2e8f0;
    z-index: 9999 !important;
}

.user-menu li {
    list-style: none;
}

.user-menu .dropdown-item {
    display: block;
    padding: 10px 16px;
    color: #1e293b;
    text-decoration: none;
    font-weight: 500;
}

.user-menu .dropdown-item:hover {
    background: #f1f5f9;
}

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo a {
            text-decoration: none;
            color: #0d6efd;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo i {
            font-size: 1.4rem;
        }

        .nav-menu {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #1e293b;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #0d6efd;
        }

        .login-btn {
            background: #0d6efd;
            color: #fff !important;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .login-btn:hover {
            background: #2563eb;
        }

        /* === Responsive Navbar === */
        .nav-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .nav-toggle .bar {
            width: 25px;
            height: 3px;
            background: #1e293b;
            margin: 4px 0;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .nav-menu {
                position: absolute;
                top: 70px;
                right: 0;
                background: #fff;
                flex-direction: column;
                width: 200px;
                padding: 16px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: none;
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-toggle {
                display: flex;
            }
        }

        /* === Footer === */
        .footer {
            background: #000000;
            color: #fff;
            margin-top: 60px;
            padding-top: 40px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            padding: 0 20px;
        }

        .footer-section {
            flex: 1 1 300px;
        }

        .footer-section h3 {
            margin-bottom: 15px;
            font-weight: 700;
        }

        .footer-section p, .footer-section ul {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer-section ul li a:hover {
            text-decoration: underline;
        }

        .social-links a {
            color: #fff;
            margin-right: 10px;
            font-size: 1.3rem;
        }

        .footer-bottom {
            text-align: center;
            padding: 16px;
            background: rgba(0,0,0,0.1);
            font-size: 0.9rem;
            margin-top: 20px;
        }
/* ==========================
   BERITA TERBARU LAYOUT
========================== */

.berita-wrapper {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.berita-slider {
    border-radius: 16px;
    overflow: hidden;
}

.berita-bawah {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.berita-bawah .berita-card {
    display: flex;
    gap: 12px;
    padding: 12px;
    min-height: 90px;
}

.berita-bawah img {
    width: 90px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
}

.berita-bawah h4 {
    font-size: 14px;
    line-height: 1.4;
    margin: 0;
}

.berita-bawah span {
    font-size: 12px;
    color: #64748b;
}

.berita-action {
    margin-top: 10px;
    text-align: center;
}

.btn-lihat {
    display: inline-block;
    padding: 12px 28px;
    border: 1.8px solid #2563eb;
    color: #2563eb;
    border-radius: 999px;
    font-weight: 600;
    transition: .25s ease;
}

.btn-lihat:hover {
    background: #2563eb;
    color: white;
}
/* SLIDER */
.berita-slider {
    position: relative;
    overflow: hidden;
    border-radius: 16px;

    display: flex;              /* 🔥 INI KUNCINYA */
    scroll-behavior: smooth;
}

.slider-item {
    flex: 0 0 100%;              /* 🔥 PAKSA 1 SLIDE = 1 LAYAR */
    height: 420px;
    position: relative;
}


.slider-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slider-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 24px;
    background: linear-gradient(to top, rgba(0,0,0,.75), transparent);
    color: white;
}

.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,.5);
    color: white;
    border: none;
    font-size: 28px;
    padding: 10px 14px;
    cursor: pointer;
    z-index: 10;
}

.slider-btn.prev { left: 16px; }
.slider-btn.next { right: 16px; }

@media (max-width: 768px) {
    .slider-item {
        height: 260px;
    }
}
/* === CAPTION SLIDER === */
.slider-caption {
    position: absolute;
    bottom: 32px;
    left: 40px;
    right: 40px;
    z-index: 15;
    color: #ffffff;
    max-width: 900px;
}

/* TANGGAL */
.slider-date {
    font-size: 14px;
    font-weight: 600;
    opacity: 0.9;
    margin-bottom: 6px;
    display: block;
}

/* JUDUL */
.slider-title {
    font-size: 30px;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 12px;
    text-shadow: 0 3px 12px rgba(0,0,0,0.6);
}

/* DESKRIPSI */
.slider-desc {
    font-size: 16px;
    font-weight: 500;
    line-height: 1.7;
    text-align: justify;
    text-shadow: 0 2px 10px rgba(0,0,0,0.6);
    max-width: 820px;
}

/* BERITA BAWAH */
.berita-bawah {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.berita-kecil {
    display: flex;
    gap: 12px;
    background: white;
    border-radius: 12px;
    padding: 12px;
}

.berita-kecil img {
    width: 90px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
}
.btn-berita-mini {
    display: inline-block;
    margin-top: 6px;
    padding: 6px 14px;
    border: 1.5px solid #2563eb;
    color: #2563eb;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s ease;
}

.btn-berita-mini:hover {
    background: #2563eb;
    color: #fff;
}
/* === FIX BUTTON SLIDER === */
.btn-berita-slider {
    position: relative;
    z-index: 20;
    display: inline-block;
    margin-top: 14px;
    padding: 10px 22px;
    background: #2563eb;
    color: #ffffff !important;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(0,0,0,.25);
    transition: all .25s ease;
}

.btn-berita-slider:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}
/* === BUTTON LIHAT SEMUA BERITA === */
.btn-lihat-semua {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 28px;
    border-radius: 50px;
    border: 2px solid #2563eb;
    color: #2563eb;
    background: transparent;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-lihat-semua:hover {
    background: #2563eb;
    color: white;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

    </style>

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById("beritaSlider");
    let index = 0;

    function slideNext() {
        const total = slider.children.length;
        index = (index + 1) % total;
        slider.scrollTo({
            left: slider.clientWidth * index,
            behavior: "smooth"
        });
    }

    // AUTO SLIDE
    setInterval(slideNext, 5000);

    // SWIPE SUPPORT
    let startX = 0;

    slider.addEventListener("mousedown", e => startX = e.pageX);
    slider.addEventListener("mouseup", e => {
        if (e.pageX < startX - 50) slideNext();
        if (e.pageX > startX + 50) {
            index = Math.max(index - 1, 0);
            slider.scrollTo({
                left: slider.clientWidth * index,
                behavior: "smooth"
            });
        }
    });

    slider.addEventListener("touchstart", e => startX = e.touches[0].clientX);
    slider.addEventListener("touchend", e => {
        const endX = e.changedTouches[0].clientX;
        if (endX < startX - 50) slideNext();
        if (endX > startX + 50) {
            index = Math.max(index - 1, 0);
            slider.scrollTo({
                left: slider.clientWidth * index,
                behavior: "smooth"
            });
        }
    });
});
</script>


<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <a href="{{ url('/') }}">
                <i class="fas fa-laptop-code"></i>
                <span>HIMA-TI</span>
            </a>
        </div>

        <div class="nav-menu" id="navMenu">
            <a href="{{ url('/home') }}" class="nav-link">Home</a>
            <a href="{{ url('/divisi') }}" class="nav-link">Divisi</a>
            <a href="{{ url('/jabatan') }}" class="nav-link">Jabatan</a>
            <a href="{{ url('/anggota') }}" class="nav-link">Profil Anggota</a>
            <a href="{{ url('/berita') }}" class="nav-link">Berita</a>
            <a href="{{ url('/pendaftaran') }}" class="nav-link">Pendaftaran</a>
            <a href="{{ url('/prestasi') }}" class="nav-link">Prestasi</a>

            @guest
                <!-- Jika belum login -->
                <a href="{{ route('login') }}" class="nav-link login-btn">Masuk/Login</a>
            @endguest

@auth
    {{-- Jika ADMIN → pakai dropdown --}}
    @if(Auth::user()->role === 'admin')

        <div class="relative">

            <!-- Tombol menu admin -->
            <button id="userMenuToggle"
                class="p-2 rounded-md border bg-white shadow-sm hover:bg-gray-100"
                style="font-size: 22px;">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Dropdown admin -->
            <ul id="userMenuPanel"
                class="user-menu shadow"
                style="
                    display:none;
                    position:fixed;
                    right:20px;
                    top:70px;
                    z-index:99999;
                ">

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard Admin
                    </a>
                </li>

                <li><hr class="dropdown-divider my-1"></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="dropdown-item text-danger">
                            Logout
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Script toggle --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const toggle = document.getElementById("userMenuToggle");
                const panel = document.getElementById("userMenuPanel");

                toggle.addEventListener("click", () => {
                    panel.style.display = panel.style.display === "block" ? "none" : "block";
                });

                document.addEventListener("click", function (e) {
                    if (!toggle.contains(e.target) && !panel.contains(e.target)) {
                        panel.style.display = "none";
                    }
                });
            });
        </script>

    {{-- Jika USER BIASA → tampilkan logout saja --}}
    @else

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link text-red-600 font-semibold hover:text-red-700"
                    style="background:none;border:none;cursor:pointer;">
                Logout <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>

    @endif
@endauth

        </div>

        <div class="nav-toggle" id="navToggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>HIMA-TI</h3>
                <p>Himpunan Mahasiswa Teknik Informatika - Wadah bagi mahasiswa untuk mengembangkan potensi dan berkontribusi dalam dunia teknologi informasi.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Menu Cepat</h3>
                <ul>
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/divisi') }}">Divisi</a></li>
                    <li><a href="{{ url('/jabatan') }}">Jabatan</a></li>
                    <li><a href="{{ url('/anggota') }}">Profil Anggota</a></li>
                    <li><a href="{{ url('/mahasiswa') }}">Data Mahasiswa</a></li>
                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p><i class="fas fa-map-marker-alt"></i> Gedung Teknik Informatika, Kampus Universitas</p>
                <p><i class="fas fa-envelope"></i> himati@universitas.ac.id</p>
                <p><i class="fas fa-phone"></i> +62 812 3456 7890</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} HIMA-TI. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const toggle = document.getElementById('navToggle');
        const menu = document.getElementById('navMenu');
        toggle.addEventListener('click', () => menu.classList.toggle('show'));
    </script>
</body>
</html>


