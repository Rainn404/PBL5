@extends('layouts.admin.app')

@section('content')
<a href="{{ route('admin.berita.index') }}" 
   class="btn text-white px-4 py-2 mb-3"
   style="background: linear-gradient(90deg, #0062ff, #4b9cff); border-radius: 10px; font-weight:600;">
    ← Kembali ke Berita
</a>

<h2>Daftar Komentar</h2>

<table class="table">
    <thead>
        <tr>
            <th>Berita</th>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($komentars as $k)
        <tr>
            <td>{{ optional($k->berita)->judul ?? '-' }}</td>
            <td>{{ $k->nama ?? 'Anonim' }}</td>
            <td>{{ $k->isi }}</td>
            <td>{{ $k->created_at->format('d M Y') }}</td>

            <td>
                <form action="{{ route('admin.komentar.destroy', $k->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
