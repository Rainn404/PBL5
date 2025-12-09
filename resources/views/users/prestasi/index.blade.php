@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
                <div class="flex-1">
                    <h1 class="text-4xl sm:text-5xl font-bold mb-3">
                        Prestasi Mahasiswa
                    </h1>
                    <p class="text-blue-100 text-lg">
                        Daftar prestasi mahasiswa yang telah diverifikasi oleh HIMA-TI
                    </p>
                </div>
                @auth
                    <a href="{{ route('prestasi.create') }}" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-semibold whitespace-nowrap shadow-lg">
                        <i class="fas fa-plus"></i>
                        <span>Ajukan Prestasi</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form method="GET" action="{{ route('prestasi.index') }}" class="space-y-4">
            <!-- Search Bar -->
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari nama mahasiswa..." 
                    value="{{ request('search') }}"
                    class="w-full px-4 py-2.5 pl-10 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm"
                >
                <i class="fas fa-search absolute left-3 top-3 text-slate-400"></i>
            </div>

            <!-- Filters Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end">
                <!-- Tahun Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tahun</label>
                    <select name="tahun" class="w-full px-3 py-2 h-10 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kategori Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full px-3 py-2 h-10 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all">
                        <option value="">Semua Kategori</option>
                        <option value="Akademik" {{ request('kategori') === 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Non-Akademik" {{ request('kategori') === 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                        <option value="Olahraga" {{ request('kategori') === 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="Seni" {{ request('kategori') === 'Seni' ? 'selected' : '' }}>Seni & Budaya</option>
                        <option value="Lainnya" {{ request('kategori') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Apply Button -->
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan
                    </button>
                    <a href="{{ route('prestasi.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-colors font-medium text-sm">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if($prestasi->count() > 0)
            <!-- Prestasi Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                @foreach($prestasi as $item)
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 p-3">
                    <!-- Header dengan Badge -->
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm font-bold text-slate-900 flex-1">
                            {{ $item->nama_prestasi }}
                        </span>
                        @php
                            $categoryColors = [
                                'Akademik' => 'bg-blue-100 text-blue-700',
                                'Olahraga' => 'bg-green-100 text-green-700',
                                'Seni' => 'bg-purple-100 text-purple-700',
                                'Non-Akademik' => 'bg-orange-100 text-orange-700',
                                'Lainnya' => 'bg-slate-100 text-slate-700',
                            ];
                            $badgeClass = $categoryColors[$item->kategori] ?? 'bg-slate-100 text-slate-700';
                        @endphp
                        <span class="inline-block px-2 py-0.5 text-xs font-bold rounded ml-2 whitespace-nowrap {{ $badgeClass }}">
                            {{ $item->kategori }}
                        </span>
                    </div>

                    <!-- Mahasiswa Name -->
                    <p class="text-xs font-semibold text-slate-600 mb-1 truncate">
                        {{ $item->user->name ?? 'Tidak diketahui' }}
                    </p>

                    <!-- Date -->
                    <p class="text-xs text-slate-500 mb-2">
                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                    </p>

                    <!-- Description -->
                    <p class="text-xs text-slate-600 mb-3 line-clamp-2">
                        {{ $item->deskripsi ?? '-' }}
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <!-- Share Button -->
                        <button onclick="shareItem('{{ urlencode($item->nama_prestasi) }}', '{{ urlencode($item->user->name ?? 'Unknown') }}')" 
                            class="w-full flex items-center justify-center gap-1 px-2 py-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition-colors text-xs font-semibold">
                            <i class="fas fa-share-alt"></i>
                            Share
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                {{ $prestasi->links('pagination::tailwind') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                    <i class="fas fa-inbox text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Tidak ada prestasi ditemukan</h3>
                <p class="text-slate-600 mb-6 max-w-md mx-auto text-sm">
                    Coba ubah kriteria pencarian atau filter yang Anda gunakan untuk menemukan prestasi yang Anda cari.
                </p>
                @auth
                    <a href="{{ route('prestasi.create') }}" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        <i class="fas fa-plus"></i>
                        Ajukan Prestasi Baru
                    </a>
                @endauth
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Share Modal -->
<div id="shareModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-end sm:items-center justify-center">
    <div class="bg-white rounded-t-lg sm:rounded-lg shadow-lg p-4 w-full sm:max-w-sm">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-slate-900">Bagikan Prestasi</h4>
            <button onclick="closeShareModal()" class="text-slate-400 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-2">
            <button onclick="copyToClipboard()" class="w-full text-left px-4 py-2.5 hover:bg-slate-100 rounded-lg flex items-center gap-3 transition-colors">
                <i class="fas fa-copy text-blue-600"></i>
                <span class="text-sm font-semibold">Salin Link</span>
            </button>
            <a href="" id="shareWhatsapp" target="_blank" class="w-full text-left px-4 py-2.5 hover:bg-slate-100 rounded-lg flex items-center gap-3 transition-colors">
                <i class="fas fa-whatsapp text-green-600"></i>
                <span class="text-sm font-semibold">WhatsApp</span>
            </a>
            <a href="" id="shareTwitter" target="_blank" class="w-full text-left px-4 py-2.5 hover:bg-slate-100 rounded-lg flex items-center gap-3 transition-colors">
                <i class="fas fa-twitter text-blue-400"></i>
                <span class="text-sm font-semibold">Twitter</span>
            </a>
            <a href="" id="shareFacebook" target="_blank" class="w-full text-left px-4 py-2.5 hover:bg-slate-100 rounded-lg flex items-center gap-3 transition-colors">
                <i class="fas fa-facebook text-blue-700"></i>
                <span class="text-sm font-semibold">Facebook</span>
            </a>
        </div>
    </div>
</div>

<script>
    function shareItem(prestasi, mahasiswa) {
        const text = `Prestasi: ${decodeURIComponent(prestasi)} | Oleh: ${decodeURIComponent(mahasiswa)}`;
        const url = window.location.href;
        
        document.getElementById('shareWhatsapp').href = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
        document.getElementById('shareTwitter').href = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
        document.getElementById('shareFacebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        
        document.getElementById('shareModal').style.display = 'flex';
    }

    function closeShareModal() {
        document.getElementById('shareModal').style.display = 'none';
    }

    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link berhasil disalin!');
            closeShareModal();
        });
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('shareModal');
        if (modal.style.display === 'flex' && !event.target.closest('button[onclick*="shareItem"]') && !modal.contains(event.target)) {
            modal.style.display = 'none';
        }
    });
</script>
@endsection