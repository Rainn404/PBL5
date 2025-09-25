@extends('layouts.app_admin')

@section('content')
<h1>Form Pelanggaran & Sanksi</h1>

<form action="{{ route('admin.pelanggaran-sanksi.store') }}" method="POST">
    @csrf
    <label>Nama Pelanggaran:</label>
    <input type="text" name="nama_pelanggaran" required>
    <br>
    <label>Deskripsi Pelanggaran:</label>
    <textarea name="deskripsi_pelanggaran"></textarea>
    <br>
    <label>Nama Sanksi:</label>
    <input type="text" name="nama_sanksi" required>
    <br>
    <label>Deskripsi Sanksi:</label>
    <textarea name="deskripsi_sanksi"></textarea>
    <br>
    <button type="submit">Simpan</button>
</form>
@endsection
