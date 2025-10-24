@extends('layouts.admin.app')

@section('title', 'Kelola Anggota - HIMA Sistem Manajemen')

@section('content')
    <div class="fade-in-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold gradient-text mb-1">Kelola Anggota Satu</h1>
                <p class="text-muted">Kelola data anggota HIMA</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#anggotaModal">
                <i class="fas fa-plus me-2"></i>Tambah Anggota Baru1 <div class=""></div>
            </button>
        </div>

        <!-- Alert Notifikasi -->
        @if (session('success'))
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
                            @foreach ($divisi as $item)
                                <option value="{{ $item->nama_divisi }}">{{ $item->nama_divisi }}</option>
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
                    <table class="table table-hover align-middle">
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
                            @foreach ($anggota as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->foto
                                                ? asset('storage/' . $item->foto)
                                                : 'https://ui-avatars.com/api/?name=' . urlencode($item->nama) . '&background=3B82F6&color=fff' }}"
                                                alt="{{ $item->nama }}"
                                                class="rounded-circle shadow-sm me-3 border border-2 border-primary-subtle"
                                                width="45" height="45" style="object-fit: cover;">

                                            <div>
                                                <strong>{{ $item->nama }}</strong><br>
                                                <small class="text-muted">{{ $item->user->email ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->nim }}</td>
                                    <td><span class="badge bg-info">{{ $item->divisi->nama_divisi ?? '-' }}</span></td>
                                    <td>{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="editAnggota({{ $item->id_anggota_hima }})"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="confirmDelete({{ $item->id_anggota_hima }})"
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

    <!-- Modal Tambah/Edit Anggota -->
    <div class="modal fade" id="anggotaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="anggotaForm" method="POST" action="{{ route('admin.anggota.store') }}"
                    enctype="multipart/form-data">
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
                                <label for="id_divisi" class="form-label">Divisi *</label>
                                <select class="form-select" id="id_divisi" name="id_divisi" required>
                                    <option value="">Pilih Divisi</option>
                                    @foreach ($divisi as $item)
                                        <option value="{{ $item->id_divisi }}">{{ $item->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="id_jabatan" class="form-label">Jabatan *</label>
                                <select class="form-select" id="id_jabatan" name="id_jabatan">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="semester" class="form-label">Semester *</label>
                                <input type="number" class="form-control" id="semester" name="semester"
                                    min="1" max="14" required>
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    accept="image/*">
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
        const anggotaData = @json($anggota);

        function editAnggota(id) {
            const anggota = anggotaData.find(a => a.id_anggota_hima === id);
            if (anggota) {
                document.getElementById('modalTitle').textContent = 'Edit Anggota';
                document.getElementById('anggotaId').value = anggota.id_anggota_hima;
                document.getElementById('nama').value = anggota.nama;
                document.getElementById('nim').value = anggota.nim;
                document.getElementById('id_divisi').value = anggota.id_divisi;
                document.getElementById('id_jabatan').value = anggota.id_jabatan;
                document.getElementById('semester').value = anggota.semester;
                document.getElementById('status').value = anggota.status ? 1 : 0;

                const form = document.getElementById('anggotaForm');
                form.action = "{{ url('admin/anggota') }}/" + id;
                form.method = "POST";

                if (!document.querySelector('input[name=\"_method\"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                new bootstrap.Modal(document.getElementById('anggotaModal')).show();
            }
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus anggota ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ url('admin/anggota') }}/" + id;

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

        document.addEventListener('DOMContentLoaded', function() {
            const anggotaModal = document.getElementById('anggotaModal');
            anggotaModal.addEventListener('hidden.bs.modal', function() {
                const form = document.getElementById('anggotaForm');
                form.reset();
                document.getElementById('modalTitle').textContent = 'Tambah Anggota';
                form.action = "{{ route('admin.anggota.store') }}";
                form.method = "POST";
                const methodInput = document.querySelector('input[name=\"_method\"]');
                if (methodInput) methodInput.remove();
            });
        });
    </script>
@endpush
