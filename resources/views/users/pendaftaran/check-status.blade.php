@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - HIMA-TI')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Cek Status Pendaftaran</h1>
            <p>Pantau progress pendaftaran Anda dengan NIM</p>
        </div>
    </section>

    <!-- Check Status Form -->
    <section class="check-status-section">
        <div class="container">
            <div class="form-container">
                <h2>Masukkan NIM Anda</h2>
                
                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('pendaftaran.check-status') }}" method="POST" class="check-status-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nim">Nomor Induk Mahasiswa (NIM) *</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required 
                               placeholder="Masukkan NIM Anda">
                        @error('nim')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-search"></i> Cek Status
                    </button>
                </form>

                <div class="additional-info">
                    <h3>Informasi</h3>
                    <ul>
                        <li>Pastikan NIM yang dimasukkan sudah benar</li>
                        <li>Status akan menampilkan progress terbaru pendaftaran Anda</li>
                        <li>Jika mengalami kendala, hubungi admin di pendaftaran@himati.ac.id</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <style>
    .check-status-section {
        padding: 80px 0;
        background-color: var(--gray-light);
        min-height: 60vh;
    }

    .form-container {
        background: var(--white);
        padding: 40px;
        border-radius: 12px;
        box-shadow: var(--shadow);
        max-width: 500px;
        margin: 0 auto;
    }

    .form-container h2 {
        color: var(--primary-color);
        margin-bottom: 30px;
        text-align: center;
    }

    .check-status-form .form-group {
        margin-bottom: 25px;
    }

    .check-status-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .check-status-form input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: var(--transition);
    }

    .check-status-form input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .additional-info {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .additional-info h3 {
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .additional-info ul {
        list-style: none;
        padding-left: 0;
    }

    .additional-info li {
        padding: 8px 0;
        padding-left: 25px;
        position: relative;
        color: var(--text-light);
    }

    .additional-info li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: var(--primary-color);
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 25px;
        }
        
        .check-status-section {
            padding: 40px 0;
        }
    }
    </style>
@endsection