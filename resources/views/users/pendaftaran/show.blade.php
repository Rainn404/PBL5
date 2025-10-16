@extends('layouts.app')

@section('title', 'Detail Pendaftaran - HIMA-TI')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Detail Pendaftaran</h1>
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $pendaftaran->status_badge }}">
                    {{ $pendaftaran->status_label }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Pribadi</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                            <dd class="text-sm text-gray-900">{{ $pendaftaran->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">NIM</dt>
                            <dd class="text-sm text-gray-900">{{ $pendaftaran->nim }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Semester</dt>
                            <dd class="text-sm text-gray-900">Semester {{ $pendaftaran->semester }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">No. HP</dt>
                            <dd class="text-sm text-gray-900">{{ $pendaftaran->no_hp }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pendaftaran</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Daftar</dt>
                            <dd class="text-sm text-gray-900">{{ $pendaftaran->submitted_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="text-sm">
                                <span class="px-2 py-1 rounded-full {{ $pendaftaran->status_badge }}">
                                    {{ $pendaftaran->status_label }}
                                </span>
                            </dd>
                        </div>
                        @if($pendaftaran->dokumen)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dokumen</dt>
                            <dd class="text-sm text-gray-900">
                                <a href="{{ Storage::url($pendaftaran->dokumen) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-download mr-1"></i> Download Dokumen
                                </a>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Alasan Bergabung</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-700">{{ $pendaftaran->alasan_mendaftar }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('pendaftaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                    Kembali
                </a>
                <a href="{{ route('pendaftaran.edit', $pendaftaran->id_pendaftaran) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection