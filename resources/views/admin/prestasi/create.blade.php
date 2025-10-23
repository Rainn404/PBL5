@extends('layouts.admin.app')

@section('title', 'Tambah Prestasi - HIMA Sistem Manajemen')

@section('content')
    @include('admin.prestasi.form', [
        'title' => 'Tambah Prestasi',
        'action' => route('admin.prestasi.store'),
        'prestasi' => null
    ])
@endsection