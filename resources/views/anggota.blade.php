@extends('layouts.app')

@section('title', 'Profil Anggota - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Profil Anggota</h1>
            <p>Kenali anggota-anggota aktif Himpunan Mahasiswa Teknik Informatika</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="anggota-filter">
        <div class="container">
            <div class="filter-options">
                <div class="filter-group">
                    <label for="divisi-filter">Filter Divisi:</label>
                    <select id="divisi-filter">
                        <option value="all">Semua Divisi</option>
                        <option value="teknologi">Divisi Teknologi</option>
                        <option value="keanggotaan">Divisi Keanggotaan</option>
                        <option value="media">Divisi Media & Komunikasi</option>
                        <option value="kewirausahaan">Divisi Kewirausahaan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="semester-filter">Filter Semester:</label>
                    <select id="semester-filter">
                        <option value="all">Semua Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="3">Semester 3</option>
                        <option value="5">Semester 5</option>
                        <option value="7">Semester 7</option>
                    </select>
                </div>
                <div class="search-group">
                    <input type="text" id="search-anggota" placeholder="Cari nama anggota...">
                    <button type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Anggota Grid -->
    <section class="anggota-grid-section">
        <div class="container">
            <div class="anggota-grid">
                <!-- Anggota 1 -->
                <div class="anggota-card" data-divisi="teknologi" data-semester="5">
                    <div class="anggota-photo">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Ahmad Fauzi">
                        <div class="anggota-status online"></div>
                    </div>
                    <div class="anggota-info">
                        <h3>Ahmad Fauzi</h3>
                        <span class="anggota-nim">2100018001</span>
                        <div class="anggota-details">
                            <p><i class="fas fa-code"></i> Divisi Teknologi</p>
                            <p><i class="fas fa-graduation-cap"></i> Semester 5</p>
                            <p><i class="fas fa-star"></i> Ketua Divisi</p>
                        </div>
                        <div class="anggota-skills">
                            <span class="skill-tag">Web Development</span>
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">AI/ML</span>
                        </div>
                    </div>
                    <div class="anggota-actions">
                        <button class="btn-profile">Lihat Profil</button>
                    </div>
                </div>

                <!-- Anggota 2 -->
                <div class="anggota-card" data-divisi="keanggotaan" data-semester="5">
                    <div class="anggota-photo">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Siti Rahayu">
                        <div class="anggota-status online"></div>
                    </div>
                    <div class="anggota-info">
                        <h3>Siti Rahayu</h3>
                        <span class="anggota-nim">2100018002</span>
                        <div class="anggota-details">
                            <p><i class="fas fa-users"></i> Divisi Keanggotaan</p>
                            <p><i class="fas fa-graduation-cap"></i> Semester 5</p>
                            <p><i class="fas fa-star"></i> Ketua Divisi</p>
                        </div>
                        <div class="anggota-skills">
                            <span class="skill-tag">Public Speaking</span>
                            <span class="skill-tag">Leadership</span>
                            <span class="skill-tag">Management</span>
                        </div>
                    </div>
                    <div class="anggota-actions">
                        <button class="btn-profile">Lihat Profil</button>
                    </div>
                </div>

                <!-- Anggota 3 -->
                <div class="anggota-card" data-divisi="media" data-semester="5">
                    <div class="anggota-photo">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Rizki Pratama">
                        <div class="anggota-status offline"></div>
                    </div>
                    <div class="anggota-info">
                        <h3>Rizki Pratama</h3>
                        <span class="anggota-nim">2100018003</span>
                        <div class="anggota-details">
                            <p><i class="fas fa-newspaper"></i> Divisi Media & Komunikasi</p>
                            <p><i class="fas fa-graduation-cap"></i> Semester 5</p>
                            <p><i class="fas fa-star"></i> Ketua Divisi</p>
                        </div>
                        <div class="anggota-skills">
                            <span class="skill-tag">Graphic Design</span>
                            <span class="skill-tag">Photography</span>
                            <span class="skill-tag">Video Editing</span>
                        </div>
                    </div>
                    <div class="anggota-actions">
                        <button class="btn-profile">Lihat Profil</button>
                    </div>
                </div>

                <!-- Anggota 4 -->
                <div class="anggota-card" data-divisi="kewirausahaan" data-semester="5">
                    <div class="anggota-photo">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Budi Santoso">
                        <div class="anggota-status online"></div>
                    </div>
                    <div class="anggota-info">
                        <h3>Budi Santoso</h3>
                        <span class="anggota-nim">2100018004</span>
                        <div class="anggota-details">
                            <p><i class="fas fa-chart-line"></i> Divisi Kewirausahaan</p>
                            <p><i class="fas fa-graduation-cap"></i> Semester 5</p>
                            <p><i class="fas fa-star"></i> Ketua Divisi</p>
                        </div>
                        <div class="anggota-skills">
                            <span class="skill-tag">Business</span>
                            <span class="skill-tag">Marketing</span>
                            <span class="skill-tag">Finance</span>
                        </div>
                    </div>
                    <div class="anggota-actions">
                        <button class="btn-profile">Lihat Profil</button>
                    </div>
                </div>

                <!-- Tambahkan lebih banyak anggota di sini -->
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn next">Next <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>
@endsection