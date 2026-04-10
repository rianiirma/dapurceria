@extends('layouts.app')
@section('title', 'Daftar - DapurCeria')

@push('styles')
<style>
    body {
        background: #FDF6EC;
    }

    /* ── PAGE ── */
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
        max-width: 460px;
        background: #FFFBF5;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #E8DDD0;
        box-shadow: 0 4px 32px rgba(61,32,16,.07);
    }

    /* ── BANNER ── */
    .auth-banner {
        background: #3D2010;
        padding: 28px 32px 48px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

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
        font-size: 20px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .auth-banner-logo-dot {
        width: 8px; height: 8px;
        background: #F9946A;
        border-radius: 50%;
    }

    /* step indicator */
    .step-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        position: relative;
        z-index: 1;
        margin-bottom: 14px;
    }

    .step-dot {
        width: 26px; height: 26px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700;
        background: rgba(255,255,255,.18);
        color: rgba(255,255,255,.6);
    }

    .step-dot.active {
        background: #E8621A;
        color: #fff;
        box-shadow: 0 0 0 4px rgba(232,98,26,.3);
    }

    .step-line {
        width: 28px; height: 2px;
        background: rgba(255,255,255,.2);
    }

    .auth-banner h2 {
        font-family: 'Playfair Display', serif;
        font-size: 21px;
        color: #fff;
        margin: 0 0 5px;
        position: relative;
        z-index: 1;
    }

    .auth-banner p {
        font-size: 12px;
        color: rgba(255,255,255,.55);
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .auth-banner-curve {
        position: absolute;
        bottom: -1px; left: 0; right: 0;
        height: 36px;
        background: #FFFBF5;
        border-radius: 28px 28px 0 0;
    }

    /* ── AVATAR PICKER ── */
    .avatar-section {
        padding: 28px 32px 0;
    }

    .avatar-label {
        font-size: 12px;
        font-weight: 600;
        color: #7A3D1A;
        margin-bottom: 10px;
        display: block;
    }

    .avatar-row {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 4px;
    }

    .av-opt {
        width: 48px; height: 48px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all .2s;
        flex-shrink: 0;
    }

    .av-opt:hover { transform: scale(1.08); }

    .av-opt.sel {
        border-color: #E8621A;
        box-shadow: 0 0 0 3px rgba(232,98,26,.2);
    }

    .av-a { background: linear-gradient(135deg,#FFB870,#E05010); }
    .av-b { background: linear-gradient(135deg,#8AAB7A,#3A6A30); }
    .av-c { background: linear-gradient(135deg,#C070D0,#8030A0); }
    .av-d { background: linear-gradient(135deg,#60A0E0,#2060B0); }
    .av-e { background: linear-gradient(135deg,#F0D040,#C09010); }

    /* ── BODY ── */
    .auth-body {
        padding: 16px 32px 36px;
    }

    /* ── ALERT ── */
    .auth-alert-error {
        background: #FDDEDE;
        border: 1px solid #F5B7B1;
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 16px;
        font-size: 13px;
        color: #8B1A1A;
    }

    .auth-alert-error div + div {
        margin-top: 4px;
    }

    /* ── FIELDS ── */
    .fg {
        margin-bottom: 13px;
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
        font-size: 14px;
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

    .fg-input-wrap input.is-invalid {
        border-color: #C62828;
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

    .fg-input-wrap input.has-eye { padding-right: 40px; }

    /* strength bar */
    .strength-row {
        display: flex;
        gap: 4px;
        margin-top: 6px;
    }

    .strength-seg {
        flex: 1;
        height: 3px;
        border-radius: 2px;
        background: #E0D0C0;
        transition: background .3s;
    }

    .strength-seg.s1 { background: #C62828; }
    .strength-seg.s2 { background: #B08010; }
    .strength-seg.s3 { background: #2E7D32; }
    .strength-seg.s4 { background: #1A6B3A; }

    .strength-lbl {
        font-size: 10px;
        color: #9A8070;
        margin-top: 3px;
    }

    /* 2-col grid */
    .form-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    /* ── TERMS ── */
    .terms-row {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        margin-bottom: 18px;
    }

    .terms-row input[type="checkbox"] {
        width: 15px; height: 15px;
        accent-color: #E8621A;
        margin-top: 2px;
        flex-shrink: 0;
        cursor: pointer;
    }

    .terms-row span {
        font-size: 12px;
        color: #9A8070;
        line-height: 1.5;
    }

    .terms-row a {
        color: #E8621A;
        font-weight: 600;
        text-decoration: none;
    }

    /* ── SUBMIT ── */
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

    /* ── SWITCH ── */
    .auth-switch {
        text-align: center;
        margin-top: 18px;
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
    @media (max-width: 480px) {
        .auth-body, .avatar-section { padding-left: 20px; padding-right: 20px; }
        .auth-banner { padding-left: 20px; padding-right: 20px; }
        .form-2col { grid-template-columns: 1fr; }
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

            {{-- Step indicator --}}
            <div class="step-row">
                <div class="step-dot active">1</div>
                <div class="step-line"></div>
                <div class="step-dot">2</div>
                <div class="step-line"></div>
                <div class="step-dot">3</div>
            </div>

            <h2>Buat Akun Baru</h2>
            <p>Bergabung bersama ribuan chef rumahan Indonesia 👨‍🍳</p>
            <div class="auth-banner-curve"></div>
        </div>

        {{-- ── AVATAR PICKER ── --}}
        <div class="avatar-section">
            <span class="avatar-label">Pilih avatar kamu</span>
            <div class="avatar-row">
                <div class="av-opt av-a sel" onclick="pickAvatar(this, 'chef')">🍳</div>
                <div class="av-opt av-b"     onclick="pickAvatar(this, 'herb')">🌿</div>
                <div class="av-opt av-c"     onclick="pickAvatar(this, 'cake')">🧁</div>
                <div class="av-opt av-d"     onclick="pickAvatar(this, 'noodle')">🍜</div>
                <div class="av-opt av-e"     onclick="pickAvatar(this, 'star')">⭐</div>
            </div>
            <input type="hidden" name="avatar" id="avatarInput" value="chef">
        </div>

        {{-- ── BODY ── --}}
        <div class="auth-body">

            {{-- Errors --}}
            @if ($errors->any())
                <div class="auth-alert-error">
                    @foreach ($errors->all() as $e)
                        <div>⚠ {{ $e }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                {{-- hidden avatar field inside form --}}
                <input type="hidden" name="avatar" id="avatarField" value="chef">

                {{-- Nama --}}
                <div class="fg">
                    <label for="name">Nama</label>
                    <div class="fg-input-wrap">
                        <span class="fi-icon">👤</span>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            placeholder="cth: Chef Siti"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                        >
                    </div>
                </div>

                {{-- Username --}}
                <div class="fg">
                    <label for="username">Username</label>
                    <div class="fg-input-wrap">
                        <span class="fi-icon">@</span>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            placeholder="username_kamu"
                            value="{{ old('username') }}"
                            required
                            autocomplete="username"
                            class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
                        >
                    </div>
                </div>

                {{-- Email --}}
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
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        >
                    </div>
                </div>

                {{-- Password & Konfirmasi --}}
                <div class="form-2col">
                    <div class="fg">
                        <label for="password">Password</label>
                        <div class="fg-input-wrap">
                            <span class="fi-icon"></span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="min. 8 karakter"
                                required
                                autocomplete="new-password"
                                class="has-eye {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                oninput="checkStrength(this.value)"
                            >
                            <button type="button" class="fi-eye" onclick="togglePw('password', this)">👁</button>
                        </div>
                        <div class="strength-row">
                            <div class="strength-seg" id="seg1"></div>
                            <div class="strength-seg" id="seg2"></div>
                            <div class="strength-seg" id="seg3"></div>
                            <div class="strength-seg" id="seg4"></div>
                        </div>
                        <div class="strength-lbl" id="strengthLbl"></div>
                    </div>

                    <div class="fg">
                        <label for="password_confirmation">Konfirmasi</label>
                        <div class="fg-input-wrap">
                            <span class="fi-icon"></span>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                                class="has-eye"
                            >
                            <button type="button" class="fi-eye" onclick="togglePw('password_confirmation', this)">👁</button>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="terms-row">
                    <input type="checkbox" id="terms" required>
                    <span>
                        Saya menyetujui <a href="#">Syarat &amp; Ketentuan</a>
                        dan <a href="#">Kebijakan Privasi</a> DapurCeria
                    </span>
                </div>

                <button type="submit" class="btn-submit">Daftar Sekarang →</button>
            </form>

            <div class="auth-switch">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>

        </div>{{-- /auth-body --}}
    </div>{{-- /auth-card --}}
</div>
@endsection

@push('scripts')
<script>
    /* avatar picker */
    function pickAvatar(el, val) {
        document.querySelectorAll('.av-opt').forEach(a => a.classList.remove('sel'));
        el.classList.add('sel');
        document.getElementById('avatarField').value = val;
    }

    /* password toggle */
    function togglePw(id, btn) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁';
        }
    }

    /* password strength */
    function checkStrength(val) {
        const segs = ['seg1','seg2','seg3','seg4'].map(id => document.getElementById(id));
        const lbl  = document.getElementById('strengthLbl');
        segs.forEach(s => s.className = 'strength-seg');

        if (!val) { lbl.textContent = ''; return; }

        let score = 0;
        if (val.length >= 8)            score++;
        if (/[A-Z]/.test(val))          score++;
        if (/[0-9]/.test(val))          score++;
        if (/[^A-Za-z0-9]/.test(val))   score++;

        const cls    = ['s1','s2','s3','s4'];
        const labels = ['Sangat lemah','Lemah','Cukup kuat','Kuat sekali'];
        for (let i = 0; i < score; i++) segs[i].classList.add(cls[score - 1]);
        lbl.textContent = labels[score - 1] || '';
    }
</script>
@endpush