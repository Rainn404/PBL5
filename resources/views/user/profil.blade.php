@extends('layouts.app')

@section('content')

<style>
.profile-container {
    padding: 40px 0;
}

.profile-card {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.10);
    max-width: 600px;
    margin: 0 auto;
}

.profile-card h3 {
    font-weight: 700;
    margin-bottom: 20px;
}

.profile-info p {
    margin: 6px 0;
    font-size: 1rem;
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
.back-btn:hover {
    background: #007bff;
}
</style>

<div class="container profile-container">

    <div class="profile-card">
        <h3>👤 Profil Anggota</h3>

        <div class="profile-info">
            <p><strong>NIM:</strong> {{ auth()->user()->nim }}</p>
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Tanggal Bergabung:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
        </div>

        <a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>
    </div>

</div>

@endsection
