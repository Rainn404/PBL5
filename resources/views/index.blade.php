<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pendaftaran Hima-TI Politala</title>
    <!-- Tambahkan Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .banner {
            background-color: #1a73e8;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .card {
            margin-top: 30px;
            padding: 20px;
        }
        .btn-daftar {
            background-color: #28a745;
            color: white;
        }
        .btn-daftar:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/40" alt="Logo" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">DIVISI</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PROFIL</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">BERITA</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PENDAFTARAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PRESTASI MAHASISWA</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">KOTAK ASPIRASI</a></li>
                    <li class="nav-item"><a class="btn btn-outline-primary ms-3" href="#">LOGIN</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <h3>Portal Pendaftaran Anggota Baru Hima-TI Politala</h3>
        <p>Temukan informasi pendaftaran dan berita terbaru di HIMA-TI Politala</p>
    </div>

    <!-- Form Section -->
    <div class="container">
        <div class="card shadow">
            <h4 class="text-center mb-3">Form Pendaftaran Anggota Baru Hima-TI Politala</h4>
            <p class="text-center">Berisi Form Pendaftaran Hima-TI Politala</p>
            <div class="text-center">
                <a href="#" class="btn btn-daftar">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
