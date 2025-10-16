@extends('layouts.app')

@section('title', 'Kuota Penuh - HIMA-TI')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Kuota Pendaftaran Penuh</h1>
        <p>Maaf, kuota pendaftaran anggota HIMA-TI telah terpenuhi</p>
    </div>
</section>

<!-- Quota Full Message -->
<section class="quota-section">
    <div class="container">
        <div class="quota-card">
            <div class="quota-icon">
                <i class="fas fa-users-slash"></i>
            </div>
            <h2>Kuota Telah Terpenuhi</h2>
            <p class="quota-message">
                Maaf, kuota pendaftaran anggota HIMA-TI untuk periode ini telah terpenuhi. 
                Terima kasih atas minat dan antusiasme Anda.
            </p>

            <div class="stats-card">
                <div class="stat-item">
                    <i class="fas fa-user-check"></i>
                    <div>
                        <strong>{{ \App\Models\Pendaftaran::where('status_pendaftaran', 'diterima')->count() }}</strong>
                        <span>Anggota Diterima</span>
                    </div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>{{ \App\Models\Pendaftaran::where('status_pendaftaran', 'pending')->count() }}</strong>
                        <span>Menunggu Review</span>
                    </div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-trophy"></i>
                    <div>
                        <strong>{{ \App\Models\SystemSetting::getSettings()->kuota }}</strong>
                        <span>Kuota Maksimal</span>
                    </div>
                </div>
            </div>

            <div class="next-period">
                <h4>Periode Berikutnya</h4>
                <p>Silakan pantau informasi untuk periode pendaftaran berikutnya melalui:</p>
                <div class="info-channels">
                    <div class="channel">
                        <i class="fas fa-globe"></i>
                        <span>Website Resmi</span>
                    </div>
                    <div class="channel">
                        <i class="fab fa-instagram"></i>
                        <span>Instagram</span>
                    </div>
                    <div class="channel">
                        <i class="fab fa-line"></i>
                        <span>LINE Official</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
                <a href="{{ route('pendaftaran.check-status') }}" class="btn btn-outline">
                    <i class="fas fa-search"></i> Cek Status Pendaftaran
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.quota-section {
    padding: 80px 0;
    background-color: var(--gray-light);
    min-height: 70vh;
}

.quota-card {
    background: var(--white);
    padding: 50px;
    border-radius: 16px;
    box-shadow: var(--shadow);
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.quota-icon {
    font-size: 5rem;
    color: #ffc107;
    margin-bottom: 25px;
}

.quota-card h2 {
    color: var(--primary-color);
    margin-bottom: 20px;
    font-size: 2rem;
}

.quota-message {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.stats-card {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin: 30px 0;
}

.stat-item {
    background: var(--gray-light);
    padding: 20px;
    border-radius: 8px;
    text-align: center;
}

.stat-item i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 10px;
}

.stat-item strong {
    display: block;
    font-size: 1.5rem;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.stat-item span {
    color: var(--text-light);
    font-size: 0.9rem;
}

.next-period {
    background: var(--gray-light);
    padding: 25px;
    border-radius: 12px;
    margin: 25px 0;
}

.next-period h4 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

.info-channels {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.channel {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.channel i {
    font-size: 1.5rem;
    color: var(--primary-color);
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

@media (max-width: 768px) {
    .quota-card {
        padding: 30px 20px;
    }
    
    .stats-card {
        grid-template-columns: 1fr;
    }
    
    .info-channels {
        flex-direction: column;
        gap: 15px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>
@endsection