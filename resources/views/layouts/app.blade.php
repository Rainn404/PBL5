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
    </style>
=======
    <script src="https://cdn.tailwindcss.com"></script>
>>>>>>> 72d34e1 (update mahasiswa bermasalah)
</head>

<body>
    <!-- Navbar -->
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
                <a href="{{ url('/anggota') }}" class="nav-link">Profil Anggota</a>
                <a href="{{ url('/mahasiswa') }}" class="nav-link">Data Mahasiswa</a>
                <a href="{{ url('/berita') }}" class="nav-link">Berita</a>
                <a href="{{ url('/pendaftaran') }}" class="nav-link">Pendaftaran</a>
                <a href="{{ url('/prestasi') }}" class="nav-link">Prestasi</a>
                <a href="{{ url('/login') }}" class="nav-link login-btn">Masuk/Login</a>
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


