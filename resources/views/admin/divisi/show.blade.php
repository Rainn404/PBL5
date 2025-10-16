@extends('layouts.admin')

@section('title', 'Detail Divisi - Admin HIMA-TI')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Divisi</h1>
        <div>
            <a href="{{ route('admin.divisi.edit', $divisi->id_divisi) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Divisi</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">ID Divisi</th>
                            <td>{{ $divisi->id_divisi }}</td>
                        </tr>
                        <tr>
                            <th>Nama Divisi</th>
                            <td>{{ $divisi->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Anggota</th>
                            <td>
                                <span class="badge badge-primary">{{ $divisi->anggotaHima->count() }} Anggota</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h5>Deskripsi Divisi</h5>
                    <div class="border p-3 rounded">
                        @if($divisi->deskripsi)
                            {{ $divisi->deskripsi }}
                        @else
                            <span class="text-muted">Tidak ada deskripsi</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($divisi->anggotaHima->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Anggota Divisi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($divisi->anggotaHima as $anggota)
                                <tr>
                                    <td>{{ $anggota->nama }}</td>
                                    <td>{{ $anggota->nim }}</td>
                                    <td>{{ $anggota->semester }}</td>
                                    <td>
                                        <span class="badge badge-{{ $anggota->status == 'active' ? 'success' : 'warning' }}">
                                            {{ $anggota->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection