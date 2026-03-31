@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')

@if(session('success'))
    <div style="background:#D1FAE5; border:1px solid #6EE7B7; color:#065F46; padding:12px 16px; border-radius:10px; font-size:14px; font-weight:600; margin-bottom:1.25rem; display:flex; align-items:center; gap:8px;">
        <i class='bx bx-check-circle' style="font-size:18px;"></i>
        {{ session('success') }}
    </div>
@endif

<style>
    .profile-page-wrap { max-width: 700px; margin: 0 auto; }

    /* PROFILE CARD */
    .profile-main-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 16px rgba(245,158,11,0.08);
        margin-bottom: 1.5rem;
    }
    .profile-banner {
        height: 110px;
        background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 50%, #FCD34D 100%);
        position: relative;
        overflow: hidden;
    }
    .profile-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.18) 1px, transparent 1px);
        background-size: 28px 28px;
    }
    .profile-body {
        padding: 0 2rem 2rem;
        position: relative;
    }
    .profile-avatar-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: -52px;
        margin-bottom: 14px;
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 14px rgba(0,0,0,0.13);
        object-fit: cover;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #fff;
        font-weight: 700;
        overflow: hidden;
        flex-shrink: 0;
    }
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .btn-edit-profile {
        background: #fff;
        color: #D97706;
        border: 1.5px solid #FBBF24;
        padding: 8px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s;
        margin-bottom: 4px;
    }
    .btn-edit-profile:hover {
        background: #FFFBEB;
        border-color: #F59E0B;
        color: #B45309;
        text-decoration: none;
    }
    .profile-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1C1917;
        margin: 0 0 4px;
    }
    .profile-email {
        font-size: 14px;
        color: #78716C;
        margin: 0 0 8px;
    }
    .profile-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-admin {
        background: #FEF3C7;
        color: #92400E;
        border: 1px solid #FCD34D;
    }
    .badge-member {
        background: #D1FAE5;
        color: #065F46;
        border: 1px solid #6EE7B7;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 1.5rem;
    }
    .stat-item {
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        border-radius: 12px;
        padding: 14px 16px;
    }
    .stat-item-label {
        font-size: 11px;
        font-weight: 700;
        color: #92400E;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 5px;
    }
    .stat-item-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1C1917;
    }

    /* PASSWORD CARD */
    .password-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 16px rgba(245,158,11,0.06);
        overflow: hidden;
    }
    .password-card-header {
        padding: 1.25rem 2rem;
        border-bottom: 1px solid #FEF3C7;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: #1C1917;
    }
    .password-card-header i {
        font-size: 18px;
        color: #D97706;
    }
    .password-card-body {
        padding: 1.5rem 2rem;
    }
    .form-group-custom {
        margin-bottom: 1rem;
    }
    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #57534E;
        margin-bottom: 6px;
    }
    .form-input-custom {
        width: 100%;
        border: 1.5px solid #E7E5E4;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        color: #1C1917;
        background: #FAFAF9;
        transition: border-color 0.15s, background 0.15s;
        outline: none;
        box-sizing: border-box;
    }
    .form-input-custom:focus {
        border-color: #F59E0B;
        background: #fff;
    }
    .form-input-custom::placeholder {
        color: #A8A29E;
    }
    .error-text {
        color: #EF4444;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }
    .btn-submit-custom {
        background: #F59E0B;
        color: #fff;
        border: none;
        padding: 11px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 0.5rem;
        transition: background 0.15s;
    }
    .btn-submit-custom:hover {
        background: #D97706;
    }
    .btn-submit-custom i {
        font-size: 16px;
    }
</style>

<div class="profile-page-wrap">

    {{-- KARTU PROFIL --}}
    <div class="profile-main-card">
        <div class="profile-banner"></div>
        <div class="profile-body">
            <div class="profile-avatar-row">
                <div class="profile-avatar">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <a href="{{ route('profile.edit') }}" class="btn-edit-profile">
                    <i class='bx bx-edit-alt'></i> Edit Profil
                </a>
            </div>

            <h2 class="profile-name">{{ $user->name }}</h2>
            <p class="profile-email">{{ $user->email }}</p>
            <span class="profile-badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-member' }}">
                {{ $user->role === 'admin' ? 'Administrator' : 'Member' }}
            </span>

            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-item-label">Bergabung Sejak</div>
                    <div class="stat-item-value">{{ $user->created_at->format('d F Y') }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-item-label">Total Resep</div>
                    <div class="stat-item-value">{{ $user->reseps()->count() }} resep</div>
                </div>
            </div>
        </div>
    </div>

    {{-- UBAH PASSWORD --}}
    <div class="password-card">
        <div class="password-card-header">
            <i class='bx bx-lock-alt'></i> Ubah Password
        </div>
        <div class="password-card-body">
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group-custom">
                    <label class="form-label-custom">Password Lama</label>
                    <input type="password" name="password_lama" class="form-input-custom"
                        placeholder="Masukkan password lama">
                    @error('password_lama')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Password Baru</label>
                    <input type="password" name="password_baru" class="form-input-custom"
                        placeholder="Minimal 8 karakter">
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation" class="form-input-custom"
                        placeholder="Ulangi password baru">
                    @error('password_baru')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit-custom">
                    <i class='bx bx-lock-open-alt'></i> Ubah Password
                </button>
            </form>
        </div>
    </div>

</div>

@endsection