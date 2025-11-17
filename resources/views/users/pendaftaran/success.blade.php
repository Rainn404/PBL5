@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - HIMA-TI')

@section('content')
<!-- Success Message -->
<section class="success-section">
    <div class="container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Pendaftaran Anda Berhasil!</h2>
            <p>Data pendaftaran Anda telah kami terima dan sedang dalam proses verifikasi.</p>
            
            <!-- Tampilkan Data Pendaftaran -->
            @if(isset($pendaftaranData))
            <div class="registration-details">
                <h3>Detail Pendaftaran:</h3>
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="detail-label">ID Pendaftaran:</span>
                        <span class="detail-value">{{ $pendaftaranData['id'] }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nama:</span>
                        <span class="detail-value">{{ $pendaftaranData['nama'] }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NIM:</span>
                        <span class="detail-value">{{ $pendaftaranData['nim'] }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Semester:</span>
                        <span class="detail-value">{{ $pendaftaranData['semester'] }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Daftar:</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($pendaftaranData['submitted_at'])->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
            @endif

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
                <a href="{{ route('pendaftaran.check-status.form') }}" class="btn btn-outline">
                    <i class="fas fa-chart-line"></i> Cek Status Pendaftaran
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.success-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #EFF6FF 0%, #F3F4F6 100%);
    min-height: 100vh;
}

.success-card {
    background: white;
    padding: 50px;
    border-radius: 16px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

.success-icon {
    font-size: 5rem;
    color: #10B981;
    margin-bottom: 25px;
    animation: bounce 1s ease-in-out;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.success-card h2 {
    color: #1F2937;
    font-size: 2.25rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.success-card p {
    color: #6B7280;
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.registration-details {
    background: #F9FAFB;
    padding: 25px;
    border-radius: 12px;
    margin: 30px 0;
    text-align: left;
}

.registration-details h3 {
    color: #374151;
    margin-bottom: 20px;
    text-align: center;
    font-size: 1.25rem;
    font-weight: 600;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #E5E7EB;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    color: #6B7280;
    font-weight: 500;
}

.detail-value {
    color: #1F2937;
    font-weight: 600;
}

.next-steps {
    background: #F0F9FF;
    padding: 25px;
    border-radius: 12px;
    margin: 30px 0;
    text-align: left;
    border-left: 4px solid #3B82F6;
}

.next-steps h3 {
    color: #1E40AF;
    margin-bottom: 15px;
    text-align: center;
    font-size: 1.25rem;
    font-weight: 600;
}

.next-steps ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.next-steps li {
    padding: 12px 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #374151;
    font-size: 1rem;
}

.next-steps i {
    color: #3B82F6;
    width: 20px;
    font-size: 1.1rem;
}

.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
    flex-wrap: wrap;
}

.btn {
    padding: 14px 28px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 1rem;
    border: 2px solid transparent;
}

.btn-primary {
    background: #3B82F6;
    color: white;
}

.btn-primary:hover {
    background: #2563EB;
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
}

.btn-outline {
    background: transparent;
    color: #3B82F6;
    border: 2px solid #3B82F6;
}

.btn-outline:hover {
    background: #3B82F6;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .success-section {
        padding: 40px 0;
    }
    
    .success-card {
        padding: 30px 20px;
        margin: 0 15px;
    }
    
    .success-icon {
        font-size: 4rem;
    }
    
    .success-card h2 {
        font-size: 1.75rem;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .success-card {
        padding: 25px 15px;
    }
    
    .success-icon {
        font-size: 3.5rem;
    }
    
    .success-card h2 {
        font-size: 1.5rem;
    }
    
    .success-card p {
        font-size: 1rem;
    }
    
    .registration-details,
    .next-steps {
        padding: 20px 15px;
    }
}
</style>
@endsection