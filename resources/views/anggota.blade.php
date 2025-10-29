@extends('layouts.app')

@section('title', 'Anggota HIMA - HIMA Sistem Manajemen')

@section('content')
<div class="anggota-container">
    <div class="anggota-header">
        <div class="header-content">
            <h1 class="anggota-title">Anggota HIMA</h1>
            <p class="anggota-subtitle">Daftar anggota aktif Himpunan Mahasiswa</p>
        </div>
        <!-- Search and Filter -->
        <div class="filter-section">
            <div class="search-box">
                <span class="search-icon">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="search-input" placeholder="Cari anggota..." id="searchInput">
            </div>
            <select class="filter-select" id="divisiFilter">
                <option value="">Semua Divisi</option>
                @foreach($divisiList as $divisi)
                <option value="{{ $divisi }}">{{ $divisi }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
    <div class="alert-notification success">
        <i class="fas fa-check-circle alert-icon"></i>
        <span class="alert-message">{{ session('success') }}</span>
        <button type="button" class="alert-close" data-bs-dismiss="alert">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Cards View -->
    <div class="anggota-grid" id="anggotaCards">
        @foreach($anggota as $item)
        <div class="anggota-card-wrapper" data-divisi="{{ $item->divisi->nama_divisi ?? '' }}">
            <div class="anggota-card">
                <!-- Status Indicator -->
                <div class="card-status {{ $item->status ? 'status-active' : 'status-inactive' }}"></div>
                
                <!-- Foto Profil -->
                <div class="card-avatar">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             alt="{{ $item->nama }}" 
                             class="avatar-image"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=3B82F6&color=fff&size=100'">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=3B82F6&color=fff&size=100" 
                             alt="{{ $item->nama }}" 
                             class="avatar-image">
                    @endif
                </div>
                
                <!-- Card Content -->
                <div class="card-content">
                    <!-- Nama dan NIM -->
                    <h3 class="member-name">{{ $item->nama }}</h3>
                    <p class="member-nim">NIM: {{ $item->nim }}</p>
                    
                    <!-- Divisi -->
                    <div class="member-divisi">
                        <span class="divisi-tag">
                            <i class="fas fa-users tag-icon"></i>
                            {{ $item->divisi->nama_divisi ?? 'Tidak ada divisi' }}
                        </span>
                    </div>
                    
                    <!-- Jabatan -->
                    <p class="member-jabatan">
                        <i class="fas fa-briefcase jabatan-icon"></i>
                        {{ $item->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                    </p>
                    
                    <!-- Semester -->
                    <p class="member-semester">
                        <i class="fas fa-graduation-cap semester-icon"></i>
                        Semester {{ $item->semester }}
                    </p>
                </div>
                
                <!-- Status Badge -->
                <div class="card-footer">
                    <span class="status-badge {{ $item->status ? 'badge-active' : 'badge-inactive' }}">
                        <i class="fas fa-circle status-dot"></i>
                        {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="empty-title">Tidak ada anggota yang ditemukan</h3>
        <p class="empty-description">Coba ubah filter pencarian Anda</p>
        <button class="btn-reset" id="resetFilters">
            <i class="fas fa-refresh btn-icon"></i>Reset Filter
        </button>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        <nav class="pagination-nav">
            <ul class="pagination-list">
                <li class="pagination-item disabled">
                    <a class="pagination-link prev" href="#">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <li class="pagination-item active">
                    <a class="pagination-link" href="#">1</a>
                </li>
                <li class="pagination-item">
                    <a class="pagination-link" href="#">2</a>
                </li>
                <li class="pagination-item">
                    <a class="pagination-link" href="#">3</a>
                </li>
                <li class="pagination-item">
                    <a class="pagination-link next" href="#">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>
/* Main Container */
.anggota-container {
    padding: 2rem 0;
    animation: fadeInUp 0.6s ease-out;
}

.anggota-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 2rem;
}

.header-content {
    flex: 1;
}

.anggota-title {
    font-size: 1.875rem;
    font-weight: 700;
    background: linear-gradient(135deg, #ea3bf6, #d51dd8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.anggota-subtitle {
    color: #6B7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Filter Section */
.filter-section {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-box {
    position: relative;
    width: 250px;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6B7280;
    z-index: 2;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    background: #FFFFFF;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #f33bf6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-select {
    padding: 0.75rem 1rem;
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    background: #FFFFFF;
    font-size: 0.875rem;
    width: 200px;
    transition: all 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: #ea3bf6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Alert Notification */
.alert-notification {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    animation: slideInDown 0.3s ease-out;
}

.alert-notification.success {
    background: linear-gradient(135deg, #D1FAE5, #ECFDF5);
    border: 1px solid #10B981;
    color: #065F46;
}

.alert-icon {
    margin-right: 0.75rem;
}

.alert-message {
    flex: 1;
    font-weight: 500;
}

.alert-close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: background-color 0.2s ease;
}

.alert-close:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

/* Grid Layout */
.anggota-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.anggota-card-wrapper {
    perspective: 1000px;
}

.anggota-card {
    background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);
    border: 1px solid #E5E7EB;
    border-radius: 16px;
    padding: 1.5rem;
    position: relative;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.anggota-card:hover {
    transform: translateY(-8px) rotateX(5deg);
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
    border-color: #f63bda;
}

/* Card Status */
.card-status {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #FFFFFF;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.status-active {
    background: linear-gradient(135deg, #10B981, #059669);
}

.status-inactive {
    background: linear-gradient(135deg, #6B7280, #4B5563);
}

/* Avatar */
.card-avatar {
    text-align: center;
    margin-bottom: 1rem;
}

.avatar-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #E5E7EB;
    transition: all 0.3s ease;
}

.anggota-card:hover .avatar-image {
    border-color: #f33bf6;
    transform: scale(1.05);
}

/* Card Content */
.card-content {
    text-align: center;
    flex: 1;
    margin-bottom: 1rem;
}

.member-name {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 0.25rem;
    line-height: 1.4;
}

.member-nim {
    font-size: 0.75rem;
    color: #6B7280;
    font-weight: 500;
    margin-bottom: 1rem;
}

.member-divisi {
    margin-bottom: 0.75rem;
}

.divisi-tag {
    background: linear-gradient(135deg, #f63bc7, #d81dc2);
    color: #FFFFFF;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.tag-icon {
    font-size: 0.625rem;
}

.member-jabatan {
    font-size: 0.875rem;
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.jabatan-icon {
    color: #F59E0B;
}

.member-semester {
    font-size: 0.75rem;
    color: #9CA3AF;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin: 0;
}

.semester-icon {
    font-size: 0.625rem;
}

/* Card Footer */
.card-footer {
    text-align: center;
    margin-top: auto;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.badge-active {
    background: linear-gradient(135deg, #10B981, #059669);
    color: #FFFFFF;
}

.badge-inactive {
    background: linear-gradient(135deg, #6B7280, #4B5563);
    color: #FFFFFF;
}

.status-dot {
    font-size: 0.5rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    display: none;
}

.empty-state.show {
    display: block;
    animation: fadeIn 0.5s ease-out;
}

.empty-icon {
    font-size: 4rem;
    color: #D1D5DB;
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-title {
    color: #6B7280;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.empty-description {
    color: #9CA3AF;
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
}

.btn-reset {
    background: #3B82F6;
    color: #FFFFFF;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-reset:hover {
    background: #2563EB;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-icon {
    font-size: 0.75rem;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination-nav {
    display: inline-block;
}

.pagination-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 0.5rem;
    align-items: center;
}

.pagination-item {
    margin: 0;
}

.pagination-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1rem;
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    color: #6B7280;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    min-width: 44px;
    transition: all 0.3s ease;
}

.pagination-link:hover {
    background: #3B82F6;
    color: #FFFFFF;
    border-color: #3B82F6;
    transform: translateY(-2px);
}

.pagination-item.active .pagination-link {
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    color: #FFFFFF;
    border-color: #3B82F6;
}

.pagination-item.disabled .pagination-link {
    background: #F3F4F6;
    color: #9CA3AF;
    border-color: #E5E7EB;
    cursor: not-allowed;
    transform: none;
}

.pagination-link.prev,
.pagination-link.next {
    padding: 0.75rem;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .anggota-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .anggota-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .filter-section {
        flex-direction: column;
        gap: 1rem;
    }
    
    .search-box,
    .filter-select {
        width: 100%;
    }
    
    .anggota-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .anggota-card {
        padding: 1.25rem;
    }
    
    .avatar-image {
        width: 80px;
        height: 80px;
    }
}

@media (max-width: 480px) {
    .anggota-container {
        padding: 1rem 0;
    }
    
    .anggota-title {
        font-size: 1.5rem;
    }
    
    .pagination-list {
        gap: 0.25rem;
    }
    
    .pagination-link {
        padding: 0.5rem 0.75rem;
        min-width: 40px;
        font-size: 0.75rem;
    }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const divisiFilter = document.getElementById('divisiFilter');
    const anggotaCards = document.querySelectorAll('.anggota-card-wrapper');
    const emptyState = document.getElementById('emptyState');
    const resetFiltersBtn = document.getElementById('resetFilters');

    function filterCards() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const divisiValue = divisiFilter.value;
        let visibleCount = 0;

        anggotaCards.forEach(card => {
            const nama = card.querySelector('.member-name').textContent.toLowerCase();
            const nim = card.querySelector('.member-nim').textContent.toLowerCase();
            const jabatan = card.querySelector('.member-jabatan').textContent.toLowerCase();
            const divisi = card.getAttribute('data-divisi');

            const matchesSearch = nama.includes(searchTerm) || 
                                nim.includes(searchTerm) || 
                                jabatan.includes(searchTerm);
            const matchesDivisi = !divisiValue || divisi === divisiValue;

            if (matchesSearch && matchesDivisi) {
                card.style.display = 'block';
                visibleCount++;
                
                // Staggered animation
                card.style.animationDelay = `${visibleCount * 0.1}s`;
            } else {
                card.style.display = 'none';
            }
        });

        // Toggle empty state
        if (visibleCount === 0) {
            emptyState.classList.add('show');
        } else {
            emptyState.classList.remove('show');
        }
    }

    function resetFilters() {
        searchInput.value = '';
        divisiFilter.value = '';
        filterCards();
        
        // Add visual feedback
        resetFiltersBtn.style.transform = 'scale(0.95)';
        setTimeout(() => {
            resetFiltersBtn.style.transform = 'scale(1)';
        }, 150);
    }

    // Event listeners
    searchInput.addEventListener('input', filterCards);
    divisiFilter.addEventListener('change', filterCards);
    resetFiltersBtn.addEventListener('click', resetFilters);

    // Initialize
    filterCards();

    // Add hover effects
    anggotaCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) rotateX(5deg)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0)';
        });
    });
});
</script>
@endpush