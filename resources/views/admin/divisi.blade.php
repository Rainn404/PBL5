@extends('layouts.app_admin')

@section('title', 'Divisi - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Data Divisi</h1>
            <p class="text-muted">Kelola data divisi organisasi</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#divisiModal">
            <i class="fas fa-plus me-2"></i>Tambah Divisi
        </button>
    </div>

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

    <div class="table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Divisi</th>
                            <th>Deskripsi</th>
                            <th>Ketua Divisi</th>
                            <th>Jumlah Anggota</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($divisi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                    <strong>{{ $item['nama'] }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ Str::limit($item['deskripsi'], 50) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $item['ketua'] }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $item['anggota'] }} Anggota</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editDivisi({{ $item['id'] }})"
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
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3"></i>
                                    <p>Belum ada data divisi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Divisi -->
<div class="modal fade" id="divisiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Divisi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="divisiForm" method="POST" action="{{ route('admin.divisi.store') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="divisiId" name="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Divisi *</label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   placeholder="Masukkan nama divisi" required maxlength="255">
                            @error('nama')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="ketua" class="form-label">Ketua Divisi *</label>
                            <input type="text" class="form-control" id="ketua" name="ketua" 
                                   placeholder="Masukkan nama ketua divisi" required maxlength="255">
                            @error('ketua')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi Divisi *</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" 
                                      rows="4" placeholder="Masukkan deskripsi divisi" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
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
// Data divisi dari controller
const divisiData = @json($divisi);

function editDivisi(id) {
    const divisi = divisiData.find(d => d.id === id);
    if (divisi) {
        document.getElementById('modalTitle').textContent = 'Edit Data Divisi';
        document.getElementById('divisiId').value = divisi.id;
        document.getElementById('nama').value = divisi.nama;
        document.getElementById('ketua').value = divisi.ketua;
        document.getElementById('deskripsi').value = divisi.deskripsi;
        
        // Update form action untuk update
        document.getElementById('divisiForm').action = "{{ url('divisi') }}/" + id;
        document.getElementById('divisiForm').method = "POST";
        
        // Tambahkan method spoofing untuk PUT
        if (!document.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            document.getElementById('divisiForm').appendChild(methodInput);
        }
        
        const modal = new bootstrap.Modal(document.getElementById('divisiModal'));
        modal.show();
    }
}

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus divisi ini?')) {
        // Create delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ url('divisi') }}/" + id;
        
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
    const divisiModal = document.getElementById('divisiModal');
    divisiModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('divisiForm').reset();
        document.getElementById('modalTitle').textContent = 'Tambah Divisi Baru';
        document.getElementById('divisiId').value = '';
        document.getElementById('divisiForm').action = "{{ route('admin.divisi.store') }}";
        document.getElementById('divisiForm').method = "POST";
        
        // Hapus method spoofing jika ada
        const methodInput = document.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
        
        // Clear error messages
        const errorElements = document.querySelectorAll('.text-danger');
        errorElements.forEach(element => element.remove());
    });
    
    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush