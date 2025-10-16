@extends('layouts.app_admin')

@section('title', 'Kelola Prestasi - Admin HIMA-TI')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title mb-2">
                        <i class="fas fa-trophy me-2"></i>Kelola Prestasi
                    </h1>
                    <p class="mb-0">Kelola dan validasi semua prestasi mahasiswa</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="admin-badges">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-user-shield me-1"></i>Administrator
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-2 col-6 mb-3">
                <div class="admin-stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalPrestasi }}</div>
                        <div class="stat-label">Total</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="admin-stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $prestasiMenunggu }}</div>
                        <div class="stat-label">Menunggu</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="admin-stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $prestasiTervalidasi }}</div>
                        <div class="stat-label">Tervalidasi</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="admin-stat-card">
                    <div class="stat-icon bg-danger">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $prestasiDitolak }}</div>
                        <div class="stat-label">Ditolak</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="admin-stat-card">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalUsers }}</div>
                        <div class="stat-label">Mahasiswa</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="admin-stat-card">
                    <div class="stat-icon bg-secondary">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ number_format($rataRataIPK, 2) }}</div>
                        <div class="stat-label">Rata IPK</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-label">Filter Status</div>
                    <select class="form-select" id="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="Menunggu Validasi" {{ request('status') == 'Menunggu Validasi' ? 'selected' : '' }}>Menunggu Validasi</option>
                        <option value="Tervalidasi" {{ request('status') == 'Tervalidasi' ? 'selected' : '' }}>Tervalidasi</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="filter-label">Filter Kategori</div>
                    <select class="form-select" id="categoryFilter">
                        <option value="all">Semua Kategori</option>
                        <option value="Akademik" {{ request('kategori') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Non-Akademik" {{ request('kategori') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                        <option value="Olahraga" {{ request('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="Seni" {{ request('kategori') == 'Seni' ? 'selected' : '' }}>Seni</option>
                        <option value="Teknologi" {{ request('kategori') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                        <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="filter-label">Cari Prestasi</div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari prestasi..." id="searchInput" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="button" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="filter-label">Aksi</div>
                    <div class="d-grid">
                        <a href="{{ route('admin.prestasi.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Tambah Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-actions-section mb-3">
            <div class="card">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label fw-semibold" for="selectAll">
                                    Pilih Semua
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm" id="bulkApproveBtn" disabled>
                                    <i class="fas fa-check-circle me-1"></i>Validasi Massal
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" id="bulkRejectBtn" disabled>
                                    <i class="fas fa-times-circle me-1"></i>Tolak Massal
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" id="bulkDeleteBtn" disabled>
                                    <i class="fas fa-trash me-1"></i>Hapus Massal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card">
            <div class="card-body p-0">
                <!-- Alert Notifikasi -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if($prestasi->isEmpty())
                <div class="empty-state text-center py-5">
                    <i class="fas fa-trophy text-primary fa-4x mb-4"></i>
                    <h3 class="mb-3">Belum ada prestasi</h3>
                    <p class="text-muted mb-4">Tidak ada data prestasi yang ditemukan</p>
                    <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Tambah Prestasi Pertama
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" width="50">
                                    <input type="checkbox" class="form-check-input" id="selectAllHeader">
                                </th>
                                <th>#</th>
                                <th>Mahasiswa</th>
                                <th>Prestasi</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestasi as $item)
                            <tr class="prestasi-item" data-id="{{ $item->id_prestasi ?? $item->id }}">
                                <td class="ps-4">
                                    <input type="checkbox" class="form-check-input prestasi-checkbox" value="{{ $item->id_prestasi ?? $item->id }}">
                                </td>
                                <td>{{ $loop->iteration + ($prestasi->currentPage() - 1) * $prestasi->perPage() }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <strong class="d-block">{{ $item->user->name ?? 'N/A' }}</strong>
                                            <small class="text-muted">{{ $item->user->nim ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="d-block">{{ $item->nama_prestasi ?? $item->nama }}</strong>
                                    <small class="text-muted">
                                        @if($item->bukti_prestasi || $item->bukti)
                                        <i class="fas fa-paperclip me-1"></i>Bukti terlampir
                                        @else
                                        <i class="fas fa-exclamation-circle me-1"></i>Tidak ada bukti
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark text-capitalize">{{ $item->kategori }}</span>
                                </td>
                                <td>
                                    <small>
                                        <div>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</div>
                                        <div class="text-muted">s/d</div>
                                        <div>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</div>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">S{{ $item->semester }}</span>
                                </td>
                                <td>
                                    @if($item->ipk)
                                    <span class="badge bg-info">{{ number_format($item->ipk, 2) }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge status-badge 
                                        {{ $item->status == 'Tervalidasi' ? 'bg-success' : 
                                           ($item->status == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="action-buttons d-flex justify-content-center">
                                        <!-- Button Detail -->
                                        <a href="{{ route('admin.prestasi.show', $item->id_prestasi ?? $item->id) }}" 
                                           class="btn btn-sm btn-outline-info mx-1" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Button Edit -->
                                        <a href="{{ route('admin.prestasi.edit', $item->id_prestasi ?? $item->id) }}" 
                                           class="btn btn-sm btn-outline-primary mx-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Button Validasi -->
                                        @if($item->status == 'Menunggu Validasi')
                                        <button type="button" class="btn btn-sm btn-success mx-1 approve-btn" 
                                                title="Validasi Prestasi"
                                                data-id="{{ $item->id_prestasi ?? $item->id }}"
                                                data-name="{{ $item->nama_prestasi ?? $item->nama }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        
                                        <!-- Button Tolak -->
                                        <button type="button" class="btn btn-sm btn-danger mx-1 reject-btn" 
                                                title="Tolak Prestasi"
                                                data-id="{{ $item->id_prestasi ?? $item->id }}"
                                                data-name="{{ $item->nama_prestasi ?? $item->nama }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @elseif($item->status == 'Tervalidasi')
                                        <!-- Button Batalkan Validasi -->
                                        <button type="button" class="btn btn-sm btn-warning mx-1 unapprove-btn" 
                                                title="Batalkan Validasi"
                                                data-id="{{ $item->id_prestasi ?? $item->id }}"
                                                data-name="{{ $item->nama_prestasi ?? $item->nama }}">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                        @elseif($item->status == 'Ditolak')
                                        <!-- Button Setujui Kembali -->
                                        <button type="button" class="btn btn-sm btn-success mx-1 approve-btn" 
                                                title="Setujui Kembali"
                                                data-id="{{ $item->id_prestasi ?? $item->id }}"
                                                data-name="{{ $item->nama_prestasi ?? $item->nama }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif
                                        
                                        <!-- Button Hapus -->
                                        <button type="button" class="btn btn-sm btn-outline-danger mx-1 delete-btn" 
                                                title="Hapus Prestasi"
                                                data-id="{{ $item->id_prestasi ?? $item->id }}"
                                                data-name="{{ $item->nama_prestasi ?? $item->nama }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Pagination -->
        @if($prestasi->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $prestasi->firstItem() }} - {{ $prestasi->lastItem() }} dari {{ $prestasi->total() }} prestasi
            </div>
            <nav>
                {{ $prestasi->links() }}
            </nav>
        </div>
        @endif
    </div>
</div>

<!-- Modal Konfirmasi Validasi -->
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    Validasi Prestasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin memvalidasi prestasi <strong id="approvePrestasiName"></strong>?</p>
                <p class="text-success mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Prestasi akan ditandai sebagai "Tervalidasi"
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="approveForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Tervalidasi">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Ya, Validasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Penolakan -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle text-danger me-2"></i>
                    Tolak Prestasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak prestasi <strong id="rejectPrestasiName"></strong>?</p>
                <div class="mb-3">
                    <label for="rejectReason" class="form-label">Alasan Penolakan (Opsional):</label>
                    <textarea class="form-control" id="rejectReason" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <p class="text-danger mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Prestasi akan ditandai sebagai "Ditolak"
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Ditolak">
                    <input type="hidden" name="alasan_penolakan" id="alasanPenolakan" value="">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>Ya, Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-trash text-danger me-2"></i>
                    Hapus Prestasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus prestasi <strong id="deletePrestasiName"></strong>?</p>
                <p class="text-danger mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Data yang dihapus tidak dapat dikembalikan
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bulk Actions -->
<div class="modal fade" id="bulkActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkModalTitle">
                    <i class="fas fa-users text-primary me-2"></i>
                    Aksi Massal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="bulkModalMessage">Apakah Anda yakin ingin melakukan aksi ini?</p>
                <div id="bulkRejectReason" class="mb-3 d-none">
                    <label for="bulkRejectReasonText" class="form-label">Alasan Penolakan (Opsional):</label>
                    <textarea class="form-control" id="bulkRejectReasonText" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <p class="text-info mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Aksi ini akan diterapkan pada <span id="selectedCount" class="fw-bold">0</span> prestasi
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="bulkActionForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="bulkMethod" value="PUT">
                    <input type="hidden" name="status" id="bulkStatus" value="">
                    <input type="hidden" name="alasan_penolakan" id="bulkAlasanPenolakan" value="">
                    <input type="hidden" name="selected_ids" id="selectedIds" value="">
                    <button type="submit" class="btn" id="bulkActionButton">
                        <i class="fas fa-check me-1"></i>Ya, Lanjutkan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --success: #4cc9f0;
    --gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    --shadow: 0 10px 20px rgba(0,0,0,0.1);
    --radius: 12px;
}

.hero-section {
    background: var(--gradient);
    color: white;
    padding: 2rem 0;
    border-radius: var(--radius);
    margin-bottom: 2rem;
}

.page-title {
    font-weight: 700;
    font-size: 1.75rem;
}

.admin-badges .badge {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
}

/* Admin Stat Cards */
.admin-stat-card {
    background: white;
    border-radius: var(--radius);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #e1e5ee;
    height: 100%;
}

.admin-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.admin-stat-card .stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.25rem;
}

.admin-stat-card .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.admin-stat-card .stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    background: white;
    border-radius: var(--radius);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    margin-bottom: 1.5rem;
    border: 1px solid #e1e5ee;
}

.filter-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #495057;
    font-size: 0.9rem;
}

/* Bulk Actions */
.bulk-actions-section .card {
    border: 2px solid #e9ecef;
    border-radius: var(--radius);
}

.bulk-actions-section .btn {
    border-radius: 6px;
    margin-left: 0.25rem;
}

/* Card Styles */
.card {
    border: none;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.card-header {
    background: white !important;
    border-bottom: 1px solid #e1e5ee;
    padding: 1.25rem 1.5rem;
}

/* Table Styles */
.table th {
    border-top: none;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem 0.75rem;
    border-bottom: 2px solid #e9ecef;
    background-color: #f8f9fa;
}

.table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid #e9ecef;
}

/* Badge Styles */
.badge {
    font-weight: 500;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
}

.status-badge {
    font-size: 0.7rem;
    padding: 0.4rem 0.8rem;
}

/* Prestasi Item */
.prestasi-item {
    transition: all 0.3s ease;
}

.prestasi-item:hover {
    background-color: #f8f9ff;
}

/* Empty State */
.empty-state {
    padding: 4rem 1rem;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    opacity: 0.7;
}

/* Action Buttons */
.action-buttons .btn {
    border-radius: 6px;
    margin: 0 2px;
    transition: all 0.3s ease;
    padding: 0.375rem 0.75rem;
    border-width: 2px;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

/* Button Styles */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: var(--gradient);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
}

/* Form Controls */
.form-control, .form-select {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    border: 2px solid #e1e5ee;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
}

/* Alert Styles */
.alert {
    border-radius: 8px;
    border: none;
    padding: 1rem 1.5rem;
}

/* Checkbox Styles */
.form-check-input {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 1.5rem;
    }
    
    .admin-stat-card {
        padding: 1rem;
    }
    
    .admin-stat-card .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .admin-stat-card .stat-number {
        font-size: 1.25rem;
    }
    
    .filter-section {
        padding: 1rem;
    }
    
    .bulk-actions-section .btn-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .bulk-actions-section .btn {
        margin-left: 0;
        width: 100%;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .action-buttons .btn {
        margin: 0;
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const statusFilter = document.getElementById('statusFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    
    function applyFilters() {
        const status = statusFilter.value;
        const category = categoryFilter.value;
        const search = searchInput.value;
        
        let url = '{{ route('admin.prestasi.index') }}?';
        const params = [];
        
        if (status !== 'all') {
            params.push(`status=${status}`);
        }
        
        if (category !== 'all') {
            params.push(`kategori=${category}`);
        }
        
        if (search) {
            params.push(`search=${encodeURIComponent(search)}`);
        }
        
        if (params.length > 0) {
            url += params.join('&');
        }
        
        window.location.href = url;
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', applyFilters);
    }
    
    if (categoryFilter) {
        categoryFilter.addEventListener('change', applyFilters);
    }
    
    if (searchButton) {
        searchButton.addEventListener('click', applyFilters);
    }
    
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });
    }

    // Checkbox functionality
    const selectAllHeader = document.getElementById('selectAllHeader');
    const selectAll = document.getElementById('selectAll');
    const prestasiCheckboxes = document.querySelectorAll('.prestasi-checkbox');
    const bulkApproveBtn = document.getElementById('bulkApproveBtn');
    const bulkRejectBtn = document.getElementById('bulkRejectBtn');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

    function updateBulkButtons() {
        const checkedBoxes = document.querySelectorAll('.prestasi-checkbox:checked');
        const hasChecked = checkedBoxes.length > 0;
        
        if (bulkApproveBtn) bulkApproveBtn.disabled = !hasChecked;
        if (bulkRejectBtn) bulkRejectBtn.disabled = !hasChecked;
        if (bulkDeleteBtn) bulkDeleteBtn.disabled = !hasChecked;
    }

    function getSelectedIds() {
        return Array.from(document.querySelectorAll('.prestasi-checkbox:checked'))
            .map(checkbox => checkbox.value);
    }

    if (selectAllHeader) {
        selectAllHeader.addEventListener('change', function() {
            prestasiCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllHeader.checked;
            });
            if (selectAll) selectAll.checked = selectAllHeader.checked;
            updateBulkButtons();
        });
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            prestasiCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            if (selectAllHeader) selectAllHeader.checked = selectAll.checked;
            updateBulkButtons();
        });
    }

    prestasiCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkButtons);
    });

    // Bulk actions modal
    const bulkActionModalEl = document.getElementById('bulkActionModal');
    let bulkActionModal = null;
    
    if (bulkActionModalEl && typeof bootstrap !== 'undefined') {
        bulkActionModal = new bootstrap.Modal(bulkActionModalEl);
    }
    
    const bulkModalTitle = document.getElementById('bulkModalTitle');
    const bulkModalMessage = document.getElementById('bulkModalMessage');
    const bulkRejectReason = document.getElementById('bulkRejectReason');
    const selectedCount = document.getElementById('selectedCount');
    const bulkActionForm = document.getElementById('bulkActionForm');
    const bulkMethod = document.getElementById('bulkMethod');
    const bulkStatus = document.getElementById('bulkStatus');
    const bulkAlasanPenolakan = document.getElementById('bulkAlasanPenolakan');
    const selectedIds = document.getElementById('selectedIds');
    const bulkActionButton = document.getElementById('bulkActionButton');

    // Bulk approve
    if (bulkApproveBtn) {
        bulkApproveBtn.addEventListener('click', function() {
            const selectedIdsArray = getSelectedIds();
            if (selectedIdsArray.length > 0 && bulkActionModal) {
                bulkModalTitle.innerHTML = '<i class="fas fa-check-circle text-success me-2"></i>Validasi Massal';
                bulkModalMessage.textContent = `Apakah Anda yakin ingin memvalidasi ${selectedIdsArray.length} prestasi?`;
                bulkRejectReason.classList.add('d-none');
                selectedCount.textContent = selectedIdsArray.length;
                
                bulkActionForm.action = '{{ route("admin.prestasi.bulk-action") }}';
                bulkMethod.value = 'PUT';
                bulkStatus.value = 'Tervalidasi';
                selectedIds.value = JSON.stringify(selectedIdsArray);
                
                bulkActionButton.className = 'btn btn-success';
                bulkActionButton.innerHTML = '<i class="fas fa-check me-1"></i>Ya, Validasi';
                
                bulkActionModal.show();
            }
        });
    }

    // Bulk reject
    if (bulkRejectBtn) {
        bulkRejectBtn.addEventListener('click', function() {
            const selectedIdsArray = getSelectedIds();
            if (selectedIdsArray.length > 0 && bulkActionModal) {
                bulkModalTitle.innerHTML = '<i class="fas fa-times-circle text-danger me-2"></i>Tolak Massal';
                bulkModalMessage.textContent = `Apakah Anda yakin ingin menolak ${selectedIdsArray.length} prestasi?`;
                bulkRejectReason.classList.remove('d-none');
                selectedCount.textContent = selectedIdsArray.length;
                
                bulkActionForm.action = '{{ route("admin.prestasi.bulk-action") }}';
                bulkMethod.value = 'PUT';
                bulkStatus.value = 'Ditolak';
                selectedIds.value = JSON.stringify(selectedIdsArray);
                
                bulkActionButton.className = 'btn btn-danger';
                bulkActionButton.innerHTML = '<i class="fas fa-times me-1"></i>Ya, Tolak';
                
                bulkActionModal.show();
            }
        });
    }

    // Bulk delete
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            const selectedIdsArray = getSelectedIds();
            if (selectedIdsArray.length > 0 && bulkActionModal) {
                bulkModalTitle.innerHTML = '<i class="fas fa-trash text-danger me-2"></i>Hapus Massal';
                bulkModalMessage.textContent = `Apakah Anda yakin ingin menghapus ${selectedIdsArray.length} prestasi?`;
                bulkRejectReason.classList.add('d-none');
                selectedCount.textContent = selectedIdsArray.length;
                
                bulkActionForm.action = '{{ route("admin.prestasi.bulk-action") }}';
                bulkMethod.value = 'DELETE';
                bulkStatus.value = '';
                selectedIds.value = JSON.stringify(selectedIdsArray);
                
                bulkActionButton.className = 'btn btn-danger';
                bulkActionButton.innerHTML = '<i class="fas fa-trash me-1"></i>Ya, Hapus';
                
                bulkActionModal.show();
            }
        });
    }

    // Handle bulk reject reason
    const bulkRejectReasonText = document.getElementById('bulkRejectReasonText');
    if (bulkRejectReasonText && bulkAlasanPenolakan) {
        bulkRejectReasonText.addEventListener('input', function() {
            bulkAlasanPenolakan.value = this.value;
        });
    }

    // Modal functionality for individual actions
    let approveModal = null;
    let rejectModal = null;
    let deleteModal = null;
    
    const approveModalEl = document.getElementById('approveModal');
    const rejectModalEl = document.getElementById('rejectModal');
    const deleteModalEl = document.getElementById('deleteModal');
    
    if (typeof bootstrap !== 'undefined') {
        if (approveModalEl) approveModal = new bootstrap.Modal(approveModalEl);
        if (rejectModalEl) rejectModal = new bootstrap.Modal(rejectModalEl);
        if (deleteModalEl) deleteModal = new bootstrap.Modal(deleteModalEl);
    }

    // Approve buttons (Individual)
    document.querySelectorAll('.approve-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            
            const approvePrestasiName = document.getElementById('approvePrestasiName');
            const approveForm = document.getElementById('approveForm');
            
            if (approvePrestasiName) approvePrestasiName.textContent = name;
            if (approveForm) approveForm.action = `/admin/prestasi/${id}/validasi`;
            
            if (approveModal) approveModal.show();
        });
    });

    // Reject buttons (Individual)
    document.querySelectorAll('.reject-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            
            const rejectPrestasiName = document.getElementById('rejectPrestasiName');
            const rejectForm = document.getElementById('rejectForm');
            const rejectReason = document.getElementById('rejectReason');
            
            if (rejectPrestasiName) rejectPrestasiName.textContent = name;
            if (rejectForm) rejectForm.action = `/admin/prestasi/${id}/validasi`;
            if (rejectReason) rejectReason.value = '';
            
            if (rejectModal) rejectModal.show();
        });
    });

    // Delete buttons (Individual)
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            
            const deletePrestasiName = document.getElementById('deletePrestasiName');
            const deleteForm = document.getElementById('deleteForm');
            
            if (deletePrestasiName) deletePrestasiName.textContent = name;
            if (deleteForm) deleteForm.action = `/admin/prestasi/${id}`;
            
            if (deleteModal) deleteModal.show();
        });
    });

    // Handle reject reason (Individual)
    const rejectReason = document.getElementById('rejectReason');
    const alasanPenolakan = document.getElementById('alasanPenolakan');
    
    if (rejectReason && alasanPenolakan) {
        rejectReason.addEventListener('input', function() {
            alasanPenolakan.value = this.value;
        });
    }

    // Unapprove buttons
    document.querySelectorAll('.unapprove-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            
            if (confirm(`Apakah Anda yakin ingin membatalkan validasi prestasi "${name}"?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/prestasi/${id}/validasi`;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PUT';
                
                const statusField = document.createElement('input');
                statusField.type = 'hidden';
                statusField.name = 'status';
                statusField.value = 'Menunggu Validasi';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                form.appendChild(statusField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>

@endsection