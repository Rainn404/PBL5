@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4ade80;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1e293b;
        --light: #f8fafc;
        --gradient: linear-gradient(135deg, #5875f5 0%, #632ae6 100%);
    }

    .prestasi-hero {
        background: var(--gradient);
        color: white;
        padding: 3rem 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    .main-content {
        padding: 3rem 0;
        background: #f8f9fa;
        min-height: 60vh;
    }

    .content-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--dark);
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-primary-custom {
        background: var(--gradient);
        color: white;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .filter-row {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 180px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
        font-size: 0.9rem;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .prestasi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .prestasi-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .prestasi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-disetujui {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #991b1b;
    }

    .kategori-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #e0e7ff;
        color: var(--primary);
    }

    .card-body {
        padding: 1.25rem;
    }

    .prestasi-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--dark);
        line-height: 1.4;
    }

    .prestasi-meta {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: #64748b;
    }

    .meta-item i {
        width: 16px;
        color: var(--primary);
    }

    .prestasi-deskripsi {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .user-details h6 {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark);
    }

    .user-details span {
        font-size: 0.8rem;
        color: #64748b;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-edit {
        background: #e0e7ff;
        color: var(--primary);
    }

    .btn-edit:hover {
        background: var(--primary);
        color: white;
    }

    .btn-delete {
        background: #fee2e2;
        color: var(--danger);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #cbd5e1;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .stats-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .prestasi-grid {
            grid-template-columns: 1fr;
        }

        .filter-row {
            flex-direction: column;
        }

        .filter-group {
            min-width: 100%;
        }
    }
</style>

<!-- Hero Section -->
<section class="prestasi-hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Galeri Prestasi Mahasiswa Teknologi Informasi</h1>
            <p class="hero-subtitle">
                Jelajahi berbagai prestasi akademik dan non-akademik yang telah ditorehkan oleh mahasiswa
            </p>
        
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="main-content">
    <div class="container">
        <!-- Header dengan Tombol Ajukan -->
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Daftar Prestasi</h2>
                <a href="{{ route('users.prestasi.create') }}" class="btn-custom btn-primary-custom">
                    <i class="fas fa-plus-circle"></i>
                    Ajukan Prestasi
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="{{ route('users.prestasi.index') }}">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-control-custom">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-control-custom">
                            <option value="">Semua Kategori</option>
                            <option value="Akademik" {{ request('kategori') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="Non-Akademik" {{ request('kategori') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                            <option value="Olahraga" {{ request('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                            <option value="Seni" {{ request('kategori') == 'Seni' ? 'selected' : '' }}>Seni & Budaya</option>
                            <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control-custom">
                            <option value="">Semua Status</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <button type="submit" class="btn-custom btn-primary-custom w-100">
                            <i class="fas fa-filter"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Daftar Prestasi -->
        <div class="content-card">
            @if($prestasi->count() > 0)
                <div class="prestasi-grid">
                    @foreach($prestasi as $item)
                    <div class="prestasi-card">
                        <div class="card-header">
                            <span class="status-badge 
                                @if($item->status_validasi == 'disetujui') status-disetujui
                                @elseif($item->status_validasi == 'pending') status-pending
                                @else status-ditolak @endif">
                                {{ $item->status_validasi }}
                            </span>
                            <span class="kategori-badge">{{ $item->kategori }}</span>
                        </div>
                        
                        <div class="card-body">
                            <h3 class="prestasi-title">{{ $item->nama_prestasi }}</h3>
                            
                            <div class="prestasi-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Semester {{ $item->semester }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-id-card"></i>
                                    <span>NIM: {{ $item->nim }}</span>
                                </div>
                                @if($item->ipk)
                                <div class="meta-item">
                                    <i class="fas fa-star"></i>
                                    <span>IPK: {{ $item->ipk }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <p class="prestasi-deskripsi">{{ $item->deskripsi }}</p>
                        </div>
                        
                        <div class="card-footer">
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($item->user->name, 0, 2) }}
                                </div>
                                <div class="user-details">
                                    <h6>{{ $item->user->name }}</h6>
                                    <span>{{ $item->email }}</span>
                                </div>
                            </div>
                            
                            <div class="card-actions">
                                @if(Auth::user()->role === 'admin' || $item->id_user === Auth::id())
                            <a href="{{ route('users.prestasi.edit', $item->id_prestasi) }}" class="btn-icon btn-edit" title="Edit">

                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                                @if(Auth::user()->role === 'admin')
                               <form action="{{ route('prestasi.destroy', $item->id_prestasi) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-icon btn-delete" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
        <i class="fas fa-trash"></i>
    </button>
</form>

                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-trophy"></i>
                    <h3>Tidak ada prestasi ditemukan</h3>
                    <p>Silakan coba dengan filter yang berbeda atau ajukan prestasi baru.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($prestasi->count() > 0)
            <div class="pagination-container">
                {{ $prestasi->links() }}
            </div>
        @endif
    </div>
</section>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi hover card
        const cards = document.querySelectorAll('.prestasi-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection