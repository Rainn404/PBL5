<nav id="sidebar" class="sidebar">
    <div class="sidebar-header bg-primary text-white text-center py-4">
        <h4 class="mb-0 fw-bold">HIMA Dashboard</h4>
        <small class="opacity-75">Sistem Manajemen</small>
    </div>
    
    <ul class="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-3"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <!-- Data Master -->
        <li class="nav-header">DATA MASTER</li>
        
        <li class="nav-item">
            <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate me-3"></i>
                <span>Data Mahasiswa</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.anggota.index') }}" class="nav-link {{ Request::routeIs('admin.anggota.*') ? 'active' : '' }}">
                <i class="fas fa-users me-3"></i>
                <span>Kelola Anggota</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.divisi.index') }}" class="nav-link {{ Request::routeIs('admin.divisi.*') ? 'active' : '' }}">
                <i class="fas fa-building me-3"></i>
                <span>Kelola Divisi</span>
            </a>
        </li>
        
        <!-- Prestasi & Akademik -->
        <li class="nav-header">PRESTASI & AKADEMIK</li>
        
        <li class="nav-item">
            <a href="{{ route('admin.prestasi.index') }}" class="nav-link {{ Request::routeIs('admin.prestasi.*') ? 'active' : '' }}">
                <i class="fas fa-trophy me-3"></i>
                <span>Kelola Prestasi</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa-bermasalah.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <span>Mahasiswa Bermasalah</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.pelanggaran-sanksi.index') }}" class="nav-link {{ Request::routeIs('admin.pelanggaran-sanksi.*') ? 'active' : '' }}">
                <i class="fas fa-balance-scale me-3"></i>
                <span>Pelanggaran & Sanksi</span>
            </a>
        </li>
        
        <!-- Konten & Informasi -->
        <li class="nav-header">KONTEN & INFORMASI</li>
        
        <li class="nav-item">
            <a href="{{ route('admin.berita.index') }}" class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper me-3"></i>
                <span>Kelola Berita</span>
            </a>
        </li>
        
        <!-- Pendaftaran & Keanggotaan -->
        <li class="nav-header">PENDAFTARAN</li>
        
        <li class="nav-item">
            <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ Request::routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                <i class="fas fa-user-check me-3"></i>
                <span>Kelola Pendaftaran</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.pendaftaran-settings') }}" class="nav-link {{ Request::routeIs('admin.pendaftaran-settings') ? 'active' : '' }}">
                <i class="fas fa-cogs me-3"></i>
                <span>Settings Pendaftaran</span>
            </a>
        </li>
        
        <!-- Laporan & Data -->
        <li class="nav-header">LAPORAN & DATA</li>
        
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-chart-bar me-3"></i>
                <span>Laporan & Analytics</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.data.users') }}">
                        <i class="fas fa-users me-2"></i>Data Users
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.data.auggets') }}">
                        <i class="fas fa-chart-pie me-2"></i>Statistik
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.data.applets') }}">
                        <i class="fas fa-cube me-2"></i>Aplikasi
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.data.scripts') }}">
                        <i class="fas fa-code me-2"></i>Scripts
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- System -->
        <li class="nav-header">SYSTEM</li>
        
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-cog me-3"></i>
                <span>Pengaturan Sistem</span>
            </a>
        </li>
        
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt me-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</nav>

<style>
.sidebar {
    background: #f8f9fa;
    border-right: 1px solid #dee2e6;
    min-height: 100vh;
}

.sidebar-header {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-header {
    padding: 1rem 1.5rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: #6c757d;
    letter-spacing: 0.5px;
}

.nav-item {
    margin: 0;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    color: #495057;
    text-decoration: none;
    border: none;
    background: transparent;
    width: 100%;
    text-align: left;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background: #e9ecef;
    color: #495057;
}

.nav-link.active {
    background: #4361ee;
    color: white;
    border-right: 3px solid #3a0ca3;
}

.nav-link i {
    width: 20px;
    text-align: center;
}

.nav-divider {
    height: 1px;
    background: #dee2e6;
    margin: 1rem 0;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 8px;
}

.dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.dropdown-item:hover {
    background: #f8f9fa;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        min-height: auto;
    }
    
    .nav-link {
        padding: 1rem 1.5rem;
    }
}
</style>

<script>
// Initialize dropdowns
document.addEventListener('DOMContentLoaded', function() {
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    });
});
</script>