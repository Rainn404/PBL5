<nav id="sidebar" class="sidebar bg-white shadow-sm">
    <div class="sidebar-header bg-primary text-white text-center py-4">
        <h4 class="mb-0 fw-bold">HIMA Dashboard</h4>
        <small class="opacity-75">Sistem Manajemen</small>
    </div>
    

    <ul class="sidebar-nav list-unstyled px-3 py-3">
        {{-- Dashboard --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">

                <i class="fas fa-home me-3"></i>
                <span>Dashboard</span>
            </a>
        </li>


        {{-- Anggota --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.anggota.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.anggota.*') ? 'active' : '' }}">

                <i class="fas fa-users me-3"></i>
                <span>Kelola Anggota</span>
            </a>
        </li>

        {{-- Divisi --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.divisi.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.divisi.*') ? 'active' : '' }}">
                <i class="fas fa-building me-3"></i>
                <span>Kelola Divisi</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.jabatan.index') }}" class="nav-link {{ Request::routeIs('admin.jabatan.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie me-3"></i>
                <span>Kelola Jabatan</span>
            </a>
        </li>
        
        <!-- Prestasi & Akademik -->
        <li class="nav-header">PRESTASI & AKADEMIK</li>
        
        <li class="nav-item">
            <a href="{{ route('admin.prestasi.index') }}" class="nav-link {{ Request::routeIs('admin.prestasi.*') ? 'active' : '' }}">

        {{-- Prestasi --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.prestasi.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.prestasi.*') ? 'active' : '' }}">
                <i class="fas fa-trophy me-3"></i>
                <span>Kelola Prestasi</span>
            </a>
        </li>


        {{-- Mahasiswa Bermasalah --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.mahasiswa-bermasalah.*') ? 'active' : '' }}">

        <!-- Tambahkan Data Mahasiswa di sini -->
        <li class="nav-item">
            <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate me-3"></i>
                <span>Data Mahasiswa</span>
            </a>
        </li>
        
        <!-- Tambahkan Mahasiswa Bermasalah di sini -->
        <li class="nav-item">
            <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa-bermasalah.*') ? 'active' : '' }}">)
                <i class="fas fa-exclamation-triangle me-3"></i>
                <span>Mahasiswa Bermasalah</span>
            </a>
        </li>



        {{-- Berita --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.berita.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}">
           
        <li class="nav-item">
            <a href="{{ route('admin.berita.index') }}" class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}">


                <i class="fas fa-newspaper me-3"></i>
                <span>Kelola Berita</span>
            </a>
        </li>



        {{-- Pendaftaran --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('admin.pendaftaran.*') ? 'active' : '' }}">

        
        <li class="nav-item">
            <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ Request::routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                <i class="fas fa-user-check me-3"></i>
                <span>Kelola Pendaftaran</span>
            </a>
        </li>

        <li class="nav-divider my-3 border-top"></li>

        {{-- Pengaturan --}}
        <li class="nav-item mb-1">
            <a href="#" class="nav-link d-flex align-items-center">
        

        <!-- Tambahkan Data Pelanggaran di sini -->
        <li class="nav-item">
            <a href="{{ route('admin.pelanggaran.index') }}" class="nav-link {{ Request::routeIs('admin.pelanggaran.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-circle me-3"></i>
                <span>Data Pelanggaran</span>
            </a>
        </li>
        
        <!-- Tambahkan Data Master Sanksi di sini -->
        <li class="nav-item">
            <a href="{{ route('admin.sanksi.index') }}" class="nav-link {{ Request::routeIs('admin.sanksi.*') ? 'active' : '' }}">
                <i class="fas fa-balance-scale me-3"></i>
                <span>Data Sanksi</span>

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

{{-- === Styling Sidebar === --}}
<style>
.sidebar {
    width: 250px;
    min-height: 100vh;
    position: fixed;
    top: 0; left: 0;
    background: #fff;
    border-right: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.sidebar-header {
    border-bottom: 1px solid rgba(255,255,255,.2);
}

.sidebar-nav .nav-link {
    display: flex;
    align-items: center;
    padding: 10px 14px;
    border-radius: 8px;
    color: #374151;
    font-weight: 500;
    transition: all .2s ease;
}

.sidebar-nav .nav-link:hover {
    background: rgba(0,123,255,0.08);
    color: #007BFF;
}

.sidebar-nav .nav-link.active {
    background: #007BFF;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0,123,255,0.3);
}

.sidebar-nav i {
    width: 22px;

    text-align: center;
}

.nav-divider {

    border-top: 1px solid #e5e7eb;
    margin: 10px 0;
}
</style>

