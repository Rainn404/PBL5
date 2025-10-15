@extends('layouts.app')

@section('title', 'Prestasi Mahasiswa - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Prestasi Mahasiswa</h1>
            <p>Kumpulan prestasi membanggakan yang telah diraih oleh mahasiswa Teknik Informatika</p>
            
            @auth
                @if(auth()->user()->role === 'anggota')
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <span>Anda dapat mengajukan prestasi yang telah Anda raih melalui sistem ini.</span>
                    </div>
                @endif
            @endauth
        </div>
    </section>

    <!-- Prestasi Stats -->
    <section class="prestasi-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalPrestasi }}</h3>
                        <p>Total Prestasi</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $prestasiValid }}</h3>
                        <p>Disetujui</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $prestasiPending }}</h3>
                        <p>Menunggu Validasi</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $mahasiswaBerprestasi }}</h3>
                        <p>Mahasiswa Berprestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Action Buttons untuk Admin -->
    @auth
        @if(auth()->user()->role === 'admin')
        <section class="admin-actions">
            <div class="container">
                <div class="action-buttons">
                    <a href="{{ route('prestasi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Prestasi
                    </a>
                    <a href="{{ route('prestasi.validasi') }}" class="btn btn-secondary">
                        <i class="fas fa-check-circle"></i>
                        Validasi Prestasi
                        @if($prestasiPending > 0)
                            <span class="badge">{{ $prestasiPending }}</span>
                        @endif
                    </a>
                    <a href="{{ route('prestasi.export') }}" class="btn btn-outline">
                        <i class="fas fa-download"></i>
                        Export Data
                    </a>
                </div>
            </div>
        </section>
        @endif
    @endauth

    <!-- Prestasi Filter -->
    <section class="prestasi-filter">
        <div class="container">
            <div class="filter-options">
                <div class="filter-group">
                    <label for="tahun-filter">Tahun:</label>
                    <select id="tahun-filter">
                        <option value="all">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label for="kategori-filter">Kategori:</label>
                    <select id="kategori-filter">
                        <option value="all">Semua Kategori</option>
                        <option value="akademik">Akademik</option>
                        <option value="non-akademik">Non-Akademik</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="status-filter">Status:</label>
                    <select id="status-filter">
                        <option value="all">Semua Status</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="pending">Menunggu Validasi</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="search-group">
                    <input type="text" id="search-prestasi" placeholder="Cari prestasi atau nama mahasiswa...">
                    <button type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi List -->
    <section class="prestasi-list">
        <div class="container">
            @if($prestasi->count() > 0)
                <div class="prestasi-grid">
                    @foreach($prestasi as $item)
                    <div class="prestasi-card" 
                         data-tahun="{{ date('Y', strtotime($item->tanggal_mulai)) }}"
                         data-kategori="{{ $item->kategori }}"
                         data-status="{{ $item->status_validasi }}">
                        <div class="prestasi-header">
                            <div class="prestasi-badge {{ $item->status_validasi === 'disetujui' ? 'valid' : ($item->status_validasi === 'pending' ? 'pending' : 'rejected') }}">
                                @if($item->status_validasi === 'disetujui')
                                    <i class="fas fa-check-circle"></i>
                                    <span>Disetujui</span>
                                @elseif($item->status_validasi === 'pending')
                                    <i class="fas fa-clock"></i>
                                    <span>Menunggu Validasi</span>
                                @else
                                    <i class="fas fa-times-circle"></i>
                                    <span>Ditolak</span>
                                @endif
                            </div>
                            <div class="prestasi-kategori {{ $item->kategori }}">
                                {{ ucfirst($item->kategori) }}
                            </div>
                        </div>
                        
                        <div class="prestasi-content">
                            <h3>{{ $item->capaian }}</h3>
                            <p class="prestasi-nama">{{ $item->nama }}</p>
                            
                            <div class="prestasi-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>{{ $item->nim }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ date('M Y', strtotime($item->tanggal_mulai)) }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Semester {{ $item->semester }}</span>
                                </div>
                            </div>

                            <div class="prestasi-details">
                                <div class="detail-item">
                                    <strong>Periode:</strong>
                                    <span>{{ date('d M Y', strtotime($item->tanggal_mulai)) }} - {{ date('d M Y', strtotime($item->tanggal_selesai)) }}</span>
                                </div>
                                <div class="detail-item">
                                    <strong>Kontak:</strong>
                                    <span>{{ $item->email }} | {{ $item->no_hp }}</span>
                                </div>
                                @if($item->bukti)
                                <div class="detail-item">
                                    <strong>Bukti:</strong>
                                    <a href="{{ asset('storage/'.$item->bukti) }}" target="_blank" class="doc-link">
                                        <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                    </a>
                                </div>
                                @endif
                            </div>

                            <!-- Action Buttons berdasarkan role -->
                            <div class="prestasi-actions">
                                @auth
                                    @if(auth()->user()->role === 'anggota' && auth()->user()->id_user == $item->id_user)
                                        <a href="{{ route('prestasi.edit', $item->id_prestasi) }}" class="btn-edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn-delete" onclick="deletePrestasi({{ $item->id_prestasi }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    @endif
                                    
                                    @if(auth()->user()->role === 'admin')
                                        @if($item->status_validasi === 'pending')
                                            <button class="btn-validate" onclick="validatePrestasi({{ $item->id_prestasi }})">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                            <button class="btn-reject" onclick="rejectPrestasi({{ $item->id_prestasi }})">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        @endif
                                        <a href="{{ route('prestasi.edit', $item->id_prestasi) }}" class="btn-edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn-delete" onclick="deletePrestasi({{ $item->id_prestasi }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    @endif
                                @endauth
                                
                                <button class="btn-detail" onclick="showDetail({{ $item->id_prestasi }})">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $prestasi->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-trophy"></i>
                    <h3>Belum Ada Prestasi</h3>
                    <p>Belum ada prestasi yang tercatat dalam sistem.</p>
                    @auth
                        @if(auth()->user()->role === 'anggota')
                            <a href="{{ route('prestasi.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Ajukan Prestasi Pertama Anda
                            </a>
                        @endif
                    @else
                        <p>Login untuk mengajukan prestasi</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <!-- Modal Detail Prestasi -->
    <div id="prestasiModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body">
                <!-- Content akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>

    <!-- Ajukan Prestasi Section untuk Anggota -->
    @auth
        @if(auth()->user()->role === 'anggota')
        <section class="ajukan-prestasi">
            <div class="container">
                <div class="ajukan-content">
                    <div class="ajukan-text">
                        <h2>Punya Prestasi?</h2>
                        <p>Bagikan prestasi Anda kepada kami untuk menginspirasi mahasiswa lainnya</p>
                        <a href="{{ route('prestasi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Ajukan Prestasi
                        </a>
                    </div>
                    <div class="ajukan-image">
                        <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Ajukan Prestasi">
                    </div>
                </div>
            </div>
        </section>
        @endif
    @else
    <section class="ajukan-prestasi">
        <div class="container">
            <div class="ajukan-content">
                <div class="ajukan-text">
                    <h2>Ingin Mengajukan Prestasi?</h2>
                    <p>Login terlebih dahulu untuk dapat mengajukan prestasi yang telah Anda raih</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login Sekarang</a>
                </div>
                <div class="ajukan-image">
                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Login untuk Ajukan Prestasi">
                </div>
            </div>
        </div>
    </section>
    @endauth
@endsection

@push('scripts')
<script>
// Filter functionality
function filterPrestasi() {
    const tahunValue = document.getElementById('tahun-filter').value;
    const kategoriValue = document.getElementById('kategori-filter').value;
    const statusValue = document.getElementById('status-filter').value;
    const searchValue = document.getElementById('search-prestasi').value.toLowerCase();

    const cards = document.querySelectorAll('.prestasi-card');
    
    cards.forEach(card => {
        const tahun = card.getAttribute('data-tahun');
        const kategori = card.getAttribute('data-kategori');
        const status = card.getAttribute('data-status');
        const text = card.textContent.toLowerCase();

        const tahunMatch = tahunValue === 'all' || tahun === tahunValue;
        const kategoriMatch = kategoriValue === 'all' || kategori === kategoriValue;
        const statusMatch = statusValue === 'all' || status === statusValue;
        const searchMatch = text.includes(searchValue);

        if (tahunMatch && kategoriMatch && statusMatch && searchMatch) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Modal functionality
const modal = document.getElementById('prestasiModal');
const span = document.getElementsByClassName('close')[0];

function showDetail(prestasiId) {
    // AJAX request untuk mendapatkan detail prestasi
    fetch(`/prestasi/${prestasiId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modal-body').innerHTML = `
                <h2>${data.prestasi.capaian}</h2>
                <div class="modal-meta">
                    <p><strong>Nama:</strong> ${data.prestasi.nama}</p>
                    <p><strong>NIM:</strong> ${data.prestasi.nim}</p>
                    <p><strong>Periode:</strong> ${new Date(data.prestasi.tanggal_mulai).toLocaleDateString('id-ID')} - ${new Date(data.prestasi.tanggal_selesai).toLocaleDateString('id-ID')}</p>
                    <p><strong>Semester:</strong> ${data.prestasi.semester}</p>
                    <p><strong>Kategori:</strong> ${data.prestasi.kategori}</p>
                    <p><strong>Kontak:</strong> ${data.prestasi.email} | ${data.prestasi.no_hp}</p>
                </div>
                ${data.prestasi.bukti ? `
                <div class="modal-document">
                    <h3>Bukti Prestasi</h3>
                    <a href="/storage/${data.prestasi.bukti}" target="_blank" class="btn btn-outline">
                        <i class="fas fa-download"></i> Download Bukti
                    </a>
                </div>
                ` : ''}
            `;
            modal.style.display = 'block';
        });
}

span.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Action functions
function deletePrestasi(id) {
    if (confirm('Apakah Anda yakin ingin menghapus prestasi ini?')) {
        fetch(`/prestasi/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

function validatePrestasi(id) {
    if (confirm('Setujui prestasi ini?')) {
        fetch(`/prestasi/${id}/validate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

function rejectPrestasi(id) {
    if (confirm('Tolak prestasi ini?')) {
        fetch(`/prestasi/${id}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Filter events
    const filterElements = [
        'tahun-filter', 'kategori-filter', 'status-filter', 'search-prestasi'
    ];
    
    filterElements.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', filterPrestasi);
            element.addEventListener('input', filterPrestasi);
        }
    });
});
</script>
@endpush