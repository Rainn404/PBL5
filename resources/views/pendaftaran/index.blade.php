@extends('layouts.app')

@section('content')
  <!-- Hero -->
  <section class="hero bg-blue-600 text-white text-center py-6">
      <h2 class="text-xl font-bold">Portal Pendaftaran Anggota Baru Hima-TI Politala</h2>
      <p>Temukan informasi pendaftaran dan berita terbaru di HIMA-TI Politala</p>
  </section>

  <!-- Card Form -->
  <div class="max-w-3xl mx-auto my-6 p-6 bg-white rounded shadow">
      <h3 class="text-center text-lg font-bold mb-4">
          Form Pendaftaran Anggota Baru Hima-TI Politala
      </h3>

      @if(session('success'))
          <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
              {{ session('success') }}
          </div>
      @endif

      <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf
          <div>
              <label class="block font-semibold">Nama Lengkap</label>
              <input type="text" name="nama" class="w-full border p-2 rounded" required>
          </div>

          <div class="grid grid-cols-2 gap-4">
              <div>
                  <label class="block font-semibold">NIM</label>
                  <input type="text" name="nim" class="w-full border p-2 rounded" required>
              </div>
              <div>
                  <label class="block font-semibold">Program Studi</label>
                  <input type="text" name="prodi" class="w-full border p-2 rounded" required>
              </div>
          </div>

          <div>
              <label class="block font-semibold">Pilih Divisi</label>
              <select name="divisi" class="w-full border p-2 rounded" required>
                  <option value="">-- Pilih Divisi --</option>
                  <option value="internal">Internal</option>
                  <option value="external">External</option>
                  <option value="kewirausahaan">Kewirausahaan</option>
                  <option value="media">Media & IT</option>
              </select>
          </div>

          <div>
              <label class="block font-semibold">Unggah Foto (maks 2MB)</label>
              <input type="file" name="foto" accept="image/*" class="w-full border p-2 rounded">
          </div>

          <div class="flex justify-end gap-2">
              <button type="reset" class="px-4 py-2 border rounded">Bersihkan</button>
              <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Kirim Pendaftaran</button>
          </div>
      </form>
  </div>
@endsection
