@extends('layouts.admin.app')

@section('title', 'Kelola Pendaftaran - HIMA Sistem Manajemen')

@section('content')

<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-users me-2"></i>Kelola Pendaftaran
                        </h1>
                        <p class="page-subtitle">Validasi dan kelola pendaftaran anggota baru HIMA TI keren banget</p>
                    </div>
                    <div class="status-badge">
                        <span class="badge {{ $settings->pendaftaran_aktif ? 'bg-success' : 'bg-danger' }}">
                            <i class="fas {{ $settings->pendaftaran_aktif ? 'fa-play' : 'fa-stop' }} me-1"></i>
                            Pendaftaran {{ $settings->pendaftaran_aktif ? 'Aktif' : 'Ditutup' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaturan Periode dan Kontrol -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Pengaturan Periode Pendaftaran</h5>
        </div>
        <div class="card-body">
            <form id="periodeForm" action="{{ route('admin.pendaftaran.update-settings') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pendaftaran</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                               value="{{ $settings->tanggal_mulai }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pendaftaran</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" 
                               value="{{ $settings->tanggal_selesai }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="kuota" class="form-label">Kuota Penerimaan</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" 
                               value="{{ $settings->kuota }}" min="1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Aksi</label>
                        <div class="d-grid">
                            @if($settings->pendaftaran_aktif)
                                <button type="button" class="btn btn-danger" onclick="tutupSesiPendaftaran(event)">
                                    <i class="fas fa-stop me-2"></i>Tutup Pendaftaran
                                </button>
                            @else
                                <button type="button" class="btn btn-success" onclick="simpanDanBukaPendaftaran(event)">
                                    <i class="fas fa-play me-2"></i>Simpan & Buka Pendaftaran
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="auto_close" name="auto_close" 
                                   value="1" {{ $settings->auto_close ? 'checked' : '' }}>
                            <label class="form-check-label" for="auto_close">
                                Tutup otomatis ketika periode berakhir
                            </label>
                        </div>
                    </div>
                </div>
                @if($settings->pendaftaran_aktif)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong>Periode Aktif:</strong> 
                                    {{ \Carbon\Carbon::parse($settings->tanggal_mulai)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($settings->tanggal_selesai)->format('d M Y') }}
                                    @if(now()->between($settings->tanggal_mulai, $settings->tanggal_selesai))
                                        <span class="badge bg-success ms-2">Sedang Berlangsung</span>
                                    @elseif(now()->gt($settings->tanggal_selesai))
                                        <span class="badge bg-danger ms-2">Telah Berakhir</span>
                                    @else
                                        <span class="badge bg-warning ms-2">Akan Datang</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card total-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="stat-number">{{ $stats['totalPendaftaran'] }}</h4>
                            <p class="stat-label">Total Pendaftar</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card pending-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="stat-number">{{ $stats['pendingCount'] }}</h4>
                            <p class="stat-label">Menunggu Validasi</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card accepted-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="stat-number">{{ $stats['diterimaCount'] }}</h4>
                            <p class="stat-label">Diterima</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card rejected-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="stat-number">{{ $stats['ditolakCount'] }}</h4>
                            <p class="stat-label">Ditolak</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Kuota -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Kuota Penerimaan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="kuota-progress">
                        @php
                            $kuota = $settings->kuota ?? 1;
                            $terisi = $stats['diterimaCount'];
                            $persentase = min(100, ($terisi / $kuota) * 100);
                            $sisa = max(0, $kuota - $terisi);
                        @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-semibold">Progress Penerimaan</span>
                            <span class="text-muted">{{ $terisi }} / {{ $kuota }} ({{ $persentase }}%)</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ $persentase }}%"
                                 aria-valuenow="{{ $persentase }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ $persentase }}%
                            </div>
                        </div>
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Sisa kuota: <strong>{{ $sisa }}</strong> penerimaan
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistik Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="quick-stats">
                        <div class="stat-item d-flex justify-content-between align-items-center mb-2">
                            <span>Rata-rata Pendaftar/Hari</span>
                            <span class="badge bg-primary">{{ number_format($stats['totalPendaftaran'] / max(1, \Carbon\Carbon::parse($settings->tanggal_mulai)->diffInDays(now())), 1) }}</span>
                        </div>
                        <div class="stat-item d-flex justify-content-between align-items-center mb-2">
                            <span>Tingkat Penerimaan</span>
                            <span class="badge bg-info">{{ $stats['totalPendaftaran'] > 0 ? number_format(($stats['diterimaCount'] / $stats['totalPendaftaran']) * 100, 1) : 0 }}%</span>
                        </div>
                        <div class="stat-item d-flex justify-content-between align-items-center">
                            <span>Sisa Hari</span>
                            <span class="badge bg-warning">{{ max(0, \Carbon\Carbon::parse($settings->tanggal_selesai)->diffInDays(now())) }} Hari</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="card filter-card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="filter-tabs">
                        <div class="nav nav-pills" role="tablist">
                            <button class="nav-link active" onclick="filterPendaftaran('all')">
                                Semua <span class="badge bg-primary ms-1">{{ $stats['totalPendaftaran'] }}</span>
                            </button>
                            <button class="nav-link" onclick="filterPendaftaran('pending')">
                                <i class="fas fa-clock me-1"></i>Pending 
                                <span class="badge bg-warning ms-1">{{ $stats['pendingCount'] }}</span>
                            </button>
                            <button class="nav-link" onclick="filterPendaftaran('diterima')">
                                <i class="fas fa-check me-1"></i>Diterima 
                                <span class="badge bg-success ms-1">{{ $stats['diterimaCount'] }}</span>
                            </button>
                            <button class="nav-link" onclick="filterPendaftaran('ditolak')">
                                <i class="fas fa-times me-1"></i>Ditolak 
                                <span class="badge bg-danger ms-1">{{ $stats['ditolakCount'] }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari nama atau NIM..." id="searchInput" value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="button" onclick="searchPendaftaran()">
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-2"></i>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Tabel Pendaftaran -->
    <div class="card main-card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>Data Pendaftaran
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="pendaftaranTable">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Pendaftar</th>
                            <th>NIM</th>
                            <th>Semester</th>
                            <th>Kontak</th>
                            <th>Alasan</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaran as $index => $item)
                        <tr class="pendaftaran-row" data-status="{{ $item->status_pendaftaran }}" data-search="{{ strtolower($item->nama . ' ' . $item->nim) }}">
                            <td class="ps-3">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block">{{ $item->nama }}</strong>
                                        <small class="text-muted">{{ $item->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <code class="nim-code">{{ $item->nim }}</code>
                            </td>
                            <td>
                                <span class="badge semester-badge">S{{ $item->semester }}</span>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <div class="phone">
                                        <i class="fas fa-phone me-1"></i> 
                                        <small>{{ $item->no_hp ?? '-' }}</small>
                                    </div>
                                    <div class="email">
                                        <i class="fas fa-envelope me-1"></i> 
                                        <small>{{ $item->user->email ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="alasan-text" data-bs-toggle="tooltip" title="{{ $item->alasan_mendaftar }}">
                                    {{ Str::limit($item->alasan_mendaftar, 40) }}
                                </div>
                            </td>
                            <td>
                                @if($item->dokumen)
                                <a href="{{ asset('storage/' . $item->dokumen) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary doc-btn"
                                   data-bs-toggle="tooltip" title="Lihat Dokumen">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge badge 
                                    @if($item->status_pendaftaran == 'pending') bg-warning
                                    @elseif($item->status_pendaftaran == 'diterima') bg-success
                                    @else bg-danger @endif">
                                    <i class="fas 
                                        @if($item->status_pendaftaran == 'pending') fa-clock
                                        @elseif($item->status_pendaftaran == 'diterima') fa-check
                                        @else fa-times @endif me-1">
                                    </i>
                                    {{ ucfirst($item->status_pendaftaran) }}
                                </span>
                                @if($item->validator && $item->status_pendaftaran != 'pending')
                                <br>
                                <small class="text-muted">Oleh: {{ $item->validator->name ?? 'Admin' }}</small>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-info action-btn" 
                                            onclick="viewDetail({{ $item->id }})"
                                            data-bs-toggle="tooltip" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($item->status_pendaftaran == 'pending')
                                    <button class="btn btn-sm btn-outline-success action-btn" 
                                            onclick="updateStatus({{ $item->id }}, 'diterima')"
                                            data-bs-toggle="tooltip" title="Terima">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger action-btn" 
                                            onclick="updateStatus({{ $item->id }}, 'ditolak')"
                                            data-bs-toggle="tooltip" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-sm btn-outline-warning action-btn" 
                                            onclick="editPendaftaran({{ $item->id }})"
                                            data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.pendaftaran.destroy', ['pendaftaran' => $item->id_pendaftaran]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger action-btn" 
                                                data-bs-toggle="tooltip" title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data pendaftaran</h5>
                                    <p class="text-muted">Tidak ada pendaftaran yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($pendaftaran->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Menampilkan {{ $pendaftaran->firstItem() }} - {{ $pendaftaran->lastItem() }} dari {{ $pendaftaran->total() }} data
        </div>
        <div>
            {{ $pendaftaran->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Modal Detail Pendaftaran -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>Detail Pendaftaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Status -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusTitle">
                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="statusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="pendaftaranId" name="id_pendaftaran">
                    <input type="hidden" id="statusValue" name="status_pendaftaran">
                    
                    <div id="diterimaContent" style="display: none;">
                        <div class="mb-3">
                            <label for="id_divisi" class="form-label">Divisi *</label>
                            <select class="form-select" id="id_divisi" name="id_divisi" required>
                                <option value="">Pilih Divisi</option>
                                @foreach($divisi as $div)
                                <option value="{{ $div->id }}">{{ $div->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_jabatan" class="form-label">Jabatan *</label>
                            <select class="form-select" id="id_jabatan" name="id_jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach($jabatan as $jab)
                                <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div id="ditolakContent" style="display: none;">
                        <div class="mb-3">
                            <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                            <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" 
                                      rows="3" placeholder="Berikan alasan penolakan..."></textarea>
                        </div>
                    </div>
                    
                    <p id="confirmationText" class="mb-0"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" id="submitButton">
                        <i class="fas fa-check me-1"></i><span id="submitText">Konfirmasi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Pendaftaran -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body" id="editContent">
                    <!-- Content will be loaded by JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Custom Styles */
:root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --success: #4cc9f0;
    --warning: #f8961e;
    --danger: #f94144;
    --light: #f8f9fa;
    --dark: #212529;
    --gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --radius: 12px;
}

/* Header Styles */
.page-header {
    background: white;
    padding: 1.5rem;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.page-title {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 0.5rem;
    font-size: 1.75rem;
}

.page-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}

/* Stat Cards */
.stat-card {
    border: none;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.total-card { background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); color: white; }
.pending-card { background: linear-gradient(135deg, #f8961e 0%, #f3722c 100%); color: white; }
.accepted-card { background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%); color: white; }
.rejected-card { background: linear-gradient(135deg, #f94144 0%, #f3722c 100%); color: white; }

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.stat-icon {
    font-size: 2.5rem;
    opacity: 0.7;
}

/* Progress Bar */
.kuota-progress .progress {
    border-radius: 10px;
}

.quick-stats .stat-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #e9ecef;
}

.quick-stats .stat-item:last-child {
    border-bottom: none;
}

/* Filter Tabs */
.filter-tabs .nav-pills .nav-link {
    border-radius: 8px;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    padding: 0.5rem 1rem;
    border: 1px solid #dee2e6;
    background: white;
    color: var(--dark);
}

.filter-tabs .nav-pills .nav-link.active {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
}

.filter-tabs .nav-pills .nav-link:hover:not(.active) {
    background: #f8f9fa;
}

/* Search Box */
.search-box .input-group {
    border-radius: 8px;
    overflow: hidden;
}

.search-box .input-group-text {
    background: white;
    border-right: none;
}

.search-box .form-control {
    border-left: none;
    border-right: none;
}

.search-box .btn {
    border-radius: 0 8px 8px 0;
}

/* Table Styles */
.main-card .table {
    margin-bottom: 0;
}

.main-card .table th {
    border-top: none;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem 0.75rem;
    border-bottom: 2px solid #e9ecef;
}

.main-card .table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid #e9ecef;
}

.pendaftaran-row:hover {
    background-color: #f8f9ff;
}

/* Avatar */
.avatar {
    width: 40px;
    height: 40px;
    font-size: 1rem;
}

/* Badges */
.status-badge, .semester-badge {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    font-weight: 500;
}

.semester-badge {
    background: #6c757d;
    color: white;
}

.nim-code {
    background: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
}

/* Contact Info */
.contact-info .phone, .contact-info .email {
    margin-bottom: 0.25rem;
}

.contact-info small {
    font-size: 0.8rem;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.25rem;
    justify-content: center;
}

.action-btn {
    border-radius: 6px;
    padding: 0.375rem 0.5rem;
    transition: all 0.3s ease;
    border-width: 2px;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

/* Doc Button */
.doc-btn {
    border-radius: 6px;
    padding: 0.375rem 0.5rem;
}

/* Empty State */
.empty-state {
    padding: 2rem;
}

.empty-state i {
    opacity: 0.5;
}

/* Alert Styles */
.alert {
    border-radius: 8px;
    border: none;
    padding: 1rem 1.5rem;
}

/* Modal Styles */
.modal-header {
    border-bottom: 1px solid #e9ecef;
    padding: 1.25rem 1.5rem;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .stat-icon {
        font-size: 2rem;
    }
    
    .filter-tabs .nav-pills .nav-link {
        font-size: 0.8rem;
        padding: 0.4rem 0.75rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.125rem;
    }
    
    .action-btn {
        width: 100%;
        justify-content: center;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .page-header {
        padding: 1rem;
    }
    
    .stat-card .card-body {
        padding: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Fungsi untuk menyimpan pengaturan dan membuka pendaftaran
async function simpanDanBukaPendaftaran(event) {
    // Validasi form terlebih dahulu
    const tanggalMulai = document.getElementById('tanggal_mulai').value;
    const tanggalSelesai = document.getElementById('tanggal_selesai').value;
    const kuota = document.getElementById('kuota').value;
    
    if (!tanggalMulai || !tanggalSelesai || !kuota) {
        showAlert('Harap isi semua field pengaturan terlebih dahulu', 'error');
        return;
    }
    
    const startDate = new Date(tanggalMulai);
    const endDate = new Date(tanggalSelesai);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (endDate <= startDate) {
        showAlert('Tanggal selesai harus setelah tanggal mulai', 'error');
        return;
    }
    
    if (startDate < today) {
        showAlert('Tanggal mulai tidak boleh di masa lalu', 'error');
        return;
    }
    
    if (kuota < 1) {
        showAlert('Kuota harus minimal 1', 'error');
        return;
    }

    if (!confirm('Apakah Anda yakin ingin menyimpan pengaturan dan membuka sesi pendaftaran?\nPendaftaran akan langsung aktif setelah pengaturan disimpan.')) {
        return;
    }

    try {
        const button = event?.target || document.querySelector('button[onclick*="simpanDanBukaPendaftaran"]');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan & Membuka...';
        button.disabled = true;

        // 1. Simpan pengaturan terlebih dahulu
        const formData = new FormData(document.getElementById('periodeForm'));
        
        const saveResponse = await fetch("{{ route('admin.pendaftaran.update-settings') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });

        const saveResult = await saveResponse.json();

        if (!saveResult.success) {
            throw new Error(saveResult.message || 'Gagal menyimpan pengaturan');
        }

        // 2. Buka sesi pendaftaran
        const openResponse = await fetch("{{ route('admin.pendaftaran.buka-sesi') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        });

        const openResult = await openResponse.json();

        if (openResult.success) {
            showAlert('Pengaturan berhasil disimpan dan sesi pendaftaran berhasil dibuka', 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            throw new Error(openResult.message || 'Gagal membuka sesi pendaftaran');
        }

    } catch (error) {
        console.error('Error:', error);
        showAlert(error.message || 'Terjadi kesalahan saat menyimpan pengaturan dan membuka sesi pendaftaran', 'error');
        
        // Reset button state dengan cara yang aman
        const button = event?.target || document.querySelector('button[onclick*="simpanDanBukaPendaftaran"]');
        if (button) {
            button.innerHTML = '<i class="fas fa-play me-2"></i>Simpan & Buka Pendaftaran';
            button.disabled = false;
        }
    }
}

// Fungsi untuk menutup sesi pendaftaran
async function tutupSesiPendaftaran(event) {
    if (!confirm('Apakah Anda yakin ingin menutup sesi pendaftaran?\nPendaftaran baru tidak akan bisa masuk.')) {
        return;
    }

    try {
        const button = event?.target || document.querySelector('button[onclick*="tutupSesiPendaftaran"]');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menutup...';
        button.disabled = true;

        const response = await fetch("{{ route('admin.pendaftaran.tutup-sesi') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        });

        const data = await response.json();

        if (data.success) {
            showAlert('Sesi pendaftaran berhasil ditutup', 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            throw new Error(data.message || 'Gagal menutup sesi pendaftaran');
        }

    } catch (error) {
        console.error('Error:', error);
        showAlert(error.message || 'Terjadi kesalahan saat menutup sesi pendaftaran', 'error');
        
        // Reset button state dengan cara yang aman
        const button = event?.target || document.querySelector('button[onclick*="tutupSesiPendaftaran"]');
        if (button) {
            button.innerHTML = '<i class="fas fa-stop me-2"></i>Tutup Pendaftaran';
            button.disabled = false;
        }
    }
}

// Fungsi untuk menampilkan alert
function showAlert(message, type = 'info') {
    const alertClass = {
        'success': 'alert-success',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'info': 'alert-info'
    }[type] || 'alert-info';

    const iconClass = {
        'success': 'fa-check-circle',
        'error': 'fa-exclamation-circle',
        'warning': 'fa-exclamation-triangle',
        'info': 'fa-info-circle'
    }[type] || 'fa-info-circle';

    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fas ${iconClass} me-2"></i>
                <div>${message}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    const container = document.querySelector('.container-fluid');
    const firstCard = container.querySelector('.card');
    container.insertBefore(document.createRange().createContextualFragment(alertHtml), firstCard);

    // Auto remove after 5 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
}

// Validasi tanggal
function validateDates() {
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    if (tanggalMulai.value && tanggalSelesai.value) {
        const startDate = new Date(tanggalMulai.value);
        const endDate = new Date(tanggalSelesai.value);
        
        if (endDate <= startDate) {
            showAlert('Tanggal selesai harus setelah tanggal mulai', 'error');
            tanggalSelesai.value = '';
            return false;
        }
    }
    return true;
}

// Filter pendaftaran
function filterPendaftaran(status) {
    const url = new URL(window.location.href);
    if (status === 'all') {
        url.searchParams.delete('status');
    } else {
        url.searchParams.set('status', status);
    }
    url.searchParams.delete('page'); // Reset to first page
    window.location.href = url.toString();
}

// Pencarian pendaftaran
function searchPendaftaran() {
    const searchTerm = document.getElementById('searchInput').value.trim();
    const url = new URL(window.location.href);
    if (searchTerm === '') {
        url.searchParams.delete('search');
    } else {
        url.searchParams.set('search', searchTerm);
    }
    url.searchParams.delete('page'); // Reset to first page
    window.location.href = url.toString();
}

// View detail pendaftaran
async function viewDetail(id) {
    try {
        const response = await fetch(`/admin/pendaftaran/${id}`);
        if (!response.ok) {
            throw new Error('Gagal memuat data detail');
        }
        
        const data = await response.json();
        
        let content = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Data Pribadi</h6>
                    <table class="table table-sm">
                        <tr><td><strong>Nama</strong></td><td>${data.nama || '-'}</td></tr>
                        <tr><td><strong>NIM</strong></td><td>${data.nim || '-'}</td></tr>
                        <tr><td><strong>Semester</strong></td><td>Semester ${data.semester || '-'}</td></tr>
                        <tr><td><strong>No HP</strong></td><td>${data.no_hp || '-'}</td></tr>
                        <tr><td><strong>Email</strong></td><td>${data.user?.email || '-'}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Informasi Pendaftaran</h6>
                    <table class="table table-sm">
                        <tr><td><strong>Tanggal Daftar</strong></td><td>${data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID') : '-'}</td></tr>
                        <tr><td><strong>Status</strong></td>
                            <td>
                                <span class="badge ${data.status_pendaftaran === 'pending' ? 'bg-warning' : data.status_pendaftaran === 'diterima' ? 'bg-success' : 'bg-danger'}">
                                    ${data.status_pendaftaran || 'pending'}
                                </span>
                            </td>
                        </tr>
                        ${data.validator ? `<tr><td><strong>Divalidasi Oleh</strong></td><td>${data.validator.name || 'Admin'}</td></tr>` : ''}
                        ${data.divisi ? `<tr><td><strong>Divisi</strong></td><td>${data.divisi.nama || '-'}</td></tr>` : ''}
                        ${data.jabatan ? `<tr><td><strong>Jabatan</strong></td><td>${data.jabatan.nama_jabatan || '-'}</td></tr>` : ''}
                    </table>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h6>Alasan Mendaftar</h6>
                    <div class="border rounded p-3">
                        ${(data.alasan_mendaftar || '-').replace(/\n/g, '<br>')}
                    </div>
                </div>
            </div>
        `;
        
        if (data.pengalaman) {
            content += `
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Pengalaman Organisasi</h6>
                        <div class="border rounded p-3">
                            ${data.pengalaman.replace(/\n/g, '<br>')}
                        </div>
                    </div>
                </div>
            `;
        }
        
        if (data.skill) {
            content += `
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Kemampuan/Keterampilan</h6>
                        <div class="border rounded p-3">
                            ${data.skill.replace(/\n/g, '<br>')}
                        </div>
                    </div>
                </div>
            `;
        }
        
        if (data.dokumen) {
            content += `
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Dokumen Pendaftaran</h6>
                        <a href="{{ asset('storage/') }}/${data.dokumen}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-file-pdf me-2"></i>Lihat Dokumen
                        </a>
                    </div>
                </div>
            `;
        }
        
        document.getElementById('detailContent').innerHTML = content;
        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
        modal.show();
        
    } catch (error) {
        console.error('Error:', error);
        showAlert('Gagal memuat detail pendaftaran', 'error');
    }
}

// Update status pendaftaran
function updateStatus(id, status) {
    document.getElementById('pendaftaranId').value = id;
    document.getElementById('statusValue').value = status;
    document.getElementById('statusForm').action = "{{ route('admin.pendaftaran.update-status', ':id') }}".replace(':id', id);
    
    // Reset form fields
    document.getElementById('id_divisi').value = '';
    document.getElementById('id_jabatan').value = '';
    document.getElementById('alasan_penolakan').value = '';
    
    // Show/hide content based on status
    document.getElementById('diterimaContent').style.display = status === 'diterima' ? 'block' : 'none';
    document.getElementById('ditolakContent').style.display = status === 'ditolak' ? 'block' : 'none';
    
    // Set required fields
    document.getElementById('id_divisi').required = status === 'diterima';
    document.getElementById('id_jabatan').required = status === 'diterima';
    
    // Update modal content
    const row = document.querySelector(`tr[data-status] button[onclick*="${id}"]`)?.closest('tr');
    const nama = row ? row.querySelector('strong').textContent : 'Pendaftar';
    
    if (status === 'diterima') {
        document.getElementById('statusTitle').innerHTML = '<i class="fas fa-check-circle me-2"></i>Terima Pendaftaran';
        document.getElementById('confirmationText').textContent = `Apakah Anda yakin ingin menerima pendaftaran ${nama}?`;
        document.getElementById('submitButton').className = 'btn btn-success';
        document.getElementById('submitText').textContent = 'Terima';
    } else {
        document.getElementById('statusTitle').innerHTML = '<i class="fas fa-times-circle me-2"></i>Tolak Pendaftaran';
        document.getElementById('confirmationText').textContent = `Apakah Anda yakin ingin menolak pendaftaran ${nama}?`;
        document.getElementById('submitButton').className = 'btn btn-danger';
        document.getElementById('submitText').textContent = 'Tolak';
    }
    
    const modal = new bootstrap.Modal(document.getElementById('statusModal'));
    modal.show();
}

// Edit pendaftaran
async function editPendaftaran(id) {
    try {
        const response = await fetch(`/admin/pendaftaran/${id}/edit`);
        if (!response.ok) {
            throw new Error('Gagal memuat form edit');
        }
        
        const html = await response.text();
        document.getElementById('editContent').innerHTML = html;
        document.getElementById('editForm').action = "{{ route('admin.pendaftaran.update', ':id') }}".replace(':id', id);
        
        const modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
        
    } catch (error) {
        console.error('Error:', error);
        showAlert('Gagal memuat form edit', 'error');
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Enter key for search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchPendaftaran();
        }
    });
    
    // Date validation
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    if (tanggalMulai && tanggalSelesai) {
        tanggalMulai.addEventListener('change', function() {
            validateDates();
        });
        
        tanggalSelesai.addEventListener('change', function() {
            validateDates();
        });
    }
    
    // Handle form submission for status modal
    document.getElementById('statusForm').addEventListener('submit', function(e) {
        const status = document.getElementById('statusValue').value;
        if (status === 'diterima') {
            const divisi = document.getElementById('id_divisi').value;
            const jabatan = document.getElementById('id_jabatan').value;
            if (!divisi || !jabatan) {
                e.preventDefault();
                showAlert('Harap pilih divisi dan jabatan untuk penerimaan', 'error');
            }
        }
    });
});
</script>
@endpush