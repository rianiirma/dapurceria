@extends('layouts.app')
@section('title', 'Reset Password')

@push('styles')
<style>
body { background: #FDF5EC; }
.auth-page { min-height: calc(100vh - 60px); display: flex; align-items: center; justify-content: center; padding: 40px 16px; }
.auth-card { background: #fff; border-radius: 20px; width: 100%; max-width: 380px; border: 1px solid #E8D5C0; padding: 36px 28px; }
.fg { margin-bottom: 14px; }
.fg label { display: block; font-size: 12px; font-weight: 600; color: #3D2010; margin-bottom: 5px; }
.fg input { width: 100%; padding: 10px 14px; background: #FDF8F4; border: 1.5px solid #E8D5C0; border-radius: 10px; font-size: 13px; font-family: inherit; color: #3D2010; outline: none; transition: border-color .2s; }
.fg input:focus { border-color: #D4622A; }
.fg input::placeholder { color: #9C7A60; opacity: .6; }
.btn-or { width: 100%; padding: 12px; background: #D4622A; color: #fff; border: none; border-radius: 10px; font-size: 14px; font-weight: 700; font-family: inherit; cursor: pointer; margin-top: 4px; }
.btn-or:hover { background: #BF5522; }
</style>
@endpush

@section('content')
<div class="auth-page">
  <div class="auth-card">
    <div style="text-align:center;margin-bottom:24px;">
      <div style="font-size:40px;margin-bottom:12px;">🔒</div>
      <h2 style="font-size:20px;font-weight:700;color:#3D2010;margin-bottom:6px;">Buat Password Baru</h2>
      <p style="font-size:13px;color:#9C7A60;">Masukkan password baru untuk akunmu.</p>
    </div>

    @if($errors->any())
      <div style="background:#FDEDEC;border:1px solid #F5B7B1;border-radius:10px;padding:10px 14px;margin-bottom:16px;font-size:13px;color:#C0392B;">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="fg">
        <label>Email</label>
        <input type="email" name="email" placeholder="email@contoh.com" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="fg">
        <label>Password Baru</label>
        <input type="password" name="password" placeholder="min. 8 karakter" required>
      </div>
      <div class="fg">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-or">Reset Password</button>
    </form>
  </div>
</div>
@endsection