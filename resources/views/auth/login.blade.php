@extends('layouts.app')

@section('title', 'Login - Dapur Ceria')

@section('styles')
<style>
    .auth-container {
        max-width: 400px;
        margin: 3rem auto;
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .auth-header h2 {
        color: #ff6b6b;
        margin-bottom: 0.5rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }
    .form-control:focus {
        outline: none;
        border-color: #ff6b6b;
    }
    .error {
        color: #ff6b6b;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .auth-footer {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
    }
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h2>Login</h2>
        <p>Masuk ke akun Dapur Ceria Anda</p>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="margin: 0; font-weight: normal;">Ingat Saya</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
    </form>

    <div class="auth-footer">
        <p>Belum punya akun? <a href="{{ route('register') }}" style="color: #ff6b6b; font-weight: 600;">Daftar Sekarang</a></p>
    </div>
</div>
@endsection