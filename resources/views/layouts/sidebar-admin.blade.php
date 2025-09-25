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
            <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="nav-link {{ Request::routeIs('admin.mahasiswa-bermasalah.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <span>Mahasiswa Bermasalah</span>
            </a>
        </li>
        
 <li class="nav-item">
            <a href="{{ route('berita.index') }}" class="nav-link {{ Request::routeIs('berita.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper me-3"></i>
                <span>Berita</span>
            </a>
        </li>
        

 <li class="nav-item">
            <a href="{{ route('pendaftaran.index') }}" class="nav-link {{ Request::routeIs('pendaftaran.*') ? 'active' : '' }}">
                <i class="fas fa-user-check me-3"></i>
                <span>Pendaftaran</span>
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
            <a href="#" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt me-3"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>