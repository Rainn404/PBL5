@extends('layouts.app_admin')

@section('title', 'Edit Prestasi - HIMA Sistem Manajemen')

@section('content')
    @include('admin.prestasi.form', [
        'title' => 'Edit Prestasi',
        'action' => route('admin.prestasi.update', $prestasi->id_prestasi),
        'prestasi' => $prestasi
    ])
@endsection