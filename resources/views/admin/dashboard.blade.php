<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - KEMAHASISWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h3>
                    <i class="fas fa-university"></i>
                    KEMAHASISWAAN
                </h3>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-section">
                    <div class="menu-section-title">Dashboard Admin</div>
                    <a href="#" class="menu-item active">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-database"></i>
                        Database
                    </a>
                </div>

                <div class="menu-section">
                    <div class="menu-section-title">Data Management</div>
                    <a href="#" class="menu-item">
                        <i class="fas fa-home"></i>
                        Data Auggets Home 1
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-comments"></i>
                        Data Chat
                        <span class="menu-badge">3</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-code"></i>
                        Data Auggets ProCode
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-file-alt"></i>
                        Data Process Files name
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-cubes"></i>
                        Data Applets
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-scroll"></i>
                        Scripts
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="top-header">
                <div class="header-title">
                    <h1>Dashboard Overview</h1>
                </div>
                <div class="header-actions">
                    <div class="user-menu">
                        <div class="user-avatar">AD</div>
                        <div class="user-info">
                            <div class="user-name">Admin Kemahasiswa</div>
                            <div class="user-role">Super Administrator</div>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card mahasiswa fade-in-up">
                        <div class="stat-content">
                            <div class="stat-info">
                                <div class="stat-number">1,250</div>
                                <div class="stat-label">TOTAL MAHASISWA</div>
                                <div class="stat-trend trend-up">
                                    <i class="fas fa-arrow-up"></i>
                                    5.2% increase
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card prestasi fade-in-up">
                        <div class="stat-content">
                            <div class="stat-info">
                                <div class="stat-number">89</div>
                                <div class="stat-label">PRESTASI</div>
                                <div class="stat-trend trend-up">
                                    <i class="fas fa-arrow-up"></i>
                                    12 baru bulan ini
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card pendaftaran fade-in-up">
                        <div class="stat-content">
                            <div class="stat-info">
                                <div class="stat-number">23</div>
                                <div class="stat-label">PENDAFTARAN BARU</div>
                                <div class="stat-trend trend-up">
                                    <i class="fas fa-arrow-up"></i>
                                    3 menunggu validasi
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card pelanggaran fade-in-up">
                        <div class="stat-content">
                            <div class="stat-info">
                                <div class="stat-number">15</div>
                                <div class="stat-label">PELANGGARAN</div>
                                <div class="stat-trend trend-down">
                                    <i class="fas fa-arrow-down"></i>
                                    20% decrease
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card bermasalah fade-in-up">
                        <div class="stat-content">
                            <div class="stat-info">
                                <div class="stat-number">8</div>
                                <div class="stat-label">MAHASISWA BERMASALAH</div>
                                <div class="stat-trend trend-up">
                                    <i class="fas fa-arrow-up"></i>
                                    2 kasus baru
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-user-slash"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Dashboard Grid -->
                <div class="dashboard-grid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Recent Activity -->
                        <div class="activity-card fade-in-up">
                            <div class="card-header">
                                <h3><i class="fas fa-history"></i>Aktivitas Terbaru</h3>
                                <a href="#" class="btn btn-primary btn-sm">Lihat Semua</a>
                            </div>
                            <div class="card-body">
                                <ul class="activity-list">
                                    <li class="activity-item">
                                        <div class="activity-icon success">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Pendaftaran anggota baru</div>
                                            <div class="activity-desc">John Doe mendaftar sebagai anggota baru</div>
                                        </div>
                                        <div class="activity-time">2 menit lalu</div>
                                    </li>
                                    <li class="activity-item">
                                        <div class="activity-icon warning">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Prestasi baru ditambahkan</div>
                                            <div class="activity-desc">Jane Smith menambah prestasi akademik</div>
                                        </div>
                                        <div class="activity-time">1 jam lalu</div>
                                    </li>
                                    <li class="activity-item">
                                        <div class="activity-icon danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Pelanggaran dicatat</div>
                                            <div class="activity-desc">Bob Johnson melakukan pelanggaran ringan</div>
                                        </div>
                                        <div class="activity-time">3 jam lalu</div>
                                    </li>
                                    <li class="activity-item">
                                        <div class="activity-icon purple">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Mahasiswa bermasalah</div>
                                            <div class="activity-desc">Laporan baru mahasiswa bermasalah</div>
                                        </div>
                                        <div class="activity-time">5 jam lalu</div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Management Sections -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="activity-card fade-in-up">
                                    <div class="card-header">
                                        <h3><i class="fas fa-trophy"></i>Kelola Prestasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="quick-actions">
                                            <a href="#" class="action-btn primary">
                                                <i class="fas fa-eye"></i>
                                                <div class="action-text">
                                                    <div class="action-title">Melihat Prestasi</div>
                                                    <div class="action-desc">Lihat daftar prestasi mahasiswa</div>
                                                </div>
                                            </a>
                                            <a href="#" class="action-btn success">
                                                <i class="fas fa-check-circle"></i>
                                                <div class="action-text">
                                                    <div class="action-title">Validasi Prestasi</div>
                                                    <div class="action-desc">Verifikasi prestasi mahasiswa</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="activity-card fade-in-up">
                                    <div class="card-header">
                                        <h3><i class="fas fa-clipboard-list"></i>Kelola Pendaftaran</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="quick-actions">
                                            <a href="#" class="action-btn warning">
                                                <i class="fas fa-user-plus"></i>
                                                <div class="action-text">
                                                    <div class="action-title">Mendaftar Keanggotaan</div>
                                                    <div class="action-desc">Proses pendaftaran anggota baru</div>
                                                </div>
                                            </a>
                                            <a href="#" class="action-btn info">
                                                <i class="fas fa-check-double"></i>
                                                <div class="action-text">
                                                    <div class="action-title">Validasi Pendaftaran</div>
                                                    <div class="action-desc">Verifikasi data pendaftaran</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="right-column">
                        <!-- Admin Info -->
                        <div class="admin-info-card fade-in-up">
                            <div class="admin-avatar">AK</div>
                            <h3>Admin Kemahasiswa</h3>
                            <p class="text-muted">Super Administrator</p>
                            <div class="admin-details">
                                <div class="detail-item">
                                    <i class="fas fa-id-card"></i>
                                    <span><strong>ROLE:</strong> ADMIN</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-building"></i>
                                    <span><strong>DIVISI:</strong> KEMAHASISWA</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-circle text-success"></i>
                                    <span><strong>STATUS:</strong> AKTIF</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar"></i>
                                    <span><strong>LAST LOGIN:</strong> Hari Ini</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="activity-card fade-in-up mt-4">
                            <div class="card-header">
                                <h3><i class="fas fa-bolt"></i>Aksi Cepat</h3>
                            </div>
                            <div class="card-body">
                                <div class="quick-actions">
                                    <a href="#" class="action-btn primary">
                                        <i class="fas fa-plus"></i>
                                        <div class="action-text">
                                            <div class="action-title">Tambah Berita</div>
                                            <div class="action-desc">Publikasi berita terbaru</div>
                                        </div>
                                    </a>
                                    <a href="#" class="action-btn success">
                                        <i class="fas fa-user-plus"></i>
                                        <div class="action-text">
                                            <div class="action-title">Tambah Anggota</div>
                                            <div class="action-desc">Input data anggota baru</div>
                                        </div>
                                    </a>
                                    <a href="#" class="action-btn danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <div class="action-text">
                                            <div class="action-title">Kelola Pelanggaran</div>
                                            <div class="action-desc">Catat pelanggaran mahasiswa</div>
                                        </div>
                                    </a>
                                    <a href="#" class="action-btn purple">
                                        <i class="fas fa-user-slash"></i>
                                        <div class="action-text">
                                            <div class="action-title">Mahasiswa Bermasalah</div>
                                            <div class="action-desc">Kelola kasus mahasiswa</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add staggered animation delay
            const fadeElements = document.querySelectorAll('.fade-in-up');
            fadeElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>