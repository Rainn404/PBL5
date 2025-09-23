<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HIMA-TI - Himpunan Mahasiswa Teknik Informatika')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


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
                <a href="{{ url('/') }}" class="nav-link">Home</a>
                <a href="{{ url('/divisi') }}" class="nav-link">Divisi</a>
                <a href="{{ url('/anggota') }}" class="nav-link">Profil Anggota</a>
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
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/divisi') }}">Divisi</a></li>
                    <li><a href="{{ url('/anggota') }}">Profil Anggota</a></li>
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
            <p>&copy; 2023 HIMA-TI. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

