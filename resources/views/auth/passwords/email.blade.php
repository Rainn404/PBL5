@extends('layouts.app')

@section('title','Reset Password')

@section('content')
<div class="container">
    <h2>Reset Password</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button class="btn btn-primary">Kirim Link Reset</button>
    </form>
</div>
@endsection
