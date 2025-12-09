@extends('layouts.app_admin')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="avatar" class="rounded-circle mb-3" width="120" height="120">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff&size=120" alt="avatar" class="rounded-circle mb-3" width="120" height="120">
                    @endif
                    <h5>{{ Auth::user()->name }}</h5>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Nama</strong></div>
                        <div class="col-md-9">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Email</strong></div>
                        <div class="col-md-9">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Role</strong></div>
                        <div class="col-md-9"><span class="badge bg-primary">{{ ucfirst(Auth::user()->role) }}</span></div>
                    </div>
                    <hr>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit me-2"></i>Edit Profil</a>
                        <a href="{{ route('profile.password') }}" class="btn btn-secondary btn-sm"><i class="fas fa-lock me-2"></i>Ubah Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
