@extends('layouts.app')

@section('title', 'Pendaftaran Ditutup - HIMA-TI')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Pendaftaran Sedang Ditutup</h1>
        <p>Periode pendaftaran anggota HIMA-TI saat ini tidak aktif</p>
    </div>
</section>

<!-- Closed Message -->
<section class="closed-section">
    <div class="container">
        <div class="closed-card">
            <div class="closed-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Pendaftaran Tidak Tersedia</h2>
            <p class="closed-message">
                Maaf, pendaftaran anggota HIMA-TI sedang ditutup untuk saat ini. 
                Silakan pantau informasi terbaru melalui website atau media sosial kami.
            </p>

            @php
                $settings = \App\Models\SystemSetting::getSettings();
            @endphp

            @if($settings->tanggal_mulai > now())
            <div class="info-card">
                <h4>Periode Pendaftaran Berikutnya</h4>
                <div class="info-details">
                    <div class="info-item">
                        <i class="fas fa-calendar-plus"></i>
                        <div>
                            <strong>Mulai:</strong>
                            <span>{{ \Carbon\Carbon::parse($settings->tanggal_mulai)->format('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-minus"></i>
                        <div>
                            <strong>Selesai:</strong>
                            <span>{{ \Carbon\Carbon::parse($settings->tanggal_selesai)->format('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-users"></i>
                        <div>
                            <strong>Kuota:</strong>
                            <span>{{ $settings->kuota }} anggota</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="countdown-card" id="countdownCard" style="display: none;">
                <h4>Pendaftaran Akan Dibuka Dalam:</h4>
                <div class="countdown-timer" id="countdownTimer">
                    <div class="countdown-item">
                        <span id="days">00</span>
                        <small>Hari</small>
                    </div>
                    <div class="countdown-item">
                        <span id="hours">00</span>
                        <small>Jam</small>
                    </div>
                    <div class="countdown-item">
                        <span id="minutes">00</span>
                        <small>Menit</small>
                    </div>
                    <div class="countdown-item">
                        <span id="seconds">00</span>
                        <small>Detik</small>
                    </div>
                </div>
            </div>

            <div class="contact-info">
                <h4>Butuh Informasi?</h4>
                <p>Hubungi kami untuk informasi lebih lanjut:</p>
                <div class="contact-methods">
                    <p><i class="fas fa-envelope"></i> pendaftaran@himati.ac.id</p>
                    <p><i class="fas fa-phone"></i> +62 812 3456 7890</p>
                    <p><i class="fas fa-globe"></i> www.himati.ac.id</p>
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
.closed-section {
    padding: 80px 0;
    background-color: var(--gray-light);
    min-height: 70vh;
}

.closed-card {
    background: var(--white);
    padding: 50px;
    border-radius: 16px;
    box-shadow: var(--shadow);
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

.closed-icon {
    font-size: 5rem;
    color: #dc3545;
    margin-bottom: 25px;
}

.closed-card h2 {
    color: var(--primary-color);
    margin-bottom: 20px;
    font-size: 2rem;
}

.closed-message {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.info-card {
    background: var(--gray-light);
    padding: 25px;
    border-radius: 12px;
    margin: 30px 0;
    text-align: left;
}

.info-card h4 {
    color: var(--primary-color);
    margin-bottom: 20px;
    text-align: center;
}

.info-details {
    display: grid;
    gap: 15px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px;
    background: var(--white);
    border-radius: 8px;
}

.info-item i {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.countdown-card {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--white);
    padding: 30px;
    border-radius: 12px;
    margin: 25px 0;
}

.countdown-timer {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.countdown-item {
    text-align: center;
}

.countdown-item span {
    display: block;
    font-size: 2.5rem;
    font-weight: bold;
    background: rgba(255, 255, 255, 0.2);
    padding: 15px;
    border-radius: 8px;
    min-width: 80px;
}

.countdown-item small {
    display: block;
    margin-top: 5px;
    opacity: 0.9;
}

.contact-info {
    background: var(--gray-light);
    padding: 25px;
    border-radius: 12px;
    margin: 25px 0;
}

.contact-info h4 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

.contact-methods p {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 8px;
    color: var(--text-dark);
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
    .closed-card {
        padding: 30px 20px;
    }
    
    .countdown-timer {
        gap: 10px;
    }
    
    .countdown-item span {
        font-size: 2rem;
        min-width: 60px;
        padding: 10px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .info-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDate = new Date('{{ $settings->tanggal_mulai }}').getTime();
    const countdownCard = document.getElementById('countdownCard');
    
    // Show countdown if registration will open in the future
    if (startDate > Date.now()) {
        countdownCard.style.display = 'block';
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = startDate - now;
            
            if (distance < 0) {
                countdownCard.innerHTML = '<h4>Pendaftaran Telah Dibuka!</h4>';
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
});
</script>
@endsection