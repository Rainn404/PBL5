@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - HIMA-TI')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Pendaftaran Berhasil</h1>
        <p>Terima kasih telah mendaftar menjadi anggota HIMA-TI</p>
    </div>
</section>

<!-- Success Message -->
<section class="success-section">
    <div class="container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Pendaftaran Anda Berhasil!</h2>
            <p>Data pendaftaran Anda telah kami terima dan sedang dalam proses verifikasi.</p>
            
            <div class="next-steps">
                <h3>Yang Perlu Anda Lakukan:</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> Pantau email secara berkala</li>
                    <li><i class="fas fa-phone"></i> Pastikan nomor HP aktif</li>
                    <li><i class="fas fa-clock"></i> Tunggu informasi verifikasi (1-3 hari kerja)</li>
                    <li><i class="fas fa-calendar"></i> Persiapkan diri untuk wawancara</li>
                </ul>
            </div>

            <div class="action-buttons">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
                <a href="{{ route('pendaftaran.status', session('pendaftaran_id')) }}" class="btn btn-outline">
                    <i class="fas fa-chart-line"></i> Lihat Status Pendaftaran
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.success-section {
    padding: 80px 0;
    background-color: var(--gray-light);
    min-height: 60vh;
}

.success-card {
    background: var(--white);
    padding: 50px;
    border-radius: 12px;
    box-shadow: var(--shadow);
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.success-icon {
    font-size: 4rem;
    color: #28a745;
    margin-bottom: 20px;
}

.success-card h2 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

.success-card p {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.next-steps {
    background: var(--gray-light);
    padding: 25px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: left;
}

.next-steps h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
    text-align: center;
}

.next-steps ul {
    list-style: none;
    padding: 0;
}

.next-steps li {
    padding: 10px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text-dark);
}

.next-steps i {
    color: var(--primary-color);
    width: 20px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
}

.btn {
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
    font-weight: 600;
}

.btn-primary {
    background: var(--primary-color);
    color: var(--white);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
}

@media (max-width: 576px) {
    .success-card {
        padding: 30px 20px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>
@endsection