@extends('layouts.app')

@section('title', 'Divisi HIMA-TI')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold gradient-text">Divisi HIMA-TI</h1>
        <p class="lead text-muted">
            Struktur organisasi dan deskripsi divisi-divisi dalam Himpunan Mahasiswa<br>
            Teknik Informatika
        </p>
    </div>

    <div class="row g-4">
        @foreach($divisis as $divisi)
        <div class="col-lg-6 col-xl-4">
            <div class="card divisi-card h-100 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0 fw-bold">{{ $divisi->nama_divisi }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-users me-1"></i>
                            {{ $divisi->anggotas_count }} Anggota
                        </span>
                        <span class="badge bg-success">
                            {{ $divisi->status ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    
                    <p class="card-text divisi-desc">
                        {{ Str::limit($divisi->deskripsi, 120) }}
                    </p>

                    <div class="divisi-detail d-none">
                        <div class="mb-3">
                            <strong><i class="fas fa-user me-2"></i>Ketua Divisi:</strong>
                            <span class="ms-2">{{ $divisi->ketua_divisi ?? 'Belum ditentukan' }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <strong><i class="fas fa-info-circle me-2"></i>Deskripsi Lengkap:</strong>
                            <p class="mt-2 mb-0">{{ $divisi->deskripsi }}</p>
                        </div>

                        @if($divisi->anggotas_count > 0)
                        <div class="anggota-list">
                            <strong><i class="fas fa-list me-2"></i>Daftar Anggota:</strong>
                            <div class="mt-2">
                                @foreach($divisi->anggotas->take(5) as $anggota)
                                <span class="badge bg-light text-dark me-1 mb-1">
                                    {{ $anggota->nama }}
                                </span>
                                @endforeach
                                @if($divisi->anggotas_count > 5)
                                <span class="badge bg-secondary">
                                    +{{ $divisi->anggotas_count - 5 }} lainnya
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <button class="btn btn-outline-primary btn-sm toggle-detail" 
                            data-divisi="{{ $divisi->id_divisi }}">
                        <span class="show-text">Selengkapnya</span>
                        <span class="hide-text d-none">Sembunyikan</span>
                        <i class="fas fa-chevron-down ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.divisi-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 15px;
}

.divisi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.divisi-desc {
    color: #6c757d;
    line-height: 1.6;
}

.toggle-detail {
    transition: all 0.3s ease;
    border-radius: 20px;
}

.toggle-detail:hover {
    transform: scale(1.05);
}

.anggota-list .badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-detail');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.divisi-card');
            const detailSection = card.querySelector('.divisi-detail');
            const descSection = card.querySelector('.divisi-desc');
            const showText = card.querySelector('.show-text');
            const hideText = card.querySelector('.hide-text');
            const icon = this.querySelector('i');
            
            // Toggle visibility
            detailSection.classList.toggle('d-none');
            descSection.classList.toggle('d-none');
            showText.classList.toggle('d-none');
            hideText.classList.toggle('d-none');
            
            // Rotate icon
            if (icon.classList.contains('fa-chevron-down')) {
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
            
            // Smooth scroll to card if detail is opened
            if (!detailSection.classList.contains('d-none')) {
                card.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'nearest' 
                });
            }
        });
    });
});
</script>
@endpush