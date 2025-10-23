@extends('layouts.app')

@section('title', 'Edit Prestasi - HIMA Sistem Manajemen')

@section('content')
    @include('prestasi.form', [
        'title' => 'Edit Prestasi',
        'action' => route('prestasi.update', $prestasi->id_prestasi),
        'prestasi' => $prestasi
    ])
@endsection