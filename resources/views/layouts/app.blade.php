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
       body{
            margin:0;
            padding-top:50px;
            font-family:'Poppins',sans-serif;
            background:#f8fafc;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #5688de;
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
            max-width: 1300px;
            margin: 0 auto;
            padding: 10px 15px;
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

        .nav-menu{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .nav-link{
            display:flex;
            align-items:center;
            gap:8px;
            padding:8px 14px;
            border-radius:8px;
            text-decoration:none;
            color:#fff;
            font-weight:500;
            transition:.2s;
        }

       .nav-link:hover{
            background:rgba(255,255,255,.18);
        }

        .login-btn{
            background:#ffc107;
            color:#1e293b !important;
            padding:8px 16px;
            border-radius:8px;
            font-weight:600;
        }

        .login-btn:hover{
            background:#ffb300;
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

       .logo-wrap{
            display:flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
            color:#fff;
            font-weight:700;
            font-size:1.2rem;
        }


.logo-wrap img{
    width:42px;
    height:42px;
    object-fit:contain;
}

.logo-wrap span{
    font-weight:700;
    font-size:1.3rem;
    color:#0d6efd;
}
.hero {
    min-height: 100vh;
    width: 100vw;
    margin-left: calc(-50vw + 50%);

    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.hero-content {
    max-width: 1100px;
    width: 100%;
    padding: 0 24px;
}

.hero-content p {
    max-width: 900px;
    margin: 0 auto 32px;
}

.hero-buttons {
    display: flex;
    justify-content: center;
    gap: 16px;
}
/* Base button */
.hero-buttons .btn {
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
    display: inline-block;
}

/* OUTLINE PUTIH */
.hero-buttons .btn-primary,
.hero-buttons .btn-secondary {
    background: transparent;        /* NO FILL */
    border: 2px solid #ffffff;       /* GARIS PUTIH */
    color: #ffffff;                  /* TEKS PUTIH */
}

/* Hover effect */
.hero-buttons .btn-primary:hover,
.hero-buttons .btn-secondary:hover {
    background: #ffffff;
    color: #2563eb;                  /* biru kontras */
}
.hero-buttons .btn {
    padding: 12px 32px;
    border-radius: 999px;        /* 👉 BULAT HALUS (PILL) */
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
    display: inline-block;
}

/* Outline putih */
.hero-buttons .btn-primary,
.hero-buttons .btn-secondary {
    background: transparent;
    border: 2px solid #ffffff;
    color: #ffffff;
}

/* Hover */
.hero-buttons .btn-primary:hover,
.hero-buttons .btn-secondary:hover {
    background: #ffffff;
    color: #2563eb;
}



>>>>>>> a0053e8099db0ecdcfc821fda7d5bf38f17a2adb
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

        <a href="{{ url('/') }}" class="logo-wrap">
            <img src="{{ asset('images/logo-ti.png') }}" alt="Logo">
            SIMAWA
        </a>

        <div class="nav-menu" id="navMenu">
            <a href="/home" class="nav-link active"><i class="fa fa-house"></i>Home</a>
            <a href="/divisi" class="nav-link"><i class="fa fa-layer-group"></i>Divisi</a>
            <a href="/jabatan" class="nav-link"><i class="fa fa-sitemap"></i>Jabatan</a>
            <a href="/anggota" class="nav-link"><i class="fa fa-users"></i>Profil Anggota</a>
            <a href="/berita" class="nav-link"><i class="fa fa-newspaper"></i>Berita</a>
            <a href="/pendaftaran" class="nav-link"><i class="fa fa-clipboard-list"></i>Pendaftaran</a>
            <a href="/prestasi" class="nav-link"><i class="fa fa-award"></i>Prestasi</a>

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


