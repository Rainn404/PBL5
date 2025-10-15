@extends('layout.app')

@section('title', 'Kelola Anggota - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Kelola Anggota</h1>
            <p class="text-muted">Kelola data anggota HIMA</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#anggotaModal">
            <i class="fas fa-plus me-2"></i>Tambah Anggota
        </button>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="table-card">
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari anggota..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="divisiFilter">
                        <option value="">Semua Divisi</option>
                        @foreach($divisiList as $divisi)
                        <option value="{{ $divisi }}">{{ $divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100" id="resetFilter">
                        <i class="fas fa-refresh me-2"></i>Reset
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item['nama']) }}&background=3B82F6&color=fff" 
                                         alt="{{ $item['nama'] }}" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <strong>{{ $item['nama'] }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $item['email'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item['nim'] }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item['divisi'] }}</span>
                            </td>
                            <td>{{ $item['jabatan'] }}</td>
                            <td>
                                <span class="badge {{ $item['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item['status'] }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editAnggota({{ $item['id'] }})"
                                            data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $item['id'] }})"
                                            data-bs-toggle="tooltip" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Anggota -->
<div class="modal fade" id="anggotaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="anggotaForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="anggotaId" name="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nim" class="form-label">NIM *</label>
                            <input type="text" class="form-control" id="nim" name="nim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="divisi" class="form-label">Divisi *</label>
                            <select class="form-select" id="divisi" name="divisi" required>
                                <option value="">Pilih Divisi</option>
                                @foreach($divisiList as $divisi)
                                <option value="{{ $divisi }}">{{ $divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan *</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Telepon *</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat *</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Data dummy untuk demo (nanti diganti dengan data dari database)
const anggotaData = @json($anggota);

function editAnggota(id) {
    const anggota = anggotaData.find(a => a.id === id);
    if (anggota) {
        document.getElementById('modalTitle').textContent = 'Edit Anggota';
        document.getElementById('anggotaId').value = anggota.id;
        document.getElementById('nama').value = anggota.nama;
        document.getElementById('nim').value = anggota.nim;
        document.getElementById('divisi').value = anggota.divisi;
        document.getElementById('jabatan').value = anggota.jabatan;
        document.getElementById('email').value = anggota.email;
        document.getElementById('telepon').value = anggota.telepon;
        document.getElementById('alamat').value = anggota.alamat;
        document.getElementById('status').value = anggota.status;
        
        const modal = new bootstrap.Modal(document.getElementById('anggotaModal'));
        modal.show();
    }
}

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus anggota ini?')) {
        // Submit form delete (akan diimplementasikan nanti)
        alert('Fungsi delete akan diimplementasikan dengan form submission');
    }
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const divisiFilter = document.getElementById('divisiFilter');
    const statusFilter = document.getElementById('statusFilter');
    const resetFilter = document.getElementById('resetFilter');
    const tableRows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const divisiValue = divisiFilter.value;
        const statusValue = statusFilter.value;

        tableRows.forEach(row => {
            const nama = row.cells[0].textContent.toLowerCase();
            const nim = row.cells[1].textContent;
            const divisi = row.cells[2].textContent;
            const status = row.cells[4].textContent;

            const matchesSearch = nama.includes(searchTerm) || nim.includes(searchTerm);
            const matchesDivisi = !divisiValue || divisi === divisiValue;
            const matchesStatus = !statusValue || status === statusValue;

            row.style.display = matchesSearch && matchesDivisi && matchesStatus ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    divisiFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);

    resetFilter.addEventListener('click', function() {
        searchInput.value = '';
        divisiFilter.value = '';
        statusFilter.value = '';
        filterTable();
    });

    // Reset modal ketika ditutup
    const anggotaModal = document.getElementById('anggotaModal');
    anggotaModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('anggotaForm').reset();
        document.getElementById('modalTitle').textContent = 'Tambah Anggota';
        document.getElementById('anggotaId').value = '';
    });

    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush