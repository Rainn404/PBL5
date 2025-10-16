@extends('layouts.app')

@section('title', 'Detail Prestasi - HIMA Sistem Manajemen')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Detail Prestasi
                    </h4>
                    <a href="{{ route('prestasi.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Informasi Prestasi</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Nama Prestasi</th>
                                        <td>{{ $prestasi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $prestasi->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $prestasi->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge {{ $prestasi->status == 'Tervalidasi' ? 'bg-success' : ($prestasi->status == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ $prestasi->status }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Informasi Mahasiswa</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">NIM</th>
                                        <td>{{ $prestasi->nim }}</td>
                                    </tr>
                                    <tr>
                                        <th>Semester</th>
                                        <td>{{ $prestasi->semester }}</td>
                                    </tr>
                                    <tr>
                                        <th>IPK</th>
                                        <td>
                                            @if($prestasi->ipk)
                                            <span class="badge bg-info">{{ $prestasi->ipk }}</span>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $prestasi->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td>{{ $prestasi->no_hp }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Periode Kegiatan</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Tanggal Mulai</th>
                                        <td>{{ $prestasi->tanggal_mulai->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>{{ $prestasi->tanggal_selesai->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>{{ $prestasi->tanggal_mulai->diffInDays($prestasi->tanggal_selesai) + 1 }} hari</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Bukti Prestasi</h5>
                                @if($prestasi->bukti)
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-paperclip fa-2x text-muted me-3"></i>
                                    <div>
                                        <p class="mb-1">File bukti terlampir</p>
                                        <a href="{{ Storage::url($prestasi->bukti) }}" target="_blank" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download me-1"></i>Download Bukti
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="text-muted">
                                    <i class="fas fa-times-circle me-2"></i>Tidak ada bukti terlampir
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                @if($prestasi->status === 'Menunggu Validasi')
                                <a href="{{ route('prestasi.edit', $prestasi->id_prestasi) }}" class="btn btn-primary me-2">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('prestasi.destroy', $prestasi->id_prestasi) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                                @else
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Prestasi yang sudah divalidasi tidak dapat diubah atau dihapus.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection