@extends('layouts.app_admin')

<<<<<<< HEAD
@section('title', 'Berita - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Manajemen Berita</h1>
            <p class="text-muted">Kelola berita dan informasi organisasi</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beritaModal" onclick="resetForm()">
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

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari berita...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="filterPenulis" class="form-select">
                        <option value="">Semua Penulis</option>
                        @foreach($penulisList as $penulis)
                            <option value="{{ $penulis }}">{{ $penulis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="month" id="filterBulan" class="form-control" value="{{ date('Y-m') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="beritaTable">
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
                        <tr data-judul="{{ strtolower($item->judul) }}" 
                            data-penulis="{{ $item->penulis }}" 
                            data-tanggal="{{ $item->tanggal }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="rounded me-3" 
                                         style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center me-3" 
                                         style="width: 60px; height: 40px;">
                                        <i class="fas fa-newspaper text-white"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <strong>{{ Str::limit($item->judul, 50) }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ Str::limit(strip_tags($item->isi), 70) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $item->penulis ?? 'Admin' }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editBerita({{ $item->id_berita }})"
                                            data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="previewBerita({{ $item->id_berita }})"
                                            data-bs-toggle="tooltip" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $item->id_berita }})"
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
                                    <button class="btn btn-primary mt-2" onclick="resetForm()" data-bs-toggle="modal" data-bs-target="#beritaModal">
                                        <i class="fas fa-plus me-1"></i>Tambah Berita Pertama
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($berita->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $berita->firstItem() }} - {{ $berita->lastItem() }} dari {{ $berita->total() }} berita
                </div>
                <nav>
                    {{ $berita->links() }}
                </nav>
            </div>
=======
@section('title', 'Daftar Berita')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Manajemen Berita</h1>

    {{-- ✅ Alert notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ✅ Tombol tambah berita --}}
    <div class="mb-3">
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Berita
        </a>
    </div>

    {{-- ✅ Daftar berita --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light fw-semibold">Daftar Berita</div>
        <div class="card-body p-0">
            @if($berita->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Foto</th>
                            <th style="width:240px;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($berita as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->judul ?? $row->Judul_berita ?? '-' }}</td>
                                <td>{{ $row->nama_penulis ?? $row->Nama_penulis ?? '-' }}</td>
                                <td>
                                    @if($row->foto)
                                        @php
                                            $exists = Storage::disk('public')->exists($row->foto);
                                            $url = $exists
                                                ? asset('storage/' . $row->foto)
                                                : asset('images/no-image.png');
                                        @endphp
                                        <img src="{{ $url }}"
                                             class="img-thumbnail rounded"
                                             style="height:60px;object-fit:cover;"
                                             alt="Foto Berita">
                                        @unless($exists)
                                            <div class="small text-danger mt-1">
                                                File tidak ditemukan di storage: {{ $row->foto }}
                                            </div>
                                        @endunless
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.berita.show', $row->Id_berita ?? $row->id) }}"
                                       class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>

                                    <a href="{{ route('admin.berita.edit', $row->Id_berita ?? $row->id) }}"
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.berita.destroy', $row->Id_berita ?? $row->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted p-3 mb-0">Belum ada berita.</p>
>>>>>>> 1d52fc143bace73a1e89abde13fde41160ae60a8
            @endif
        </div>
    </div>
</div>
<<<<<<< HEAD

<!-- Modal Tambah/Edit Berita -->
<div class="modal fade" id="beritaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Berita Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="beritaForm" method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
                @csrf
                <div id="formMethod"></div>
                <div class="modal-body">
                    <input type="hidden" id="beritaId" name="id_berita">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" 
                                   placeholder="Masukkan judul berita" 
                                   value="{{ old('judul') }}" 
                                   required maxlength="200">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="isi" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      id="isi" name="isi" 
                                      rows="6" 
                                      placeholder="Tulis isi berita disini..." 
                                      required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                   id="tanggal" name="tanggal" 
                                   value="{{ old('tanggal', date('Y-m-d')) }}" 
                                   required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                                   id="penulis" name="penulis" 
                                   placeholder="Nama penulis" 
                                   value="{{ old('penulis') }}" 
                                   maxlength="100">
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="foto" class="form-label">Foto Berita</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" 
                                   accept="image/*">
                            <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB</div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Preview Image -->
                            <div id="fotoPreview" class="mt-2" style="display: none;">
                                <img id="previewImage" src="" class="img-thumbnail" style="max-height: 150px;">
                                <div class="mt-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                        <i class="fas fa-times me-1"></i>Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus berita ini?</p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi reset form
function resetForm() {
    document.getElementById('modalTitle').textContent = 'Tambah Berita Baru';
    document.getElementById('beritaForm').reset();
    document.getElementById('beritaForm').action = "{{ route('admin.berita.store') }}";
    document.getElementById('formMethod').innerHTML = '';
    document.getElementById('fotoPreview').style.display = 'none';
    document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
    document.getElementById('beritaId').value = '';
    
    // Reset validation
    const invalidElements = document.querySelectorAll('.is-invalid');
    invalidElements.forEach(element => {
        element.classList.remove('is-invalid');
    });
}

// Fungsi edit berita
async function editBerita(id) {
    try {
        const response = await fetch("{{ url('admin/berita') }}/" + id);
        if (!response.ok) throw new Error('Data tidak ditemukan');
        
        const berita = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Edit Berita';
        document.getElementById('beritaId').value = berita.id_berita;
        document.getElementById('judul').value = berita.judul;
        document.getElementById('isi').value = berita.isi;
        document.getElementById('tanggal').value = berita.tanggal.split('T')[0];
        document.getElementById('penulis').value = berita.penulis || '';
        
        // Set form action dan method untuk update
        document.getElementById('beritaForm').action = "{{ url('admin/berita') }}/" + id;
        document.getElementById('formMethod').innerHTML = '@method("PUT")';
        
        // Preview gambar jika ada
        if (berita.foto) {
            document.getElementById('previewImage').src = "{{ asset('storage') }}/" + berita.foto;
            document.getElementById('fotoPreview').style.display = 'block';
        } else {
            document.getElementById('fotoPreview').style.display = 'none';
        }
        
        const modal = new bootstrap.Modal(document.getElementById('beritaModal'));
        modal.show();
    } catch (error) {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memuat data berita', 'error');
    }
}

// Fungsi preview berita
async function previewBerita(id) {
    try {
        const response = await fetch("{{ url('admin/berita') }}/" + id);
        if (!response.ok) throw new Error('Data tidak ditemukan');
        
        const berita = await response.json();
        
        document.getElementById('previewTitle').textContent = berita.judul;
        
        let content = `
            <div class="text-center mb-4">
                ${berita.foto ? 
                    `<img src="{{ asset('storage') }}/${berita.foto}" 
                         alt="${berita.judul}" 
                         class="img-fluid rounded shadow" 
                         style="max-height: 300px; width: auto;">` 
                    : '<div class="bg-light rounded p-5 text-muted"><i class="fas fa-newspaper fa-3x"></i><p class="mt-2">Tidak ada gambar</p></div>'
                }
            </div>
            <h3 class="mb-3">${berita.judul}</h3>
            <div class="text-muted mb-4 border-bottom pb-3">
                <small><i class="fas fa-calendar me-1"></i> 
                ${new Date(berita.tanggal).toLocaleDateString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                })}</small>
                <span class="mx-2">•</span>
                <small><i class="fas fa-user me-1"></i> ${berita.penulis || 'Admin'}</small>
            </div>
            <div class="berita-content">
                ${berita.isi.replace(/\n/g, '<br>')}
            </div>
        `;
        
        document.getElementById('previewContent').innerHTML = content;
        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
        modal.show();
    } catch (error) {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memuat preview berita', 'error');
    }
}

// Fungsi konfirmasi hapus
function confirmDelete(id) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = "{{ url('admin/berita') }}/" + id;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Preview image sebelum upload
document.getElementById('foto').addEventListener('change', function(e) {
    const preview = document.getElementById('fotoPreview');
    const previewImage = document.getElementById('previewImage');
    
    if (this.files && this.files[0]) {
        // Validasi ukuran file (max 2MB)
        if (this.files[0].size > 2 * 1024 * 1024) {
            showAlert('Ukuran file maksimal 2MB', 'error');
            this.value = '';
            return;
        }
        
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

// Fungsi hapus gambar preview
function removeImage() {
    document.getElementById('foto').value = '';
    document.getElementById('fotoPreview').style.display = 'none';
}

// Fungsi untuk menampilkan alert
function showAlert(message, type = 'success') {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <i class="fas ${icon} me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.querySelector('.fade-in-up').insertBefore(alertDiv, document.querySelector('.table-card'));
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 5000);
}

// Search and Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterPenulis = document.getElementById('filterPenulis');
    const filterBulan = document.getElementById('filterBulan');
    const tableRows = document.querySelectorAll('#beritaTable tbody tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const penulisFilter = filterPenulis.value;
        const bulanFilter = filterBulan.value;
        
        tableRows.forEach(row => {
            const judul = row.getAttribute('data-judul');
            const penulis = row.getAttribute('data-penulis');
            const tanggal = row.getAttribute('data-tanggal');
            const rowBulan = tanggal.substring(0, 7); // Get YYYY-MM
            
            const matchSearch = judul.includes(searchTerm);
            const matchPenulis = !penulisFilter || penulis === penulisFilter;
            const matchBulan = !bulanFilter || rowBulan === bulanFilter;
            
            if (matchSearch && matchPenulis && matchBulan) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterTable);
    filterPenulis.addEventListener('change', filterTable);
    filterBulan.addEventListener('change', filterTable);
    
    // Set tanggal default ke hari ini
    document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
    
    // Reset modal ketika ditutup
    const beritaModal = document.getElementById('beritaModal');
    beritaModal.addEventListener('hidden.bs.modal', function() {
        resetForm();
    });
    
    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Form submission loading state
    document.getElementById('beritaForm').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
    });
});
</script>

<style>
.berita-content {
    line-height: 1.8;
    text-align: justify;
    font-size: 1.1em;
}

.table-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background: white;
}

.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.fade-in-up {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.btn-group .btn {
    border-radius: 6px;
    margin: 0 2px;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.modal-content {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
</style>
@endpush
=======
@endsection
>>>>>>> 1d52fc143bace73a1e89abde13fde41160ae60a8
