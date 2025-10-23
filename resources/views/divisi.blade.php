@extends('layouts.app')

@section('title', 'Divisi HIMA-TI')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold gradient-text">Divisi HIMA-TI</h1>
        <p class="lead text-light">
            Struktur organisasi dan deskripsi divisi-divisi dalam Himpunan Mahasiswa<br>
            Teknik Informatika
        </p>
    </div>

    <div class="divisi-grid">
        <!-- Divisi 1: Teknologi & Pengembangan -->
        <div class="divisi-card">
            <div class="divisi-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Teknologi & Pengembangan</h3>
                    <div class="divisi-icon">
                        <i class="fas fa-code"></i>
                    </div>
                </div>
            </div>
            <div class="divisi-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="status-badge status-active">
                        <i class="fas fa-users me-1"></i>
                        15 Anggota
                    </span>
                    <span class="status-badge status-diterima">
                        Aktif
                    </span>
                </div>
                
                <p class="divisi-desc mb-3">
                    Bertanggung jawab dalam pengembangan sistem, website, dan aplikasi HIMA-TI. 
                    Divisi ini fokus pada inovasi teknologi dan pemecahan masalah digital.
                </p>

                <div class="divisi-detail d-none">
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2 text-primary"></i>Ketua Divisi:</strong>
                        <span class="ms-2">Ahmad Rizki</span>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-tasks me-2 text-primary"></i>Program Kerja:</strong>
                        <ul class="mt-2 mb-0 ps-3">
                            <li>Pengembangan Website HIMA-TI</li>
                            <li>Workshop Programming</li>
                            <li>Tech Support untuk Kegiatan</li>
                        </ul>
                    </div>

                    <div class="anggota-list">
                        <strong><i class="fas fa-list me-2 text-primary"></i>Anggota Inti:</strong>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach(['Siti', 'Budi', 'Dewi', 'Rudi'] as $anggota)
                            <div class="anggota-avatar" title="{{ $anggota }}">
                                {{ substr($anggota, 0, 1) }}
                            </div>
                            @endforeach
                            <div class="anggota-avatar" title="+10 lainnya">+10</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divisi-footer">
                <button class="btn btn-outline btn-sm toggle-detail w-100">
                    <span class="show-text">Selengkapnya</span>
                    <span class="hide-text d-none">Sembunyikan</span>
                    <i class="fas fa-chevron-down ms-1"></i>
                </button>
            </div>
        </div>

        <!-- Divisi 2: Humas & Kemitraan -->
        <div class="divisi-card">
            <div class="divisi-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Humas & Kemitraan</h3>
                    <div class="divisi-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>
            </div>
            <div class="divisi-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="status-badge status-active">
                        <i class="fas fa-users me-1"></i>
                        12 Anggota
                    </span>
                    <span class="status-badge status-diterima">
                        Aktif
                    </span>
                </div>
                
                <p class="divisi-desc mb-3">
                    Menjaga hubungan baik dengan internal dan eksternal kampus. 
                    Bertugas membangun jaringan kemitraan dan publikasi kegiatan.
                </p>

                <div class="divisi-detail d-none">
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2 text-primary"></i>Ketua Divisi:</strong>
                        <span class="ms-2">Siti Nurhaliza</span>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-tasks me-2 text-primary"></i>Program Kerja:</strong>
                        <ul class="mt-2 mb-0 ps-3">
                            <li>Public Relations</li>
                            <li>Sponsorship & Partnership</li>
                            <li>Media Sosial Management</li>
                        </ul>
                    </div>

                    <div class="anggota-list">
                        <strong><i class="fas fa-list me-2 text-primary"></i>Anggota Inti:</strong>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach(['Rina', 'Fajar', 'Maya', 'Hendra'] as $anggota)
                            <div class="anggota-avatar" title="{{ $anggota }}">
                                {{ substr($anggota, 0, 1) }}
                            </div>
                            @endforeach
                            <div class="anggota-avatar" title="+8 lainnya">+8</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divisi-footer">
                <button class="btn btn-outline btn-sm toggle-detail w-100">
                    <span class="show-text">Selengkapnya</span>
                    <span class="hide-text d-none">Sembunyikan</span>
                    <i class="fas fa-chevron-down ms-1"></i>
                </button>
            </div>
        </div>

        <!-- Divisi 3: Akademik & Penelitian -->
        <div class="divisi-card">
            <div class="divisi-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Akademik & Penelitian</h3>
                    <div class="divisi-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
            <div class="divisi-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="status-badge status-active">
                        <i class="fas fa-users me-1"></i>
                        10 Anggota
                    </span>
                    <span class="status-badge status-diterima">
                        Aktif
                    </span>
                </div>
                
                <p class="divisi-desc mb-3">
                    Fokus pada pengembangan akademik mahasiswa, penelitian, 
                    dan peningkatan kualitas pembelajaran di jurusan Teknik Informatika.
                </p>

                <div class="divisi-detail d-none">
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2 text-primary"></i>Ketua Divisi:</strong>
                        <span class="ms-2">Budi Santoso</span>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-tasks me-2 text-primary"></i>Program Kerja:</strong>
                        <ul class="mt-2 mb-0 ps-3">
                            <li>Study Group & Tutoring</li>
                            <li>Seminar & Workshop Akademik</li>
                            <li>Research Development</li>
                        </ul>
                    </div>

                    <div class="anggota-list">
                        <strong><i class="fas fa-list me-2 text-primary"></i>Anggota Inti:</strong>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach(['Dina', 'Rizky', 'Lina'] as $anggota)
                            <div class="anggota-avatar" title="{{ $anggota }}">
                                {{ substr($anggota, 0, 1) }}
                            </div>
                            @endforeach
                            <div class="anggota-avatar" title="+7 lainnya">+7</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divisi-footer">
                <button class="btn btn-outline btn-sm toggle-detail w-100">
                    <span class="show-text">Selengkapnya</span>
                    <span class="hide-text d-none">Sembunyikan</span>
                    <i class="fas fa-chevron-down ms-1"></i>
                </button>
            </div>
        </div>

        <!-- Divisi 4: Minat & Bakat -->
        <div class="divisi-card">
            <div class="divisi-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Minat & Bakat</h3>
                    <div class="divisi-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
            <div class="divisi-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="status-badge status-active">
                        <i class="fas fa-users me-1"></i>
                        8 Anggota
                    </span>
                    <span class="status-badge status-diterima">
                        Aktif
                    </span>
                </div>
                
                <p class="divisi-desc mb-3">
                    Mengembangkan bakat non-akademik mahasiswa melalui berbagai 
                    kegiatan olahraga, seni, dan pengembangan soft skills.
                </p>

                <div class="divisi-detail d-none">
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2 text-primary"></i>Ketua Divisi:</strong>
                        <span class="ms-2">Dewi Anggraini</span>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-tasks me-2 text-primary"></i>Program Kerja:</strong>
                        <ul class="mt-2 mb-0 ps-3">
                            <li>Olahraga & E-sports</li>
                            <li>Seni & Kreativitas</li>
                            <li>Leadership Training</li>
                        </ul>
                    </div>

                    <div class="anggota-list">
                        <strong><i class="fas fa-list me-2 text-primary"></i>Anggota Inti:</strong>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach(['Andi', 'Sari', 'Rama'] as $anggota)
                            <div class="anggota-avatar" title="{{ $anggota }}">
                                {{ substr($anggota, 0, 1) }}
                            </div>
                            @endforeach
                            <div class="anggota-avatar" title="+5 lainnya">+5</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divisi-footer">
                <button class="btn btn-outline btn-sm toggle-detail w-100">
                    <span class="show-text">Selengkapnya</span>
                    <span class="hide-text d-none">Sembunyikan</span>
                    <i class="fas fa-chevron-down ms-1"></i>
                </button>
            </div>
        </div>

        <!-- Divisi 5: Kewirausahaan -->
        <div class="divisi-card">
            <div class="divisi-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Kewirausahaan</h3>
                    <div class="divisi-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="divisi-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="status-badge status-active">
                        <i class="fas fa-users me-1"></i>
                        9 Anggota
                    </span>
                    <span class="status-badge status-diterima">
                        Aktif
                    </span>
                </div>
                
                <p class="divisi-desc mb-3">
                    Mengembangkan jiwa kewirausahaan mahasiswa melalui berbagai 
                    program bisnis, startup, dan pengembangan UKM.
                </p>

                <div class="divisi-detail d-none">
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2 text-primary"></i>Ketua Divisi:</strong>
                        <span class="ms-2">Rizky Pratama</span>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-tasks me-2 text-primary"></i>Program Kerja:</strong>
                        <ul class="mt-2 mb-0 ps-3">
                            <li>Startup Development</li>
                            <li>Business Plan Competition</li>
                            <li>Entrepreneurship Workshop</li>
                        </ul>
                    </div>

                    <div class="anggota-list">
                        <strong><i class="fas fa-list me-2 text-primary"></i>Anggota Inti:</strong>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach(['Feri', 'Nina', 'Doni', 'Salsa'] as $anggota)
                            <div class="anggota-avatar" title="{{ $anggota }}">
                                {{ substr($anggota, 0, 1) }}
                            </div>
                            @endforeach
                            <div class="anggota-avatar" title="+5 lainnya">+5</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divisi-footer">
                <button class="btn btn-outline btn-sm toggle-detail w-100">
                    <span class="show-text">Selengkapnya</span>
                    <span class="hide-text d-none">Sembunyikan</span>
                    <i class="fas fa-chevron-down ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

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