@extends('layouts.app')

@section('content')

<style>
.stats-container {
    padding: 40px 0;
}
.stats-card {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.10);
    max-width: 750px;
    margin: 0 auto;
}
.stats-card h3 {
    font-weight: 700;
    margin-bottom: 18px;
}
.stats-box {
    background: #eef5ff;
    padding: 20px;
    border-radius: 12px;
}
.stat-item {
    margin: 10px 0;
}
.back-btn {
    margin-top: 25px;
    display: inline-block;
    background: #1d8cf8;
    padding: 10px 22px;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
}
</style>

<div class="container stats-container">

    <div class="stats-card">
        <h3>📊 Statistik Anggota</h3>

        <div class="stats-box">
            <div class="stat-item">
                <strong>Jumlah Kunjungan Dashboard:</strong> 0 (dummy)
            </div>
            <div class="stat-item">
                <strong>Prestasi diinput:</strong> 0 (dummy)
            </div>
            <div class="stat-item">
                <strong>Berita dibaca:</strong> 0 (dummy)
            </div>
        </div>

        <a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>
    </div>

</div>

@endsection
