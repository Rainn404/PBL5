@extends('layouts.app')

@section('title', 'Berita - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Berita & Artikel</h1>
            <p>Informasi terbaru seputar kegiatan, prestasi, dan perkembangan HIMA-TI</p>
        </div>
    </section>

    <!-- Berita Section -->
    <section class="berita-page">
        <div class="container">
            <div class="berita-layout">
                <!-- Main Berita -->
                <div class="berita-main">
                    <!-- Featured Berita -->
                    <div class="featured-berita">
                        <div class="featured-image">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Featured Berita">
                            <div class="featured-badge">Featured</div>
                        </div>
                        <div class="featured-content">
                            <span class="berita-category">Workshop</span>
                            <h2>Workshop Web Development Modern dengan Laravel dan Vue.js</h2>
                            <p class="berita-excerpt">HIMA-TI sukses menyelenggarakan workshop web development selama 2 hari dengan peserta dari berbagai angkatan. Workshop ini membahas pengembangan web modern menggunakan framework terkini.</p>
                            <div class="berita-meta">
                                <div class="author">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Author">
                                    <span>Rizki Pratama</span>
                                </div>
                                <span class="berita-date"><i class="far fa-clock"></i> 15 Oktober 2023</span>
                                <span class="berita-views"><i class="far fa-eye"></i> 1.2k</span>
                            </div>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- Berita List -->
                    <div class="berita-list">
                        <div class="berita-item">
                            <div class="berita-item-image">
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Berita">
                            </div>
                            <div class="berita-item-content">
                                <span class="berita-category">Prestasi</span>
                                <h3>Anggota HIMA-TI Raih Juara 1 Hackathon Nasional</h3>
                                <p>Tim dari HIMA-TI berhasil meraih juara 1 dalam kompetisi hackathon tingkat nasional yang diadakan di Jakarta.</p>
                                <div class="berita-meta">
                                    <span class="berita-date"><i class="far fa-clock"></i> 10 Oktober 2023</span>
                                    <span class="berita-views"><i class="far fa-eye"></i> 890</span>
                                </div>
                            </div>
                        </div>

                        <div class="berita-item">
                            <div class="berita-item-image">
                                <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Berita">
                            </div>
                            <div class="berita-item-content">
                                <span class="berita-category">Kegiatan Sosial</span>
                                <h3>HIMA-TI Gelar Bakti Sosial di Desa Tertinggal</h3>
                                <p>Sebagai bentuk pengabdian masyarakat, HIMA-TI mengadakan kegiatan bakti sosial dan pelatihan komputer dasar.</p>
                                <div class="berita-meta">
                                    <span class="berita-date"><i class="far fa-clock"></i> 5 Oktober 2023</span>
                                    <span class="berita-views"><i class="far fa-eye"></i> 756</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahkan lebih banyak berita di sini -->
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="berita-sidebar">
                    <!-- Categories -->
                    <div class="sidebar-widget">
                        <h3>Kategori</h3>
                        <ul class="category-list">
                            <li><a href="#">Workshop <span>12</span></a></li>
                            <li><a href="#">Prestasi <span>8</span></a></li>
                            <li><a href="#">Kegiatan Sosial <span>5</span></a></li>
                            <li><a href="#">Seminar <span>7</span></a></li>
                            <li><a href="#">Pengumuman <span>3</span></a></li>
                        </ul>
                    </div>

                    <!-- Popular Berita -->
                    <div class="sidebar-widget">
                        <h3>Berita Populer</h3>
                        <div class="popular-berita">
                            <div class="popular-item">
                                <div class="popular-image">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Popular">
                                </div>
                                <div class="popular-content">
                                    <h4>Workshop Web Development Modern</h4>
                                    <span><i class="far fa-eye"></i> 1.2k</span>
                                </div>
                            </div>
                            <div class="popular-item">
                                <div class="popular-image">
                                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Popular">
                                </div>
                                <div class="popular-content">
                                    <h4>Juara 1 Hackathon Nasional</h4>
                                    <span><i class="far fa-eye"></i> 890</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="sidebar-widget newsletter-widget">
                        <h3>Newsletter</h3>
                        <p>Dapatkan update terbaru dari HIMA-TI langsung ke email Anda</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Alamat email Anda" required>
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection