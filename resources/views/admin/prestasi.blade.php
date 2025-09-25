@extends('layouts.app_admin')

@section('title', 'Kelola Prestasi - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Kelola Prestasi</h1>
            <p class="text-muted">Kelola prestasi mahasiswa dan organisasi</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#prestasiModal">
            <i class="fas fa-plus me-2"></i>Ajukan Prestasi
        </button>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        @foreach($prestasi as $item)
        <div class="col-lg-6">
            <div class="dashboard-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title fw-bold">{{ $item['nama'] }}</h5>
                            <p class="text-muted mb-2">{{ $item['deskripsi'] }}</p>
                        </div>
                        <span class="badge {{ $item['status'] == 'Tervalidasi' ? 'bg-success' : ($item['status'] == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $item['status'] }}
                        </span>
                    </div>
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>
                                {{ $item['mahasiswa'] }}
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">
                                <i class="fas fa-trophy me-1"></i>
                                {{ $item['juara'] }}
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $item['tingkat'] }}
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm btn-outline-primary me-2" 
                                onclick="editPrestasi({{ $item['id'] }})">
                            <i class="fas fa-edit me-1"></i>Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger" 
                                onclick="confirmDelete({{ $item['id'] }})">
                            <i class="fas fa-trash me-1"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Tambah/Edit Prestasi -->
<div class="modal fade" id="prestasiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Ajukan Prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="prestasiForm" method="POST" action="{{ route('admin.prestasi.store') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="prestasiId" name="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Prestasi *</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="mahasiswa" class="form-label">Nama Mahasiswa *</label>
                            <input type="text" class="form-control" id="mahasiswa" name="mahasiswa" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tingkat" class="form-label">Tingkat *</label>
                            <select class="form-select" id="tingkat" name="tingkat" required>
                                <option value="Lokal">Lokal</option>
                                <option value="Regional">Regional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="juara" class="form-label">Juara *</label>
                            <input type="text" class="form-control" id="juara" name="juara" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal *</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Menunggu Validasi">Menunggu Validasi</option>
                                <option value="Tervalidasi">Tervalidasi</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi *</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
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
// Data dummy untuk demo
const prestasiData = @json($prestasi);

function editPrestasi(id) {
    const prestasi = prestasiData.find(p => p.id === id);
    if (prestasi) {
        document.getElementById('modalTitle').textContent = 'Edit Prestasi';
        document.getElementById('prestasiId').value = prestasi.id;
        document.getElementById('nama').value = prestasi.nama;
        document.getElementById('mahasiswa').value = prestasi.mahasiswa;
        document.getElementById('tingkat').value = prestasi.tingkat;
        document.getElementById('juara').value = prestasi.juara;
        document.getElementById('tanggal').value = prestasi.tanggal;
        document.getElementById('status').value = prestasi.status;
        document.getElementById('deskripsi').value = prestasi.deskripsi;
        
        // Update form action untuk update
        document.getElementById('prestasiForm').action = "{{ url('admin/prestasi') }}/" + id;
        document.getElementById('prestasiForm').method = "POST";
        
        // Tambahkan method spoofing untuk PUT
        if (!document.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            document.getElementById('prestasiForm').appendChild(methodInput);
        }
        
        const modal = new bootstrap.Modal(document.getElementById('prestasiModal'));
        modal.show();
    }
}

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus prestasi ini?')) {
        // Create delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ url('admin/prestasi') }}/" + id;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = "{{ csrf_token() }}";
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        
        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }
}

// Reset modal ketika ditutup
document.addEventListener('DOMContentLoaded', function() {
    const prestasiModal = document.getElementById('prestasiModal');
    prestasiModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('prestasiForm').reset();
        document.getElementById('modalTitle').textContent = 'Ajukan Prestasi';
        document.getElementById('prestasiId').value = '';
        document.getElementById('prestasiForm').action = "{{ route('admin.prestasi.store') }}";
        document.getElementById('prestasiForm').method = "POST";
        
        // Hapus method spoofing jika ada
        const methodInput = document.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
        
        // Set tanggal default ke hari ini
        document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
    });
    
    // Set tanggal default saat modal dibuka
    prestasiModal.addEventListener('show.bs.modal', function() {
        if (!document.getElementById('prestasiId').value) {
            document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
        }
    });
});
</script>
@endpush