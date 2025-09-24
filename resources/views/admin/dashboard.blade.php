<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard HIMA - Sistem Manajemen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">
        <div class="flex items-center justify-center h-16 bg-blue-600">
            <h1 class="text-white text-xl font-bold">HIMA Dashboard</h1>
        </div>
        
        <nav class="mt-5 px-2">
            <div class="space-y-1">
                <a href="#" onclick="showContent('dashboard')" class="menu-item active group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-home mr-4"></i>
                    Dashboard
                </a>
                
                <a href="#" onclick="showContent('anggota')" class="menu-item group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-users mr-4"></i>
                    Kelola Anggota
                </a>
                
                <a href="#" onclick="showContent('divisi')" class="menu-item group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-building mr-4"></i>
                    Kelola Divisi
                </a>
                
                <a href="#" onclick="showContent('prestasi')" class="menu-item group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-trophy mr-4"></i>
                    Kelola Prestasi
                </a>
                
                <a href="#" onclick="showContent('mahasiswa-bermasalah')" class="menu-item group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-exclamation-triangle mr-4"></i>
                    Kelola Mahasiswa Bermasalah
                </a>
                
                <a href="#" onclick="showContent('berita')" class="menu-item group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-newspaper mr-4"></i>
                    Kelola Berita
                </a>
                
                <a href="#" onclick="showContent('pendaftaran')" class="menu-item group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-user-check mr-4"></i>
                    Kelola Pendaftaran
                </a>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-200">
                <a href="#" class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <i class="fas fa-cog mr-4"></i>
                    Pengaturan
                </a>
                
                <a href="#" class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-red-600 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt mr-4"></i>
                    Logout
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 flex flex-col flex-1 min-h-screen">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <button id="sidebar-toggle" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Cari..." class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <button class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -mt-1 ml-2 px-1 py-0 text-xs bg-red-500 text-white rounded-full">3</span>
                        </button>
                        
                        <div class="flex items-center space-x-3">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=3B82F6&color=fff" alt="Admin">
                            <span class="text-sm font-medium text-gray-700">Admin</span>
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 lg:p-6">
            <!-- Dashboard Content -->
            <div id="dashboard-content" class="content-section">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Selamat datang di Sistem Manajemen HIMA</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                    <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-users text-2xl text-blue-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Anggota</dt>
                                        <dd class="text-lg font-medium text-gray-900">248</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <span class="text-green-600 font-medium">+12%</span>
                                <span class="text-gray-500"> dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-building text-2xl text-green-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Divisi</dt>
                                        <dd class="text-lg font-medium text-gray-900">8</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <span class="text-green-600 font-medium">+1</span>
                                <span class="text-gray-500"> divisi baru</span>
                            </div>
                        </div>
                    </div>

                    <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-trophy text-2xl text-yellow-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Prestasi Bulan Ini</dt>
                                        <dd class="text-lg font-medium text-gray-900">12</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <span class="text-green-600 font-medium">+25%</span>
                                <span class="text-gray-500"> dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-newspaper text-2xl text-purple-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Berita Aktif</dt>
                                        <dd class="text-lg font-medium text-gray-900">5</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <span class="text-blue-600 font-medium">2</span>
                                <span class="text-gray-500"> berita terbaru</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Aktivitas Terbaru</h3>
                        <div class="flow-root">
                            <ul class="-mb-8">
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                        <div class="relative flex space-x-3">
                                            <div class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-trophy text-white text-xs"></i>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Prestasi baru ditambahkan oleh <span class="font-medium text-gray-900">Ahmad Rizki</span></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    2 jam lalu
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                        <div class="relative flex space-x-3">
                                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-user text-white text-xs"></i>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Anggota baru bergabung: <span class="font-medium text-gray-900">Siti Nurhaliza</span></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    4 jam lalu
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                        <div class="relative flex space-x-3">
                                            <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-newspaper text-white text-xs"></i>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Berita dipublikasikan oleh <span class="font-medium text-gray-900">Admin</span></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    6 jam lalu
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative">
                                        <div class="relative flex space-x-3">
                                            <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-building text-white text-xs"></i>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Divisi IT diperbarui oleh <span class="font-medium text-gray-900">Budi Santoso</span></p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    1 hari lalu
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anggota Content -->
            <div id="anggota-content" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Anggota</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola data anggota HIMA</p>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Anggota
                    </button>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-200">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Anggota
                            </button>
                            <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Anggota
                            </button>
                            <button class="bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-red-200">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Anggota
                            </button>
                        </div>

                        <!-- Sample Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Divisi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Ahmad Rizki</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">123456789</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ketua</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Siti Nurhaliza</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">987654321</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Humas</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Anggota</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divisi Content -->
            <div id="divisi-content" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Divisi</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola divisi-divisi dalam organisasi HIMA</p>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Divisi
                    </button>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-200">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Divisi
                            </button>
                            <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Divisi
                            </button>
                            <button class="bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-red-200">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Divisi
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="divisi-card bg-gray-50 rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Divisi IT</h3>
                                    <i class="fas fa-laptop-code text-2xl text-blue-500"></i>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Mengelola teknologi informasi dan sistem</p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-gray-500">Ketua: Ahmad Rizki</p>
                                        <p class="text-xs text-gray-500">Anggota: 15 orang</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="divisi-card bg-gray-50 rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Divisi Humas</h3>
                                    <i class="fas fa-bullhorn text-2xl text-green-500"></i>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Hubungan masyarakat dan komunikasi</p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-gray-500">Ketua: Lisa Putri</p>
                                        <p class="text-xs text-gray-500">Anggota: 12 orang</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="divisi-card bg-gray-50 rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Divisi Akademik</h3>
                                    <i class="fas fa-graduation-cap text-2xl text-yellow-500"></i>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Bidang akademik dan pembelajaran</p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-gray-500">Ketua: Andi Pratama</p>
                                        <p class="text-xs text-gray-500">Anggota: 18 orang</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prestasi Content -->
            <div id="prestasi-content" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Prestasi</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola prestasi mahasiswa dan organisasi</p>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Ajukan Prestasi
                    </button>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-200">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Prestasi
                            </button>
                            <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-200">
                                <i class="fas fa-check-circle mr-2"></i>
                                Validasi Prestasi
                            </button>
                            <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Prestasi
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900">Juara 1 Lomba Programming</h4>
                                        <p class="text-sm text-gray-600">Kompetisi Nasional IT - Universitas Indonesia</p>
                                        <div class="mt-2 flex space-x-4">
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-user mr-1"></i>
                                                Ahmad Rizki
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-calendar mr-1"></i>
                                                15 Maret 2024
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Validasi
                                        </span>
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900">Juara 2 Debat Bahasa Inggris</h4>
                                        <p class="text-sm text-gray-600">Kompetisi Regional - Universitas Gadjah Mada</p>
                                        <div class="mt-2 flex space-x-4">
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-user mr-1"></i>
                                                Siti Nurhaliza
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-calendar mr-1"></i>
                                                10 Maret 2024
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Tervalidasi
                                        </span>
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mahasiswa Bermasalah Content -->
            <div id="mahasiswa-bermasalah-content" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Mahasiswa Bermasalah</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola data mahasiswa bermasalah dan sanksi</p>
                    </div>
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Data
                    </button>
                </div>

                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Kelola Data Mahasiswa Bermasalah</h3>
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-200">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Data
                            </button>
                            <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Data
                            </button>
                            <button class="bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-red-200">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Data
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Kelola Sanksi -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Kelola Sanksi</h3>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <button class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm hover:bg-blue-200">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah
                                </button>
                                <button class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm hover:bg-green-200">
                                    <i class="fas fa-eye mr-1"></i>
                                    Lihat
                                </button>
                                <button class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm hover:bg-yellow-200">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </button>
                                <button class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div class="border-l-4 border-yellow-400 bg-yellow-50 p-3">
                                    <p class="text-sm font-medium text-yellow-800">Teguran Lisan</p>
                                </div>
                                <div class="border-l-4 border-orange-400 bg-orange-50 p-3">
                                    <p class="text-sm font-medium text-orange-800">Teguran Tertulis</p>
                                </div>
                                <div class="border-l-4 border-red-400 bg-red-50 p-3">
                                    <p class="text-sm font-medium text-red-800">Skorsing</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelola Pelanggaran -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Kelola Pelanggaran</h3>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <button class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm hover:bg-blue-200">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah
                                </button>
                                <button class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm hover:bg-green-200">
                                    <i class="fas fa-eye mr-1"></i>
                                    Lihat
                                </button>
                                <button class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm hover:bg-yellow-200">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </button>
                                <button class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div class="border-l-4 border-red-400 bg-red-50 p-3">
                                    <p class="text-sm font-medium text-red-800">Tidak Hadir Rapat</p>
                                    <p class="text-xs text-red-600">Tanpa keterangan</p>
                                </div>
                                <div class="border-l-4 border-orange-400 bg-orange-50 p-3">
                                    <p class="text-sm font-medium text-orange-800">Melanggar Dress Code</p>
                                    <p class="text-xs text-orange-600">Pada acara formal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berita Content -->
            <div id="berita-content" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Berita</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola berita dan informasi HIMA</p>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Berita
                    </button>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-200">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Berita
                            </button>
                            <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200">
                                <i class="fas fa-edit mr-2"></i>
                                Ubah Berita
                            </button>
                            <button class="bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-red-200">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Berita
                            </button>
                            <button class="bg-purple-100 text-purple-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-purple-200">
                                <i class="fas fa-comments mr-2"></i>
                                Kelola Komentar
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div class="border rounded-lg overflow-hidden">
                                <img src="https://via.placeholder.com/800x300" alt="Berita" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Pengumuman
                                        </span>
                                        <span class="text-sm text-gray-500">20 Maret 2024</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pendaftaran Anggota Baru HIMA 2024</h3>
                                    <p class="text-gray-600 mb-4">Pendaftaran anggota baru HIMA periode 2024 telah dibuka. Mahasiswa yang berminat dapat mendaftar melalui...</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-4">
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-eye mr-1"></i>
                                                120 views
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-comments mr-1"></i>
                                                5 komentar
                                            </span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded-lg overflow-hidden">
                                <img src="https://via.placeholder.com/800x300" alt="Berita" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Prestasi
                                        </span>
                                        <span class="text-sm text-gray-500">18 Maret 2024</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tim IT HIMA Raih Juara 1 Kompetisi Programming</h3>
                                    <p class="text-gray-600 mb-4">Tim dari Divisi IT HIMA berhasil meraih juara 1 dalam kompetisi programming tingkat nasional yang diadakan oleh...</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-4">
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-eye mr-1"></i>
                                                89 views
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-comments mr-1"></i>
                                                12 komentar
                                            </span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendaftaran Content -->
            <div id="pendaftaran-content" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Kelola Pendaftaran</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola pendaftaran keanggotaan HIMA</p>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-200">
                                <i class="fas fa-user-plus mr-2"></i>
                                Mendaftar Keanggotaan
                            </button>
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-200">
                                <i class="fas fa-check-circle mr-2"></i>
                                Validasi Pendaftaran
                            </button>
                            <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Pendaftaran
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Divisi Pilihan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Dewi Sartika</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">202012345</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Teknik Informatika</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Validasi</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900 mr-3">
                                                <i class="fas fa-check"></i>
                                                Terima
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-times"></i>
                                                Tolak
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rahmat Hidayat</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">202012346</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sistem Informasi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Humas</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                                Lihat
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Putri Amelia</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">202012347</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Teknik Komputer</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Akademik</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                                Lihat
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Show content based on menu selection
        function showContent(contentId) {
            // Hide all content sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.classList.add('hidden'));
            
            // Show selected content
            const selectedSection = document.getElementById(contentId + '-content');
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
            }
            
            // Update active menu item
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active', 'bg-blue-100', 'text-blue-700'));
            
            const activeMenuItem = document.querySelector(`[onclick="showContent('${contentId}')"]`);
            if (activeMenuItem) {
                activeMenuItem.classList.add('active', 'bg-blue-100', 'text-blue-700');
            }
        }

        // Initialize with dashboard active
        document.addEventListener('DOMContentLoaded', function() {
            showContent('dashboard');
        });
    </script>

    <style>
        /* Custom CSS untuk Dashboard HIMA */
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }
        
        /* Body styling */
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        /* Sidebar Styling */
        #sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        #sidebar .bg-blue-600 {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
        
        /* Menu Items */
        .menu-item {
            position: relative;
            border-radius: 12px;
            margin: 4px 0;
            font-weight: 500;
            overflow: hidden;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            transition: width 0.3s ease;
            z-index: -1;
        }
        
        .menu-item:hover::before {
            width: 4px;
        }
        
        .menu-item.active {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1d4ed8;
            font-weight: 600;
            transform: translateX(2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }
        
        .menu-item:hover {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            transform: translateX(4px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .menu-item i {
            width: 20px;
            text-align: center;
        }
        
        /* Header Styling */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        /* Search Input */
        header input[type="text"] {
            background: rgba(248, 250, 252, 0.8);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        header input[type="text"]:focus {
            background: white;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: scale(1.02);
        }
        
        /* Main Content */
        main {
            background: transparent;
        }
        
        .content-section {
            min-height: 100vh;
            animation: fadeInUp 0.5s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Card Styling */
        .bg-white {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .shadow, .shadow-lg, .shadow-md {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .rounded-lg {
            border-radius: 16px;
        }
        
        /* Stats Cards */
        .stats-card {
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }
        
        /* Buttons */
        button {
            border-radius: 12px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }
        
        button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }
        
        button:hover::before {
            width: 300px;
            height: 300px;
        }
        
        /* Primary Button */
        .bg-blue-600 {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
        
        .bg-blue-600:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
        }
        
        /* Status Badges */
        .bg-green-100 {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border: 1px solid #86efac;
        }
        
        .bg-yellow-100 {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1px solid #fcd34d;
        }
        
        .bg-red-100 {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 1px solid #f87171;
        }
        
        .bg-blue-100 {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid #60a5fa;
        }
        
        .bg-purple-100 {
            background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
            border: 1px solid #c084fc;
        }
        
        /* Tables */
        table {
            border-radius: 12px;
            overflow: hidden;
        }
        
        thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transform: scale(1.005);
        }
        
        /* Activity Timeline */
        .activity-timeline {
            position: relative;
        }
        
        .activity-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .activity-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 8px;
            height: 8px;
            background: #3b82f6;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #3b82f6;
        }
        
        .activity-item::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 1.5rem;
            width: 2px;
            height: calc(100% + 0.5rem);
            background: linear-gradient(180deg, #3b82f6 0%, transparent 100%);
        }
        
        .activity-item:last-child::after {
            display: none;
        }
        
        /* News Cards */
        .news-card {
            position: relative;
            overflow: hidden;
        }
        
        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899);
        }
        
        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .news-card img {
            transition: transform 0.3s ease;
        }
        
        .news-card:hover img {
            transform: scale(1.05);
        }
        
        /* Divisi Cards */
        .divisi-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            overflow: hidden;
        }
        
        .divisi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        }
        
        .divisi-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }
        
        /* Form Elements */
        input, select, textarea {
            border-radius: 12px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            background: rgba(248, 250, 252, 0.5);
        }
        
        input:focus, select:focus, textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
        }
        
        /* Loading Animation */
        .loading {
            position: relative;
            overflow: hidden;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Mobile Responsive */
        @media (max-width: 1024px) {
            #sidebar {
                transform: translateX(-100%);
                z-index: 50;
            }
            
            #sidebar.active {
                transform: translateX(0);
            }
            
            .lg\:ml-64 {
                margin-left: 0;
            }
            
            .stats-card {
                margin-bottom: 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
            
            .flex.space-x-4 {
                flex-direction: column;
                space: 0;
            }
            
            .flex.space-x-4 > * {
                margin-bottom: 0.5rem;
            }
            
            .text-3xl {
                font-size: 1.5rem;
            }
            
            .px-6 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                color: #f1f5f9;
            }
            
            #sidebar {
                background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
                border-right-color: #334155;
            }
            
            .bg-white {
                background: rgba(30, 41, 59, 0.95);
                color: #f1f5f9;
            }
            
            .text-gray-900 {
                color: #f1f5f9;
            }
            
            .text-gray-600 {
                color: #94a3b8;
            }
            
            .text-gray-500 {
                color: #64748b;
            }
        }
        
        /* Print Styles */
        @media print {
            #sidebar, header {
                display: none;
            }
            
            .lg\:ml-64 {
                margin-left: 0;
            }
            
            .bg-white {
                background: white !important;
            }
        }
        
        /* Accessibility */
        button:focus, a:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
        
        /* Custom utilities */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        /* Success Animation */
        .success-animation {
            animation: successPulse 0.6s ease-in-out;
        }
        
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</body>
</html>