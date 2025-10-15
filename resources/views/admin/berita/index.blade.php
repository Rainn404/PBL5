@extends('layouts.app_admin')

@section('title', 'Daftar Berita')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Manajemen Berita</h1>

    {{-- Alert notifikasi --}}
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

    {{-- Tombol tambah berita --}}
    <div class="mb-3">
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Berita
        </a>
    </div>

    {{-- Tabel daftar berita --}}
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
                                    <a href="{{ route('admin.berita.show', $row->Id_berita) }}"
                                       class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>

                                    <a href="{{ route('admin.berita.edit', $row->Id_berita) }}"
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.berita.destroy', $row->Id_berita) }}"
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
            @endif
        </div>
    </div>
</div>
@endsection
