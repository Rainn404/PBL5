@extends('layouts.app_admin')

@section('title', 'Mahasiswa Bermasalah - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Mahasiswa Bermasalah</h1>
            <p class="text-muted">Kelola data mahasiswa bermasalah dan sanksi</p>
        </div>
        <div>
            <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#pelanggaranModal">
                <i class="fas fa-plus me-2"></i>Tambah Pelanggaran
            </button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mahasiswaModal">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </button>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Semester</th>
                            <th>Pelanggaran</th>
                            <th>Sanksi</th>
                            <th>Tanggal</th>
                            <th>Bukti</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswaBermasalah as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=EF4444&color=fff" 
                                         alt="{{ $item->nama }}" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <strong>{{ $item->nama }}</strong>
                                        @if($item->nama_orang_tua)
                                        <br><small class="text-muted">Ortu: {{ $item->nama_orang_tua }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->semester ?? '-' }}</td>
                            <td>
                                <span class="badge bg-warning">{{ $item->pelanggaran->nama }}</span>
                            </td>
                            <td>
                                <span class="badge bg-danger">{{ $item->sanksi->nama_sanksi }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                            <td>
                                @if($item->bukti)
                                <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editMahasiswa({{ $item->id }})"
                                            data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $item->id }})"
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
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Mahasiswa Bermasalah -->
<div class="modal fade" id="mahasiswaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Data Mahasiswa Bermasalah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="mahasiswaForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.mahasiswa-bermasalah.store') }}">
                @csrf
                <div id="formMethod"></div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Mahasiswa *</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nim" class="form-label">NIM *</label>
                            <input type="text" class="form-control" id="nim" name="nim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="number" class="form-control" id="semester" name="semester" min="1" max="14">
                        </div>
                        <div class="col-md-6">
                            <label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
                            <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua">
                        </div>
                        <div class="col-md-6">
                            <label for="id_masalah" class="form-label">Pelanggaran *</label>
                            <select class="form-select" id="id_masalah" name="id_masalah" required onchange="loadSanksi()">
                                <option value="">Pilih Pelanggaran</option>
                                @foreach($pelanggaranList as $pelanggaran)
                                <option value="{{ $pelanggaran->id_masalah }}" data-sanksi="{{ $pelanggaran->sanksi->id_sanksi }}">
                                    {{ $pelanggaran->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sanksi_display" class="form-label">Sanksi *</label>
                            <input type="text" class="form-control" id="sanksi_display" readonly>
                            <input type="hidden" id="id_sanksi" name="id_sanksi">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal Pelanggaran *</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label for="bukti" class="form-label">Bukti</label>
                            <input type="file" class="form-control" id="bukti" name="bukti" accept=".jpg,.jpeg,.png,.pdf">
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

<!-- Modal Tambah Pelanggaran -->
<div class="modal fade" id="pelanggaranModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggaran & Sanksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="pelanggaranForm" action="{{ route('admin.pelanggaran-sanksi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_pelanggaran" class="form-label">Nama Pelanggaran *</label>
                        <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_pelanggaran" class="form-label">Deskripsi Pelanggaran</label>
                        <textarea class="form-control" id="deskripsi_pelanggaran" name="deskripsi_pelanggaran" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nama_sanksi" class="form-label">Sanksi *</label>
                        <input type="text" class="form-control" id="nama_sanksi" name="nama_sanksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_sanksi" class="form-label">Deskripsi Sanksi</label>
                        <textarea class="form-control" id="deskripsi_sanksi" name="deskripsi_sanksi" rows="2"></textarea>
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
function loadSanksi() {
    const select = document.getElementById('id_masalah');
    const selectedOption = select.options[select.selectedIndex];
    const sanksiId = selectedOption.getAttribute('data-sanksi');
    const sanksiText = selectedOption.text;
    
    if (sanksiId) {
        document.getElementById('sanksi_display').value = sanksiText;
        document.getElementById('id_sanksi').value = sanksiId;
    } else {
        document.getElementById('sanksi_display').value = '';
        document.getElementById('id_sanksi').value = '';
    }
}

function editMahasiswa(id) {
    fetch(`{{ url('admin/mahasiswa-bermasalah/edit') }}/${id}`)

        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = 'Edit Data Mahasiswa Bermasalah';
                document.getElementById('nama').value = data.mahasiswa.nama;
                document.getElementById('nim').value = data.mahasiswa.nim;
                document.getElementById('semester').value = data.mahasiswa.semester || '';
                document.getElementById('nama_orang_tua').value = data.mahasiswa.nama_orang_tua || '';
                document.getElementById('id_masalah').value = data.mahasiswa.id_masalah;
                loadSanksi();
                document.getElementById('tanggal').value = data.mahasiswa.tanggal;
                document.getElementById('formMethod').innerHTML = '<input type="hidden" name="_method" value="PUT">';
                 document.getElementById('mahasiswaForm').action = `{{ url('admin/mahasiswa-bermasalah') }}/${id}`;

                const modal = new bootstrap.Modal(document.getElementById('mahasiswaModal'));
                modal.show();
                 
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data');
        });
}


function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/mahasiswa-bermasalah/${id}`;
        
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
    const mahasiswaModal = document.getElementById('mahasiswaModal');
    mahasiswaModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('mahasiswaForm').reset();
        document.getElementById('modalTitle').textContent = 'Tambah Data Mahasiswa Bermasalah';
        document.getElementById('mahasiswaForm').action = "{{ route('admin.mahasiswa-bermasalah.store') }}";
        document.getElementById('formMethod').innerHTML = '';
        document.getElementById('sanksi_display').value = '';
        document.getElementById('id_sanksi').value = '';
        document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
    });
    
    // Set tanggal default
    document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
    
    // Inisialisasi tooltip
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
// Tambah pelanggaran baru - PERBAIKAN
document.getElementById('pelanggaranForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch("{{ route('admin.pelanggaran-sanksi.store') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tampilkan pesan sukses
            alert('Pelanggaran berhasil ditambahkan!');
            
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('pelanggaranModal'));
            modal.hide();
            
            // Refresh halaman untuk menampilkan data baru
            location.reload();
        } else {
            alert('Gagal menambahkan pelanggaran: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan');
    });
});
</script>
@endpush