@extends('layouts.app')
@section('title', 'Masuk - DapurCeria')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    * { box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #FDF6EC;
        margin: 0;
    }

    /* ── PAGE WRAPPER ── */
    .auth-page {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 16px 48px;
    }

    /* ── CARD ── */
    .auth-card {
        width: 100%;
        max-width: 420px;
        background: #FFFBF5;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #E8DDD0;
        box-shadow: 0 4px 32px rgba(61,32,16,.07);
    }

    /* ── TOP BANNER ── */
    .auth-banner {
        background: #3D2010;
        padding: 32px 32px 52px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* round decorative blobs */
    .auth-banner::before {
        content: '';
        position: absolute;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(232,98,26,.25);
        top: -50px; left: -50px;
    }
    .auth-banner::after {
        content: '';
        position: absolute;
        width: 120px; height: 120px;
        border-radius: 50%;
        background: rgba(232,98,26,.15);
        bottom: -30px; right: -20px;
    }

    .auth-banner-logo {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 18px;
        position: relative;
        z-index: 1;
    }

    .auth-banner-logo-dot {
        width: 9px; height: 9px;
        background: #F9946A;
        border-radius: 50%;
    }

    .auth-banner-emoji {
        font-size: 52px;
        display: block;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }

    .auth-banner h2 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        color: #fff;
        margin: 0 0 6px;
        position: relative;
        z-index: 1;
    }

    .auth-banner p {
        font-size: 13px;
        color: rgba(255,255,255,.55);
        line-height: 1.6;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    /* curved bottom edge of banner */
    .auth-banner-curve {
        position: absolute;
        bottom: -1px; left: 0; right: 0;
        height: 40px;
        background: #FFFBF5;
        border-radius: 32px 32px 0 0;
    }

    /* ── BODY ── */
    .auth-body {
        padding: 32px 32px 36px;
    }

    /* ── ALERT ── */
    .auth-alert-error {
        background: #FDDEDE;
        border: 1px solid #F5B7B1;
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 18px;
        font-size: 13px;
        color: #8B1A1A;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .auth-alert-success {
        background: #D4F0E0;
        border: 1px solid #A9DFBF;
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 18px;
        font-size: 13px;
        color: #1A6B3A;
    }

    /* ── SOCIAL BTNS ── */
    .social-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 18px;
    }

    .btn-social {
        padding: 10px 8px;
        background: #fff;
        border: 1.5px solid #E0D0C0;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        font-family: inherit;
        color: #3D2010;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .15s;
    }

    .btn-social:hover { background: #FEF0E6; }
    .btn-social:disabled { opacity: .45; cursor: not-allowed; }

    .s-icon {
        width: 18px; height: 18px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700;
        flex-shrink: 0;
    }

    .s-google { background: #EA4335; color: #fff; }
    .s-fb     { background: #1877F2; color: #fff; }

    /* ── DIVIDER ── */
    .auth-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 18px;
        font-size: 12px;
        color: #9A8070;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E0D0C0;
    }

    /* ── FORM FIELDS ── */
    .fg {
        margin-bottom: 14px;
    }

    .fg label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #7A3D1A;
        margin-bottom: 5px;
    }

    .fg-input-wrap {
        position: relative;
    }

    .fg-input-wrap .fi-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 15px;
        pointer-events: none;
        line-height: 1;
    }

    .fg-input-wrap input {
        width: 100%;
        padding: 11px 14px 11px 40px;
        background: #fff;
        border: 1.5px solid #E0D0C0;
        border-radius: 12px;
        font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #3D2010;
        outline: none;
        transition: border-color .2s;
    }

    .fg-input-wrap input:focus {
        border-color: #E8621A;
    }

    .fg-input-wrap input::placeholder {
        color: #C0A090;
    }

    /* eye toggle */
    .fi-eye {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 14px;
        color: #9A8070;
        background: none;
        border: none;
        padding: 0;
        line-height: 1;
    }

    /* ── ROW: ingat saya + lupa password ── */
    .auth-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .auth-remember {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #9A8070;
        cursor: pointer;
    }

    .auth-remember input[type="checkbox"] {
        width: 15px;
        height: 15px;
        accent-color: #E8621A;
        margin: 0;
        cursor: pointer;
    }

    .auth-forgot {
        font-size: 12px;
        font-weight: 600;
        color: #E8621A;
        text-decoration: none;
    }

    .auth-forgot:hover { text-decoration: underline; }

    /* ── SUBMIT BTN ── */
    .btn-submit {
        width: 100%;
        padding: 13px;
        background: #E8621A;
        color: #fff;
        border: none;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        letter-spacing: .3px;
        transition: background .2s, transform .1s;
        margin-bottom: 0;
    }

    .btn-submit:hover  { background: #C84E0E; }
    .btn-submit:active { transform: scale(.98); }

    /* ── SWITCH TEXT ── */
    .auth-switch {
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
        color: #9A8070;
    }

    .auth-switch a {
        color: #E8621A;
        font-weight: 700;
        text-decoration: none;
    }

    .auth-switch a:hover { text-decoration: underline; }

    /* ── RESPONSIVE ── */
    @media (max-width: 460px) {
        .auth-body  { padding: 28px 22px 30px; }
        .auth-banner { padding: 28px 22px 48px; }
        .social-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">

        {{-- ── BANNER ── --}}
        <div class="auth-banner">
            <div class="auth-banner-logo">
                <div class="auth-banner-logo-dot"></div>
                DapurCeria
            </div>
            <span class="auth-banner-emoji">🍳</span>
            <h2>Selamat Datang Kembali!</h2>
            <p>Masuk dan mulai berbagi resep lezatmu hari ini</p>
            <div class="auth-banner-curve"></div>
        </div>

        {{-- ── BODY ── --}}
        <div class="auth-body">

            {{-- Error --}}
            @if ($errors->any())
                <div class="auth-alert-error">
                    <span>⚠</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Success (e.g. setelah reset password) --}}
            @if (session('status'))
                <div class="auth-alert-success">
                    ✓ {{ session('status') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="fg">
                    <label for="email">Email</label>
                    <div class="fg-input-wrap">
                        <span class="fi-icon">✉</span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            placeholder="email@kamu.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                </div>

                <div class="fg">
                    <label for="password">Password</label>
                    <div class="fg-input-wrap">
                        <span class="fi-icon"></span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="fi-eye" onclick="togglePassword()" id="eyeBtn">👁</button>
                    </div>
                </div>

                <div class="auth-meta-row">
                    <label class="auth-remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a class="auth-forgot" href="{{ route('password.request') }}">Lupa password?</a>
                    @else
                        <a class="auth-forgot" href="#">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">Masuk Sekarang</button>
            </form>

            <div class="auth-switch">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar gratis &rsaquo;</a>
            </div>

        </div>{{-- /auth-body --}}
    </div>{{-- /auth-card --}}
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const btn   = document.getElementById('eyeBtn');
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁';
        }
    }
</script>
@endpush