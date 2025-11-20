@extends('layouts.app')

@section('content')

<style>
.msg-container {
    padding: 40px 0;
}
.msg-card {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.10);
    max-width: 750px;
    margin: 0 auto;
}
.msg-card h3 {
    font-weight: 700;
    margin-bottom: 18px;
}
.placeholder-box {
    background: #f1f5ff;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    color: #6b7280;
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

<div class="container msg-container">

    <div class="msg-card">
        <h3>✉️ Pesan Masuk</h3>

        <div class="placeholder-box">
            <p>Tidak ada pesan untuk saat ini.</p>
        </div>

        <a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>
    </div>

</div>

@endsection
