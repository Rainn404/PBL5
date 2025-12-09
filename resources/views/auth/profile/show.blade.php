@extends('layouts.app_admin')

@section('title','Profil Saya')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="avatar" class="rounded-circle mb-3" width="150" height="150">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3B82F6&color=fff&size=150" alt="avatar" class="rounded-circle mb-3" width="150" height="150">
                    @endif
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card mb-3">
                <div class="card-header">
                    <h5>Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nama:</strong></div>
                        <div class="col-md-8">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Email:</strong></div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Role:</strong></div>
                        <div class="col-md-8"><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary"><i class="fas fa-edit me-2"></i>Edit Profil</a>
                            <a href="{{ route('profile.password') }}" class="btn btn-secondary"><i class="fas fa-lock me-2"></i>Ubah Password</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Foto Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.avatar.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Foto (Max: 2MB)</label>
                            <input type="file" name="avatar" accept="image/*" class="form-control" required>
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-upload me-2"></i>Upload Foto</button>
                    </form>
                    @if($user->avatar)
                        <hr>
                        <form action="{{ route('profile.avatar.remove') }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash me-2"></i>Hapus Foto</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
