<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - HIMA Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #030304;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --black-color: #020203;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
        }
        
        #wrapper {
            display: flex;
        }
        
        /* Sidebar Styles */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: #fff;
            color: #000000;
            transition: all 0.3s;
            min-height: 100vh;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        #sidebar .sidebar-header {
            padding: 25px 20px;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: #fff;
            text-align: center;
        }
        
        #sidebar .sidebar-header h4 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.5rem;
        }
        
        #sidebar .sidebar-header small {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .sidebar-nav .nav-section {
            padding: 0 20px;
            margin-bottom: 25px;
        }
        
        .sidebar-nav .nav-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--secondary-color);
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }
        
        .sidebar-nav .nav-item {
            margin-bottom: 8px;
        }
        
        .sidebar-nav .nav-link {
            color: #010202;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
        }
        
        .sidebar-nav .nav-link:hover {
            color: var(--primary-color);
            background-color: #f8f9fa;
        }
        
        .sidebar-nav .nav-link.active {
            color: var(--primary-color);
            background-color: #eef2ff;
            font-weight: 600;
        }
        
        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 12px;
            font-size: 1rem;
        }
        
        .sidebar-nav .checkbox-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .sidebar-nav .checkbox-item:hover {
            background-color: #f8f9fa;
        }
        
        .sidebar-nav .checkbox-item.checked {
            color: var(--primary-color);
            background-color: #eef2ff;
            font-weight: 600;
        }
        
        .sidebar-nav .checkbox-icon {
            width: 18px;
            height: 18px;
            border: 2px solid #d1d3e2;
            border-radius: 3px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .sidebar-nav .checkbox-item.checked .checkbox-icon {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .sidebar-nav .checkbox-item.checked .checkbox-icon::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        
        .nav-divider {
            height: 1px;
            background: #e3e6f0;
            margin: 20px;
        }
        
        /* Content Styles */
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 8px;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            border-radius: 12px;
        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
            padding: 20px;
            border-radius: 12px 12px 0 0 !important;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                min-width: 80px;
                max-width: 80px;
            }
            
            #sidebar .sidebar-header h4,
            #sidebar .sidebar-header small,
            #sidebar .nav-link span,
            #sidebar .nav-section-title,
            #sidebar .checkbox-item span {
                display: none;
            }
            
            #sidebar .nav-link {
                padding: 15px;
                justify-content: center;
            }
            
            #sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            #sidebar .checkbox-item {
                padding: 15px;
                justify-content: center;
            }
            
            #sidebar .checkbox-icon {
                margin-right: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header bg-primary text-white text-center py-4">
                <h4 class="mb-0 fw-bold">HIMA Dashboard</h4>
                <small class="opacity-75">Sistem Manajemen</small>
            </div>
            
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.anggota.index') }}" class="nav-link {{ Request::routeIs('admin.anggota.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-3"></i>
                        <span>Kelola Anggota</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.jabatan.index') }}" class="nav-link {{ Request::routeIs('admin.jabatan.*') ? 'active' : '' }}">
                        <i class="fas fa-briefcase me-3"></i>
                        <span>Kelola Jabatan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.divisi.index') }}" class="nav-link {{ Request::routeIs('admin.divisi.*') ? 'active' : '' }}">
                        <i class="fas fa-building me-3"></i>
                        <span>Kelola Divisi</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.prestasi.index') }}" class="nav-link {{ Request::routeIs('admin.prestasi.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy me-3"></i>
                        <span>Kelola Prestasi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate me-3"></i>
                        <span>Data Mahasiswa</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa-bermasalah.*') ? 'active' : '' }}">
                        <i class="fas fa-exclamation-triangle me-3"></i>
                        <span>Mahasiswa Bermasalah</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.berita.index') }}" class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper me-3"></i>
                        <span>Berita</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ Request::routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                        <i class="fas fa-user-check me-3"></i>
                        <span>Pendaftaran</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pelanggaran.index') }}" class="nav-link {{ Request::routeIs('admin.pelanggaran.*') ? 'active' : '' }}">
                        <i class="fas fa-exclamation-circle me-3"></i>
                        <span>Data Pelanggaran</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.sanksi.index') }}" class="nav-link {{ Request::routeIs('admin.sanksi.*') ? 'active' : '' }}">
                        <i class="fas fa-balance-scale me-3"></i>
                        <span>Data Sanksi</span>
                    </a>
                </li>
                
                <li class="nav-divider"></li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog me-3"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                
<li class="nav-item">
    <a href="{{ route('logout') }}" 
       class="nav-link text-danger"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt me-3"></i>
        <span>Logout</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>

<script>
    document.getElementById('logout-form').addEventListener('submit', function (e) {
        // Hapus token sesi Google dari localStorage (biar gak auto-login)
        localStorage.clear();

        // Setelah logout dari Laravel, arahkan ke halaman login Google
        setTimeout(() => {
            window.location.href = "{{ route('google.login') }}";
        }, 500);
    });
</script>

            </ul>
        </nav>

        <!-- Content -->
        <div id="content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                Admin User
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main>
                <!-- Notifications -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Sidebar Toggle
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut(300);
            }, 5000);
        });

        // CSRF Token setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Global alert function
        function showAlert(type, message) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('main').prepend(alertHtml);
            
            setTimeout(() => {
                $('.alert').alert('close');
            }, 5000);
        }
    </script>
    
    @stack('scripts')
</body>
</html>