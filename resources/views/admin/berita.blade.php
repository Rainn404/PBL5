@extends('layouts.app_admin')

@section('title', 'Berita - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Manajemen Berita</h1>
            <p class="text-muted">Kelola berita dan informasi organisasi</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beritaModal">
            <i class="fas fa-plus me-2"></i>Tambah Berita
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
                            <th>Judul Berita</th>
                            <th>Isi</th>
                            <th>Tanggal</th>
                            <th>Penulis</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item['foto'])
                                    <img src="{{ asset('storage/' . $item['foto']) }}" 
                                         alt="{{ $item['judul'] }}" 
                                         class="rounded me-3" 
                                         style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center me-3" 
                                         style="width: 60px; height: 40px;">
                                        <i class="fas fa-newspaper text-white"></i>
                                    </div>
                                    @endif
                                    <strong>{{ Str::limit($item['judul'], 50) }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ Str::limit(strip_tags($item['isi']), 70) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $item['penulis'] ?? 'Admin' }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editBerita({{ $item['id_berita'] }})"
                                            data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="previewBerita({{ $item['id_berita'] }})"
                                            data-bs-toggle="tooltip" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $item['id_berita'] }})"
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
                                    <i class="fas fa-newspaper fa-2x mb-3"></i>
                                    <p>Belum ada data berita</p>
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

<!-- Modal Tambah/Edit Berita -->
<div class="modal fade" id="beritaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Berita Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="beritaForm" method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="beritaId" name="id_berita">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="judul" class="form-label">Judul Berita *</label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   placeholder="Masukkan judul berita" required maxlength="200">
                            @error('judul')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="isi" class="form-label">Isi Berita *</label>
                            <textarea class="form-control" id="isi" name="isi" 
                                      rows="6" placeholder="Tulis isi berita disini..." required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="foto" class="form-label">Foto Berita</label>
                            <input type="file" class="form-control" id="foto" name="foto" 
                                   accept="image/*">
                            <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB</div>
                            @error('foto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            
                            <!-- Preview Image -->
                            <div id="fotoPreview" class="mt-2" style="display: none;">
                                <img id="previewImage" src="" class="img-thumbnail" style="max-height: 150px;">
                            </div>
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

<!-- Modal Preview Berita -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle">Preview Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Data berita dari controller
const beritaData = @json($berita);

function editBerita(id) {
    const berita = beritaData.find(b => b.id_berita === id);
    if (berita) {
        document.getElementById('modalTitle').textContent = 'Edit Berita';
        document.getElementById('beritaId').value = berita.id_berita;
        document.getElementById('judul').value = berita.judul;
        document.getElementById('isi').value = berita.isi;
        
        // Update form action untuk update
        document.getElementById('beritaForm').action = "{{ url('berita') }}/" + id;
        document.getElementById('beritaForm').method = "POST";
        
        // Tambahkan method spoofing untuk PUT
        if (!document.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            document.getElementById('beritaForm').appendChild(methodInput);
        }
        
        const modal = new bootstrap.Modal(document.getElementById('beritaModal'));
        modal.show();
    }
}

function previewBerita(id) {
    const berita = beritaData.find(b => b.id_berita === id);
    if (berita) {
        document.getElementById('previewTitle').textContent = berita.judul;
        
        let content = `
            <div class="text-center mb-4">
                ${berita.foto ? 
                    `<img src="{{ asset('storage/') }}/${berita.foto}" 
                         alt="${berita.judul}" 
                         class="img-fluid rounded" 
                         style="max-height: 300px;">` 
                    : '<div class="bg-light rounded p-5 text-muted"><i class="fas fa-newspaper fa-3x"></i></div>'
                }
            </div>
            <h3 class="mb-3">${berita.judul}</h3>
            <div class="text-muted mb-3">
                <small><i class="fas fa-calendar me-1"></i> 
                ${new Date(berita.tanggal).toLocaleDateString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                })}</small>
            </div>
            <div class="berita-content">
                ${berita.isi.replace(/\n/g, '<br>')}
            </div>
        `;
        
        document.getElementById('previewContent').innerHTML = content;
        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
        modal.show();
    }
}

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        // Create delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ url('berita') }}/" + id;
        
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

// Preview image sebelum upload
document.getElementById('foto').addEventListener('change', function(e) {
    const preview = document.getElementById('fotoPreview');
    const previewImage = document.getElementById('previewImage');
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(this.files[0]);
    } else {
        preview.style.display = 'none';
    }
});

// Reset modal ketika ditutup
document.addEventListener('DOMContentLoaded', function() {
    const beritaModal = document.getElementById('beritaModal');
    beritaModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('beritaForm').reset();
        document.getElementById('modalTitle').textContent = 'Tambah Berita Baru';
        document.getElementById('beritaId').value = '';
        document.getElementById('beritaForm').action = "{{ route('berita.store') }}";
        document.getElementById('beritaForm').method = "POST";
        document.getElementById('fotoPreview').style.display = 'none';
        
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

<style>
.berita-content {
    line-height: 1.8;
    text-align: justify;
}

.table-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
@endpush