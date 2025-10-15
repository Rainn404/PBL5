@extends('layouts.app_admin')

@section('title', 'Detail Pendaftaran - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Detail Pendaftaran</h1>
            <p class="text-muted">Detail data pendaftaran anggota</p>
        </div>
        <div>
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            <a href="{{ route('admin.pendaftaran.edit', $pendaftaran->id_pendaftaran) }}" class="btn btn-outline-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Pribadi</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Nama</strong></td><td>{{ $pendaftaran->nama }}</td></tr>
                                <tr><td><strong>NIM</strong></td><td>{{ $pendaftaran->nim }}</td></tr>
                                <tr><td><strong>Semester</strong></td><td>Semester {{ $pendaftaran->semester }}</td></tr>
                                <tr><td><strong>No HP</strong></td><td>{{ $pendaftaran->no_hp ?? '-' }}</td></tr>
                                <tr><td><strong>Email</strong></td><td>{{ $pendaftaran->user->email ?? '-' }}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pendaftaran</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Tanggal Daftar</strong></td><td>{{ $pendaftaran->submitted_at->format('d M Y H:i') }}</td></tr>
                                <tr><td><strong>Status</strong></td>
                                    <td>
                                        <span class="badge {{ $pendaftaran->status_pendaftaran === 'pending' ? 'bg-warning' : ($pendaftaran->status_pendaftaran === 'diterima' ? 'bg-success' : 'bg-danger') }}">
                                            {{ ucfirst($pendaftaran->status_pendaftaran) }}
                                        </span>
                                    </td>
                                </tr>
                                @if($pendaftaran->divalidasi_oleh)
                                <tr><td><strong>Divalidasi Oleh</strong></td><td>{{ $pendaftaran->validator->nama ?? 'Admin' }}</td></tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6>Alasan Mendaftar</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($pendaftaran->alasan_mendaftar)) !!}
                        </div>
                    </div>

                    @if($pendaftaran->dokumen)
                    <div class="mt-3">
                        <h6>Dokumen Pendaftaran</h6>
                        <a href="{{ asset('storage/' . $pendaftaran->dokumen) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-file-pdf me-2"></i>Lihat Dokumen
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    @if($pendaftaran->status_pendaftaran == 'pending')
                    <form action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_pendaftaran" value="diterima">
                        <input type="hidden" name="id_divisi" value="1">
                        <input type="hidden" name="id_jabatan" value="1">
                        <button type="submit" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-check me-2"></i>Terima
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_pendaftaran" value="ditolak">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-times me-2"></i>Tolak
                        </button>
                    </form>
                    @endif

                    <hr>
                    
                    <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id_pendaftaran) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection