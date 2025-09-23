@extends('layouts.app')

@section('title', 'Divisi - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Divisi HIMA-TI</h1>
            <p>Struktur organisasi dan deskripsi divisi-divisi dalam Himpunan Mahasiswa Teknik Informatika</p>
        </div>
    </section>

    <!-- Divisi List -->
    <section class="divisi-list">
        <div class="container">
            <div class="divisi-cards">
                <div class="divisi-card-large">
                    <div class="divisi-header">
                        <div class="divisi-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="divisi-info">
                            <h2>Divisi Teknologi</h2>
                            <span class="anggota-count">15 Anggota</span>
                        </div>
                    </div>
                    <div class="divisi-content">
                        <p>Divisi Teknologi bertanggung jawab untuk mengembangkan kemampuan teknis anggota dalam pemrograman, pengembangan web, mobile development, dan teknologi terkini lainnya.</p>
                        <div class="divisi-responsibilities">
                            <h4>Tanggung Jawab:</h4>
                            <ul>
                                <li>Mengadakan workshop dan pelatihan teknologi</li>
                                <li>Mengembangkan sistem informasi HIMA-TI</li>
                                <li>Memberikan dukungan teknis untuk kegiatan</li>
                                <li>Mengikuti kompetisi teknologi</li>
                            </ul>
                        </div>
                        <div class="divisi-ketua">
                            <h4>Ketua Divisi:</h4>
                            <div class="ketua-profile">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Ketua Divisi">
                                <div>
                                    <h5>Ahmad Fauzi</h5>
                                    <span>Semester 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divisi-card-large">
                    <div class="divisi-header">
                        <div class="divisi-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="divisi-info">
                            <h2>Divisi Keanggotaan</h2>
                            <span class="anggota-count">12 Anggota</span>
                        </div>
                    </div>
                    <div class="divisi-content">
                        <p>Divisi Keanggotaan mengelola data anggota, proses pendaftaran, dan pengembangan soft skills melalui berbagai pelatihan dan kegiatan pengembangan diri.</p>
                        <div class="divisi-responsibilities">
                            <h4>Tanggung Jawab:</h4>
                            <ul>
                                <li>Mengelola database anggota</li>
                                <li>Memproses pendaftaran anggota baru</li>
                                <li>Mengadakan pelatihan soft skills</li>
                                <li>Membangun jaringan alumni</li>
                            </ul>
                        </div>
                        <div class="divisi-ketua">
                            <h4>Ketua Divisi:</h4>
                            <div class="ketua-profile">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Ketua Divisi">
                                <div>
                                    <h5>Siti Rahayu</h5>
                                    <span>Semester 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divisi-card-large">
                    <div class="divisi-header">
                        <div class="divisi-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="divisi-info">
                            <h2>Divisi Media & Komunikasi</h2>
                            <span class="anggota-count">10 Anggota</span>
                        </div>
                    </div>
                    <div class="divisi-content">
                        <p>Divisi Media & Komunikasi bertugas mengelola konten media sosial, website, dan publikasi kegiatan HIMA-TI kepada masyarakat internal dan eksternal.</p>
                        <div class="divisi-responsibilities">
                            <h4>Tanggung Jawab:</h4>
                            <ul>
                                <li>Mengelola media sosial HIMA-TI</li>
                                <li>Memproduksi konten kreatif</li>
                                <li>Meliput dan mendokumentasikan kegiatan</li>
                                <li>Membuat newsletter bulanan</li>
                            </ul>
                        </div>
                        <div class="divisi-ketua">
                            <h4>Ketua Divisi:</h4>
                            <div class="ketua-profile">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Ketua Divisi">
                                <div>
                                    <h5>Rizki Pratama</h5>
                                    <span>Semester 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divisi-card-large">
                    <div class="divisi-header">
                        <div class="divisi-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="divisi-info">
                            <h2>Divisi Kewirausahaan</h2>
                            <span class="anggota-count">8 Anggota</span>
                        </div>
                    </div>
                    <div class="divisi-content">
                        <p>Divisi Kewirausahaan fokus pada pengembangan jiwa kewirausahaan dan mengelola unit usaha HIMA-TI untuk menghasilkan pendapatan yang digunakan untuk kegiatan organisasi.</p>
                        <div class="divisi-responsibilities">
                            <h4>Tanggung Jawab:</h4>
                            <ul>
                                <li>Mengelola unit usaha HIMA-TI</li>
                                <li>Mengadakan seminar kewirausahaan</li>
                                <li>Mencari sponsorship untuk kegiatan</li>
                                <li>Mengembangkan produk digital</li>
                            </ul>
                        </div>
                        <div class="divisi-ketua">
                            <h4>Ketua Divisi:</h4>
                            <div class="ketua-profile">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Ketua Divisi">
                                <div>
                                    <h5>Budi Santoso</h5>
                                    <span>Semester 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Section -->
    <section class="join-section">
        <div class="container">
            <div class="join-content">
                <h2>Tertarik Bergabung dengan Divisi Kami?</h2>
                <p>Dapatkan pengalaman berharga, kembangkan skill Anda, dan jadi bagian dari perubahan positif di HIMA-TI</p>
                <div class="join-buttons">
                    <a href="{{ url('/pendaftaran') }}" class="btn btn-primary">Daftar Sekarang</a>
                    <a href="{{ url('/anggota') }}" class="btn btn-outline">Lihat Profil Anggota</a>
                </div>
            </div>
        </div>
    </section>
@endsection