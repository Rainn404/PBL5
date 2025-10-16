@extends('layouts.app_admin')

@section('title', 'Tambah Mahasiswa - HIMA-TI')

@section('content')
    @include('admin.mahasiswa.form', [
        'title' => 'Tambah Data Mahasiswa',
        'action' => route('admin.mahasiswa.store'),
        'mahasiswa' => null
    ])
@endsection