@extends('layouts.app_admin')

@section('title', 'Edit Mahasiswa Bermasalah')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Mahasiswa Bermasalah</h2>

    <form action="{{ route('mahasiswa-bermasalah.update', $mahasiswa->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" 
                   name="nama" 
                   id="nama" 
                   class="form-control" 
                   value="{{ old('nama', $mahasiswa->nama) }}" 
                   required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" 
                   name="nim" 
                   id="nim" 
                   class="form-control" 
                   value="{{ old('nim', $mahasiswa->nim) }}" 
                   required>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="number" 
                   name="semester" 
                   id="semester" 
                   class="form-control" 
                   value="{{ old('semester', $mahasiswa->semester) }}">
        </div>

        <div class="mb-3">
            <label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
            <input type="text" 
                   name="nama_orang_tua" 
                   id="nama_orang_tua" 
                   class="form-control" 
                   value="{{ old('nama_orang_tua', $mahasiswa->nama_orang_tua) }}">
        </div>

        <div class="mb-3">
            <label for="id_masalah" class="form-label">Pelanggaran</label>
            <select name="id_masalah" id="id_masalah" class="form-select" required>
                <option value="">-- Pilih Pelanggaran --</option>
                @foreach($pelanggaranList as $p)
                    <option value="{{ $p->id_masalah }}" 
                        {{ $mahasiswa->id_masalah == $p->id_masalah ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" 
                   name="tanggal" 
                   id="tanggal" 
                   class="form-control" 
                   value="{{ old('tanggal', $mahasiswa->tanggal) }}" 
                   required>
        </div>

        <div class="mb-3">
            <label for="bukti" class="form-label">Bukti (opsional)</label>
            @if($mahasiswa->bukti)
                <p>File saat ini: <a href="{{ asset('storage/'.$mahasiswa->bukti) }}" target="_blank">Lihat</a></p>
            @endif
            <input type="file" name="bukti" id="bukti" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('mahasiswa-bermasalah.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
