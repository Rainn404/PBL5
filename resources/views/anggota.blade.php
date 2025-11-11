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
            <select class="filter-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="tidak-aktif">Tidak Aktif</option>
            </select>
            <select class="filter-select" id="semesterFilter">
                <option value="">Semua Semester</option>
                @for($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}">Semester {{ $i }}</option>
                @endfor
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

    <!-- Filter Active Tags -->
    <div class="active-filters" id="activeFilters">
        <!-- Filter tags akan muncul di sini -->
    </div>

    <!-- Cards View -->
    <div class="anggota-grid-container">
        <div class="anggota-grid" id="anggotaCards">
            @foreach($anggota as $item)
            <div class="anggota-card-wrapper" 
                 data-divisi="{{ $item->divisi->nama_divisi ?? '' }}"
                 data-status="{{ $item->status ? 'aktif' : 'tidak-aktif' }}"
                 data-semester="{{ $item->semester }}"
                 data-nama="{{ strtolower($item->nama) }}"
                 data-nim="{{ $item->nim }}"
                 data-jabatan="{{ strtolower($item->jabatan->nama_jabatan ?? '') }}">
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
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="empty-title">Tidak ada anggota yang ditemukan</h3>
        <p class="empty-description">Coba ubah filter pencarian Anda</p>
        <button class="btn-reset" id="resetFilters">
            <i class="fas fa-refresh btn-icon"></i>Reset Semua Filter
        </button>
    </div>

    <!-- Results Count -->
    <div class="results-count" id="resultsCount">
        Menampilkan <span id="visibleCount">0</span> dari <span id="totalCount">0</span> anggota
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
/* Main Container - Perbaikan margin */
.anggota-container {
    padding: 2rem 1.5rem;
    animation: fadeInUp 0.6s ease-out;
    max-width: 1400px;
    margin: 0 auto;
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
    background: linear-gradient(135deg, #5d87f1, #5d87f1);
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
    flex-wrap: wrap;
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
    border-color: #5d87f1;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-select {
    padding: 0.75rem 1rem;
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    background: #FFFFFF;
    font-size: 0.875rem;
    width: 180px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-select:focus {
    outline: none;
    border-color: #5d87f1;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Active Filters */
.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    min-height: 40px;
    align-items: center;
}

.filter-tag {
    background: linear-gradient(135deg, #5d87f1, #5d87f1);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    animation: fadeIn 0.3s ease;
}

.filter-tag-remove {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.6rem;
    transition: all 0.2s ease;
}

.filter-tag-remove:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

/* Results Count */
.results-count {
    text-align: center;
    color: #6B7280;
    font-size: 0.875rem;
    margin: 1rem 0;
    padding: 1rem;
    background: #F8FAFC;
    border-radius: 10px;
    border: 1px solid #E5E7EB;
}

.results-count span {
    font-weight: 600;
    color: #5d87f1;
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

/* Grid Container - Baru untuk memusatkan grid */
.anggota-grid-container {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

/* Grid Layout - Perbaikan untuk memusatkan */
.anggota-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    width: 100%;
    max-width: 1200px;
}

.anggota-card-wrapper {
    perspective: 1000px;
    animation: fadeInUp 0.5s ease-out;
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
    text-align: center; /* Memusatkan konten */
}

.anggota-card:hover {
    transform: translateY(-8px) rotateX(5deg);
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
    border-color: #5d87f1;
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
    display: flex;
    justify-content: center; /* Memusatkan avatar */
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
    border-color: #5d87f1;
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
    display: flex;
    justify-content: center; /* Memusatkan tag divisi */
}

.divisi-tag {
    background: linear-gradient(135deg, #5d87f1, #5d87f1);
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
    display: flex;
    justify-content: center; /* Memusatkan badge status */
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
    background: #F8FAFC;
    border-radius: 16px;
    border: 2px dashed #E5E7EB;
    margin: 2rem 0;
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

@keyframes bounceIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .anggota-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .filter-section {
        gap: 0.75rem;
    }
    
    .search-box {
        width: 220px;
    }
    
    .filter-select {
        width: 160px;
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
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
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
        padding: 1rem;
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
    
    .active-filters {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const divisiFilter = document.getElementById('divisiFilter');
    const statusFilter = document.getElementById('statusFilter');
    const semesterFilter = document.getElementById('semesterFilter');
    const anggotaCards = document.querySelectorAll('.anggota-card-wrapper');
    const emptyState = document.getElementById('emptyState');
    const resetFiltersBtn = document.getElementById('resetFilters');
    const activeFilters = document.getElementById('activeFilters');
    const resultsCount = document.getElementById('resultsCount');
    const visibleCount = document.getElementById('visibleCount');
    const totalCount = document.getElementById('totalCount');
    
    // Inisialisasi total count
    totalCount.textContent = anggotaCards.length;
    
    // State untuk filter aktif
    let activeFilterState = {
        search: '',
        divisi: '',
        status: '',
        semester: ''
    };

    function updateActiveFilters() {
        activeFilters.innerHTML = '';
        
        if (activeFilterState.search) {
            createFilterTag('Pencarian: ' + activeFilterState.search, 'search');
        }
        if (activeFilterState.divisi) {
            createFilterTag('Divisi: ' + activeFilterState.divisi, 'divisi');
        }
        if (activeFilterState.status) {
            const statusText = activeFilterState.status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
            createFilterTag('Status: ' + statusText, 'status');
        }
        if (activeFilterState.semester) {
            createFilterTag('Semester: ' + activeFilterState.semester, 'semester');
        }
        
        // Tampilkan container jika ada filter aktif
        if (Object.values(activeFilterState).some(val => val !== '')) {
            activeFilters.style.display = 'flex';
        } else {
            activeFilters.style.display = 'none';
        }
    }

    function createFilterTag(text, type) {
        const tag = document.createElement('div');
        tag.className = 'filter-tag';
        tag.innerHTML = `
            ${text}
            <button class="filter-tag-remove" data-type="${type}">
                <i class="fas fa-times"></i>
            </button>
        `;
        activeFilters.appendChild(tag);
        
        // Event listener untuk tombol hapus
        tag.querySelector('.filter-tag-remove').addEventListener('click', function() {
            removeFilter(type);
        });
    }

    function removeFilter(type) {
        switch(type) {
            case 'search':
                searchInput.value = '';
                activeFilterState.search = '';
                break;
            case 'divisi':
                divisiFilter.value = '';
                activeFilterState.divisi = '';
                break;
            case 'status':
                statusFilter.value = '';
                activeFilterState.status = '';
                break;
            case 'semester':
                semesterFilter.value = '';
                activeFilterState.semester = '';
                break;
        }
        filterCards();
        updateActiveFilters();
    }

    function filterCards() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const divisiValue = divisiFilter.value;
        const statusValue = statusFilter.value;
        const semesterValue = semesterFilter.value;
        
        // Update state
        activeFilterState.search = searchTerm;
        activeFilterState.divisi = divisiValue;
        activeFilterState.status = statusValue;
        activeFilterState.semester = semesterValue;
        
        let visibleCountValue = 0;

        anggotaCards.forEach(card => {
            const nama = card.getAttribute('data-nama');
            const nim = card.getAttribute('data-nim');
            const jabatan = card.getAttribute('data-jabatan');
            const divisi = card.getAttribute('data-divisi');
            const status = card.getAttribute('data-status');
            const semester = card.getAttribute('data-semester');

            const matchesSearch = !searchTerm || 
                                nama.includes(searchTerm) || 
                                nim.includes(searchTerm) || 
                                jabatan.includes(searchTerm);
            const matchesDivisi = !divisiValue || divisi === divisiValue;
            const matchesStatus = !statusValue || status === statusValue;
            const matchesSemester = !semesterValue || semester === semesterValue;

            if (matchesSearch && matchesDivisi && matchesStatus && matchesSemester) {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.5s ease-out';
                visibleCountValue++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update results count
        visibleCount.textContent = visibleCountValue;
        
        // Toggle empty state
        if (visibleCountValue === 0) {
            emptyState.classList.add('show');
            resultsCount.style.display = 'none';
        } else {
            emptyState.classList.remove('show');
            resultsCount.style.display = 'block';
        }
        
        // Update active filters display
        updateActiveFilters();
    }

    function resetFilters() {
        searchInput.value = '';
        divisiFilter.value = '';
        statusFilter.value = '';
        semesterFilter.value = '';
        
        activeFilterState = {
            search: '',
            divisi: '',
            status: '',
            semester: ''
        };
        
        filterCards();
        updateActiveFilters();
        
        // Add visual feedback
        resetFiltersBtn.style.transform = 'scale(0.95)';
        setTimeout(() => {
            resetFiltersBtn.style.transform = 'scale(1)';
        }, 150);
    }

    // Event listeners
    searchInput.addEventListener('input', function() {
        // Debounce untuk performa
        clearTimeout(this.debounce);
        this.debounce = setTimeout(() => {
            filterCards();
        }, 300);
    });
    
    divisiFilter.addEventListener('change', filterCards);
    statusFilter.addEventListener('change', filterCards);
    semesterFilter.addEventListener('change', filterCards);
    resetFiltersBtn.addEventListener('click', resetFilters);

    // Add hover effects
    anggotaCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) rotateX(5deg)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0)';
        });
    });

    // Initialize
    filterCards();
    updateActiveFilters();
});
</script>
@endpush