@extends('layouts.app')

@section('title', 'Login - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Masuk ke Akun Anda</h1>
            <p>Akses dashboard dan fitur eksklusif untuk anggota HIMA-TI</p>
        </div>
    </section>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-form-container">
                    <h2>Login</h2>
                    <form class="login-form" id="loginForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="email">Email atau NIM</label>
                            <input type="text" id="email" name="email" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" id="remember" name="remember">
                                <span class="checkmark"></span>
                                Ingat saya
                            </label>
                            <a href="#" class="forgot-password">Lupa password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-login">Masuk</button>

                        <div class="login-divider">
                            <span>atau masuk dengan</span>
                        </div>

                        <div class="social-login">
                            <button type="button" class="btn btn-google">
                                <i class="fab fa-google"></i>
                                Google
                            </button>
                            <button type="button" class="btn btn-microsoft">
                                <i class="fab fa-microsoft"></i>
                                Microsoft
                            </button>
                        </div>
                    </form>
                </div>

                <div class="login-info">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Anggota HIMA-TI</h3>
                        <p>Login untuk mengakses dashboard anggota, mengajukan prestasi, dan berpartisipasi dalam kegiatan</p>
                        <a href="{{ url('/pendaftaran') }}" class="btn btn-outline">Daftar Menjadi Anggota</a>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3>Admin & Pengurus</h3>
                        <p>Akses panel admin untuk mengelola data anggota, berita, dan kegiatan organisasi</p>
                    </div>

                    <div class="login-features">
                        <h4>Fitur yang Dapat Diakses:</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Kelola profil anggota</li>
                            <li><i class="fas fa-check"></i> Ajukan prestasi dan kegiatan</li>
                            <li><i class="fas fa-check"></i> Akses materi eksklusif</li>
                            <li><i class="fas fa-check"></i> Partisipasi dalam forum diskusi</li>
                            <li><i class="fas fa-check"></i> Notifikasi kegiatan terbaru</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section class="login-support">
        <div class="container">
            <div class="support-content">
                <h2>Butuh Bantuan Login?</h2>
                <p>Hubungi tim support kami untuk masalah teknis atau pertanyaan seputar akun</p>
                <div class="support-options">
                    <div class="support-option">
                        <i class="fas fa-envelope"></i>
                        <h4>Email Support</h4>
                        <p>support@himati.ac.id</p>
                        <span>Response time: 1-2 jam</span>
                    </div>
                    <div class="support-option">
                        <i class="fas fa-phone"></i>
                        <h4>Telepon</h4>
                        <p>+62 812 3456 7890</p>
                        <span>Senin - Jumat, 08:00 - 16:00</span>
                    </div>
                    <div class="support-option">
                        <i class="fas fa-comments"></i>
                        <h4>Live Chat</h4>
                        <p>Available 24/7</p>
                        <span>Chat dengan bot kami</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection