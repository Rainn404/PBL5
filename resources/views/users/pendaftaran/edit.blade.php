@extends('layouts.app')

@section('title', 'Edit Pendaftaran - HIMA-TI')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Pendaftaran</h1>

            <form action="{{ route('pendaftaran.update', $pendaftaran->id_pendaftaran) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $pendaftaran->nama) }}" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIM dan Semester -->
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM *</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim', $pendaftaran->nim) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nim')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                        <select id="semester" name="semester" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester', $pendaftaran->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                        @error('semester')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP *</label>
                        <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status_pendaftaran" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select id="status_pendaftaran" name="status_pendaftaran" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="pending" {{ old('status_pendaftaran', $pendaftaran->status_pendaftaran) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diterima" {{ old('status_pendaftaran', $pendaftaran->status_pendaftaran) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ old('status_pendaftaran', $pendaftaran->status_pendaftaran) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status_pendaftaran')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alasan -->
                    <div class="md:col-span-2">
                        <label for="alasan_mendaftar" class="block text-sm font-medium text-gray-700">Alasan Bergabung dengan HIMA-TI *</label>
                        <textarea id="alasan_mendaftar" name="alasan_mendaftar" rows="4" required
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alasan_mendaftar', $pendaftaran->alasan_mendaftar) }}</textarea>
                        @error('alasan_mendaftar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dokumen -->
                    <div class="md:col-span-2">
                        <label for="dokumen" class="block text-sm font-medium text-gray-700">Upload CV/Portofolio (Opsional)</label>
                        @if($pendaftaran->dokumen)
                        <div class="mb-2">
                            <p class="text-sm text-gray-600">File saat ini:</p>
                            <a href="{{ Storage::url($pendaftaran->dokumen) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-download mr-1"></i> Download Dokumen
                            </a>
                        </div>
                        @endif
                        <input type="file" id="dokumen" name="dokumen" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                               accept=".pdf,.doc,.docx">
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX (Maks. 2MB)</p>
                        @error('dokumen')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('pendaftaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection