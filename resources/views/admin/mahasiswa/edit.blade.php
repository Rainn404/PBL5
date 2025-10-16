@extends('layouts.app_admin')

@section('title', 'Edit Mahasiswa - HIMA-TI')

@section('content')
    @include('admin.mahasiswa.form', [
        'title' => 'Edit Data Mahasiswa',
        'action' => route('admin.mahasiswa.update', $mahasiswa->id),
        'mahasiswa' => $mahasiswa
    ])
@endsection