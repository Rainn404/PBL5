<nav id="sidebar" class="sidebar bg-white shadow-sm">
    <div class="sidebar-header bg-primary text-white text-center py-4">
        <h4 class="mb-0 fw-bold">HIMA Dashboard</h4>
        <small class="opacity-75">Sistem Manajemen</small>
    </div>

    <ul class="sidebar-nav list-unstyled px-3 py-3">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-3"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- Anggota --}}
        <li class="nav-item">
            <a href="{{ route('admin.anggota.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.anggota.*') ? 'active' : '' }}">
                <i class="fas fa-users me-3"></i>
                <span>Kelola Anggota</span>
            </a>
        </li>
        {{-- Jabatan --}}
        <li class="nav-item">
            <a href="{{ route('admin.jabatan.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.jabatan.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie me-3"></i>
                <span>Kelola Jabatan</span>
            </a>
        </li>
        {{-- Divisi --}}
        <li class="nav-item">
            <a href="{{ route('admin.divisi.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.divisi.*') ? 'active' : '' }}">
                <i class="fas fa-building me-3"></i>
                <span>Kelola Divisi</span>
            </a>
        </li>
        {{-- Prestasi --}}
        <li class="nav-item">
            <a href="{{ route('admin.prestasi.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.prestasi.*') ? 'active' : '' }}">
                <i class="fas fa-trophy me-3"></i>
                <span>Kelola Prestasi</span>
            </a>
        </li>
        {{-- Kelola Mahasiswa --}}
        <li class="nav-item">
            <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate me-3"></i>
                <span>Kelola Mahasiswa</span>
            </a>
        </li>
        {{-- Mahasiswa Bermasalah --}}
        <li class="nav-item">
            <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.mahasiswa-bermasalah.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <span>Mahasiswa Bermasalah</span>
            </a>
        </li>
        {{-- Berita --}}
        <li class="nav-item">
            <a href="{{ route('admin.berita.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper me-3"></i>
                <span>Berita dan Komentar</span>
            </a>
        </li>
        {{-- Pendaftaran --}}
        <li class="nav-item">
            <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                <i class="fas fa-user-check me-3"></i>
                <span>Pendaftaran</span>
            </a>
        </li>
        {{-- Data Pelanggaran --}}
        <li class="nav-item">
            <a href="{{ route('admin.pelanggaran.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.pelanggaran.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-circle me-3"></i>
                <span>Data Pelanggaran</span>
            </a>
        </li>
        {{-- Data Sanksi --}}
        <li class="nav-item">
            <a href="{{ route('admin.sanksi.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.sanksi.*') ? 'active' : '' }}">
                <i class="fas fa-gavel me-3"></i>
                <span>Data Sanksi</span>
            </a>
        </li>

        <li class="nav-divider"></li>
        
        {{-- Perbandingan AHP --}}
        <li class="nav-item">
            <a href="{{ route('admin.ahp.perbandingan') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.ahp.perbandingan') ? 'active' : '' }}">
                <i class="fas fa-balance-scale me-3"></i>
                <span>Perbandingan AHP</span>
            </a>
        </li>
        {{-- Hitung AHP --}}
        <li class="nav-item">
            <a href="{{ route('admin.ahp.hitung') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.ahp.hitung') ? 'active' : '' }}">
                <i class="fas fa-calculator me-3"></i>
                <span>Hitung AHP</span>
            </a>
        </li>
        {{-- Hasil Perhitungan --}}
        <li class="nav-item">
            <a href="{{ route('admin.ahp.hasil') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.ahp.hasil') ? 'active' : '' }}">
                <i class="fas fa-chart-bar me-3"></i>
                <span>Hasil Perhitungan</span>
            </a>
        </li>
        {{-- Ranking SAW --}}
        <li class="nav-item">
            <a href="{{ route('admin.ahp.ranking') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.ahp.ranking') ? 'active' : '' }}">
                <i class="fas fa-medal me-3"></i>
                <span>Ranking Mahasiswa</span>
            </a>
        </li>
        {{-- Kelola Kriteria --}}
        <li class="nav-item">
            <a href="{{ route('admin.kriteria.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.kriteria.*') ? 'active' : '' }}">
                <i class="fas fa-list-alt me-3"></i>
                <span>Kelola Kriteria</span>
            </a>
        </li>

        <li class="nav-divider"></li>

        {{-- Pergi ke Beranda --}}
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link d-flex align-items-center">
                <i class="fas fa-home me-3"></i>
                <span>Pergi ke Beranda</span>
            </a>
        </li>
        {{-- Pengaturan --}}
        <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center">
                <i class="fas fa-cog me-3"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        {{-- Logout --}}
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="nav-link d-flex align-items-center text-danger border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt me-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</nav>

<style>
.sidebar {
    width: 260px;
    min-height: 100vh;
    position: fixed;
    top: 0; left: 0;
    background: #fff;
    border-right: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    overflow-y: auto;
    z-index: 1000;
}

.sidebar-header {
    border-bottom: 1px solid rgba(255,255,255,.2);
}

.sidebar-nav .nav-item {
    margin-bottom: 2px;
}

.sidebar-nav .nav-link {
    display: flex;
    align-items: center;
    padding: 10px 14px;
    border-radius: 8px;
    color: #374151;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all .2s ease;
    text-decoration: none;
}

.sidebar-nav .nav-link:hover {
    background: rgba(0,123,255,0.08);
    color: #007BFF;
}

.sidebar-nav .nav-link.active {
    background: #007BFF;
    color: #fff !important;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0,123,255,0.3);
}

.sidebar-nav .nav-link.active i {
    color: #fff !important;
}

.sidebar-nav i {
    width: 20px;
    text-align: center;
    font-size: 0.875rem;
}

.nav-divider {
    border-top: 1px solid #e5e7eb;
    margin: 12px 0;
    list-style: none;
}

/* Scrollbar styling */
.sidebar::-webkit-scrollbar {
    width: 4px;
}

.sidebar::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>
