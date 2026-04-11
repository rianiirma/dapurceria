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
    .profile-page-wrap {
        max-width: 640px;
        margin: 0 auto;
    }

    /* ── KARTU PROFIL ── */
    .profile-main-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 12px rgba(245,158,11,0.08);
        margin-bottom: 1.25rem;
    }

    /* Baris atas: avatar kiri + info kanan */
    .profile-top {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 1.5rem;
        background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 60%, #FCD34D 100%);
        position: relative;
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        border: 3px solid rgba(255,255,255,0.8);
        background: rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #fff;
        font-weight: 700;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-top-info {
        flex: 1;
        min-width: 0;
    }

    .profile-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 2px;
        word-break: break-word;
        text-shadow: 0 1px 3px rgba(0,0,0,0.15);
    }

    .profile-email {
        font-size: 13px;
        color: rgba(255,255,255,0.85);
        margin: 0 0 8px;
        word-break: break-all;
    }

    .profile-badge {
        display: inline-block;
        padding: 2px 12px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
    }

    .badge-admin {
        background: rgba(255,255,255,0.25);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.4);
    }

    .badge-member {
        background: rgba(255,255,255,0.25);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.4);
    }

    .btn-edit-profile {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255,255,255,0.9);
        color: #D97706;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .btn-edit-profile:hover {
        background: #fff;
        color: #B45309;
        text-decoration: none;
    }

    /* Stats */
    .profile-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: #FDE68A;
        border-top: 1px solid #FDE68A;
    }

    .stat-item {
        background: #FFFBEB;
        padding: 14px 20px;
    }

    .stat-item:first-child {
        border-right: 1px solid #FDE68A;
    }

    .stat-item-label {
        font-size: 10px;
        font-weight: 700;
        color: #92400E;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 4px;
    }

    .stat-item-value {
        font-size: 15px;
        font-weight: 700;
        color: #1C1917;
    }

    /* ── KARTU PASSWORD ── */
    .password-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 12px rgba(245,158,11,0.06);
        overflow: hidden;
    }

    .password-card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #FEF3C7;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #1C1917;
        background: #FFFBEB;
    }

    .password-card-header i {
        font-size: 17px;
        color: #D97706;
    }

    .password-card-body {
        padding: 1.25rem 1.5rem;
    }

    .form-group-custom { margin-bottom: 1rem; }

    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #57534E;
        margin-bottom: 5px;
    }

    .form-input-custom {
        width: 100%;
        border: 1.5px solid #E7E5E4;
        border-radius: 8px;
        padding: 9px 13px;
        font-size: 14px;
        color: #1C1917;
        background: #FAFAF9;
        transition: border-color 0.15s;
        outline: none;
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-input-custom:focus {
        border-color: #F59E0B;
        background: #fff;
    }

    .form-input-custom::placeholder { color: #A8A29E; }

    .error-text {
        color: #EF4444;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .btn-submit-custom {
        width: 100%;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        color: #fff;
        border: none;
        padding: 11px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin-top: 0.5rem;
        transition: opacity 0.15s;
        font-family: inherit;
    }

    .btn-submit-custom:hover { opacity: 0.9; }

    /* Responsive mobile */
    @media (max-width: 480px) {
        .profile-top {
            padding: 1.25rem;
            gap: 14px;
        }
        .profile-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.25rem;
        }
        .profile-name { font-size: 1.1rem; }
        .btn-edit-profile {
            top: 0.75rem;
            right: 0.75rem;
            padding: 5px 10px;
            font-size: 11px;
        }
        .stat-item { padding: 12px 16px; }
        .password-card-body { padding: 1rem; }
    }
</style>

<div class="profile-page-wrap">

    {{-- KARTU PROFIL --}}
    <div class="profile-main-card">

        {{-- Baris atas: avatar + info --}}
        <div class="profile-top">
            <div class="profile-avatar">
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil">
                @else
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                @endif
            </div>
            <div class="profile-top-info">
                <h2 class="profile-name">{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
                <span class="profile-badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-member' }}">
                    {{ $user->role === 'admin' ? '👑 Administrator' : '✓ Member' }}
                </span>
            </div>
            <a href="{{ route('profile.edit') }}" class="btn-edit-profile">
                <i class='bx bx-edit-alt'></i> Edit Profil
            </a>
        </div>

        {{-- Stats --}}
        <div class="profile-stats">
            <div class="stat-item">
                <div class="stat-item-label">Bergabung Sejak</div>
                <div class="stat-item-value">{{ $user->created_at->translatedFormat('d F Y') }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-item-label">Total Resep</div>
                <div class="stat-item-value">{{ $user->reseps()->count() }} resep</div>
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
                    @error('password_baru')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation" class="form-input-custom"
                        placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn-submit-custom">
                    <i class='bx bx-lock-open-alt'></i> Ubah Password
                </button>
            </form>
        </div>
    </div>

</div>
@endsection