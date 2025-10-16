@extends('layouts.app_admin')

@section('title', 'Edit Pendaftaran - HIMA Sistem Manajemen')

@section('content')
<div class="fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold gradient-text mb-1">Edit Pendaftaran</h1>
            <p class="text-muted">Edit data pendaftaran anggota</p>
        </div>
        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- Alert validasi & notifikasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali input Anda:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif

            <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id_pendaftaran) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                   id="nim" name="nim" value="{{ old('nim', $pendaftaran->nim) }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $pendaftaran->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select class="form-select @error('semester') is-invalid @enderror" 
                                    id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}" {{ old('semester', $pendaftaran->semester) == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                   id="no_hp" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" 
                                   inputmode="numeric" pattern="^[0-9+\s-]{8,16}$" maxlength="16" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alasan_mendaftar" class="form-label">Alasan Mendaftar <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alasan_mendaftar') is-invalid @enderror" 
                              id="alasan_mendaftar" name="alasan_mendaftar" rows="4" required>{{ old('alasan_mendaftar', $pendaftaran->alasan_mendaftar) }}</textarea>
                    @error('alasan_mendaftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dokumen" class="form-label">Dokumen Pendaftaran</label>
                    @if($pendaftaran->dokumen)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $pendaftaran->dokumen) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-pdf me-1"></i>Lihat Dokumen Saat Ini
                            </a>
                        </div>
                        @php
                            $isImage = Str::of($pendaftaran->dokumen ?? '')->lower()->endsWith(['.jpg', '.jpeg', '.png']);
                        @endphp
                        @if($isImage)
                            <img src="{{ asset('storage/' . $pendaftaran->dokumen) }}" alt="Preview Dokumen"
                                 class="img-thumbnail mb-2" style="max-height:160px">
                        @endif
                    @endif
                    <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                           id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png" onchange="validateFile(this)">
                    <div class="form-text">Format: PDF/JPG/PNG, ukuran maks. 2 MB. Kosongkan jika tidak ingin mengubah dokumen</div>
                    @error('dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function validateFile(input) {
    if (!input.files || !input.files[0]) return;
    const f = input.files[0];
    const maxBytes = 2 * 1024 * 1024; // 2MB
    const okTypes = ['application/pdf','image/jpeg','image/png'];

    if (!okTypes.includes(f.type)) {
        alert('Format file harus PDF/JPG/PNG.');
        input.value = '';
        return;
    }
    if (f.size > maxBytes) {
        alert('Ukuran file maksimal 2 MB.');
        input.value = '';
    }
}
</script>
@endpush
