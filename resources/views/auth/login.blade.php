<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HIMA-TI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --accent: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-form-container {
            flex: 1;
            padding: 50px;
            background: white;
        }

        .login-info {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .logo-icon i {
            font-size: 24px;
            color: white;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .subtitle {
            color: var(--gray);
            margin-bottom: 30px;
            font-size: 16px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        input {
            width: 100%;
            padding: 15px 45px 15px 15px;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 14px;
        }

        .checkbox-label input {
            width: auto;
            margin-right: 8px;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .login-divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--gray);
        }

        .login-divider::before,
        .login-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--light-gray);
        }

        .login-divider span {
            padding: 0 15px;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 15px;
        }

        .btn-google {
            flex: 1;
            background: white;
            color: var(--dark);
            border: 2px solid var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-google:hover {
            border-color: #db4437;
            color: #db4437;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-microsoft {
            flex: 1;
            background: white;
            color: var(--dark);
            border: 2px solid var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-microsoft:hover {
            border-color: #0078d4;
            color: #0078d4;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .info-icon i {
            font-size: 24px;
        }

        .info-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .info-card p {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-2px);
        }

        .login-features h4 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .login-features ul {
            list-style: none;
        }

        .login-features li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .login-features i {
            margin-right: 10px;
            color: var(--success);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .demo-accounts {
            background: var(--light);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .demo-accounts h4 {
            margin-bottom: 10px;
            color: var(--dark);
        }

        .demo-account {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .demo-account .role {
            font-weight: 600;
            color: var(--primary);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-info {
                order: -1;
            }
        }

        @media (max-width: 576px) {
            .login-form-container, .login-info {
                padding: 30px;
            }
            
            .social-login {
                flex-direction: column;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-form-container, .login-info {
            animation: fadeIn 0.8s ease-out;
        }

        /* Loading state for buttons */
        .btn-loading {
            position: relative;
            color: transparent;
        }

        .btn-loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <div class="logo-text">HIMA-TI</div>
            </div>
            
            <h1>Masuk ke Akun Anda</h1>
            <p class="subtitle">Akses dashboard dan fitur eksklusif untuk anggota HIMA-TI</p>
            
            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required autofocus>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
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

                <button type="submit" class="btn btn-primary">Masuk</button>

                <div class="login-divider">
                    <span>Akun Demo</span>
                </div>

                <div class="demo-accounts">
                    <h4>Gunakan akun demo berikut:</h4>
                    <div class="demo-account">
                        <span class="role">Super Admin:</span>
                        <span>superadmin@hima.com / password123</span>
                    </div>
                    <div class="demo-account">
                        <span class="role">Admin:</span>
                        <span>admin@hima.com / password123</span>
                    </div>
                    <div class="demo-account">
                        <span class="role">Mahasiswa:</span>
                        <span>ahmad@hima.com / password123</span>
                    </div>
                </div>
            </form>
        </div>

        <div class="login-info">
            <div>
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Anggota HIMA-TI</h3>
                    <p>Login untuk mengakses dashboard anggota, mengajukan prestasi, dan berpartisipasi dalam kegiatan</p>
                    <a href="{{ route('pendaftaran.create') }}" class="btn-outline">Daftar Menjadi Anggota</a>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3>Admin & Pengurus</h3>
                    <p>Akses panel admin untuk mengelola data anggota, berita, dan kegiatan organisasi</p>
                </div>
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

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Auto-fill demo accounts for testing
        document.addEventListener('DOMContentLoaded', function() {
            // You can remove this in production
            const urlParams = new URLSearchParams(window.location.search);
            const demo = urlParams.get('demo');
            
            if (demo) {
                const accounts = {
                    'superadmin': {email: 'superadmin@hima.com', password: 'password123'},
                    'admin': {email: 'admin@hima.com', password: 'password123'},
                    'mahasiswa': {email: 'ahmad@hima.com', password: 'password123'}
                };
                
                if (accounts[demo]) {
                    document.getElementById('email').value = accounts[demo].email;
                    document.getElementById('password').value = accounts[demo].password;
                }
            }
        });
    </script>
</body>
</html>