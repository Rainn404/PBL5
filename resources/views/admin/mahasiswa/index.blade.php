@extends('layouts.app_admin')

@section('title', 'Data Mahasiswa - HIMA-TI')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>Data Mahasiswa
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Alert Notifikasi -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Toolbar -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('admin.mahasiswa.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Cari NIM atau Nama..." value="{{ $search }}">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Tambah Data
                                </a>
                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-file-excel me-1"></i>Excel
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importModal">
                                            <i class="fas fa-upload me-2"></i>Import Excel
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.mahasiswa.export') }}">
                                            <i class="fas fa-download me-2"></i>Export Excel
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.mahasiswa.template') }}">
                                            <i class="fas fa-file-download me-2"></i>Download Template
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Angkatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() }}</td>
                                    <td>
                                        <strong>{{ $item->nim }}</strong>
                                        @if($item->email)
                                        <br><small class="text-muted">{{ $item->email }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->prodi ?? '-' }}</td>
                                    <td>{{ $item->angkatan ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 'Aktif' ? 'bg-success' : ($item->status == 'Cuti' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.mahasiswa.show', $item->id) }}" 
                                               class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.mahasiswa.edit', $item->id) }}" 
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.mahasiswa.destroy', $item->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        title="Hapus" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada data mahasiswa</h5>
                                        <p class="text-muted">Mulai tambahkan data mahasiswa atau import dari Excel</p>
                                        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary me-2">
                                            <i class="fas fa-plus me-1"></i>Tambah Data
                                        </a>
                                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                                            <i class="fas fa-upload me-1"></i>Import Excel
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($mahasiswa->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $mahasiswa->firstItem() }} - {{ $mahasiswa->lastItem() }} dari {{ $mahasiswa->total() }} data
                        </div>
                        {{ $mahasiswa->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File Excel</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls,.csv" required>
                        <div class="form-text">
                            Format file: .xlsx, .xls, .csv (Maks. 2MB)
                            <br><a href="{{ route('admin.mahasiswa.template') }}" class="text-decoration-none">
                                <i class="fas fa-download me-1"></i>Download Template
                            </a>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Format Kolom:</h6>
                        <small>
                            <strong>NIM</strong> (wajib), <strong>Nama</strong> (wajib), Email, Prodi, Angkatan, No HP, Alamat, Status (Aktif/Non-Aktif/Cuti)
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto close alert setelah 5 detik
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endpush