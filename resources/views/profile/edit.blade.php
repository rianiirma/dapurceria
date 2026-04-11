@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')

@section('content')

<style>
    .edit-profile-wrap {
        max-width: 500px;
        margin: 0 auto;
    }

    .edit-profile-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 12px rgba(245,158,11,0.08);
        overflow: hidden;
    }

    .edit-card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #FEF3C7;
        background: #FFFBEB;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .edit-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #1C1917;
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 0;
    }

    .edit-card-title i { font-size: 17px; color: #D97706; }

    .btn-back {
        background: white;
        color: #92400E;
        border: 1px solid #FDE68A;
        padding: 6px 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        flex-shrink: 0;
        transition: all 0.15s;
    }

    .btn-back:hover {
        background: #FEF3C7;
        text-decoration: none;
        color: #78350F;
    }

    .edit-card-body { padding: 1.5rem; }

    /* AVATAR */
    .avatar-section {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #FEF3C7;
    }

    .avatar-container {
        position: relative;
        width: 72px;
        height: 72px;
        flex-shrink: 0;
    }

    .avatar-display {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        border: 3px solid #FDE68A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
        font-weight: 700;
        overflow: hidden;
    }

    .avatar-display img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .avatar-overlay {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 24px;
        height: 24px;
        background: #F59E0B;
        border-radius: 50%;
        border: 2px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s;
    }

    .avatar-overlay:hover { background: #D97706; }
    .avatar-overlay i { font-size: 12px; color: #fff; }

    .avatar-info { flex: 1; }

    .avatar-info-name {
        font-size: 15px;
        font-weight: 700;
        color: #1C1917;
        margin-bottom: 4px;
    }

    .change-photo-label {
        font-size: 12px;
        color: #D97706;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: none;
        border: none;
        padding: 0;
        transition: color 0.15s;
    }

    .change-photo-label:hover { color: #B45309; }

    /* FORM */
    .form-field { margin-bottom: 1rem; }

    .form-field-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #57534E;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
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

    .form-input-disabled {
        width: 100%;
        background: #FFFBEB;
        color: #92400E;
        border: 1.5px solid #FDE68A;
        border-radius: 8px;
        padding: 9px 13px;
        font-size: 14px;
        font-weight: 600;
        box-sizing: border-box;
        cursor: not-allowed;
    }

    .error-text {
        color: #EF4444;
        font-size: 11px;
        margin-top: 4px;
        display: block;
    }

    .form-divider {
        border: none;
        border-top: 1px solid #FEF3C7;
        margin: 1.25rem 0;
    }

    /* TOMBOL */
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
        gap: 6px;
        transition: opacity 0.15s;
        font-family: inherit;
        margin-bottom: 8px;
    }

    .btn-submit-custom:hover { opacity: 0.9; }

    .btn-cancel-custom {
        width: 100%;
        background: #fff;
        color: #78716C;
        border: 1.5px solid #E7E5E4;
        padding: 10px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
        font-family: inherit;
    }

    .btn-cancel-custom:hover {
        background: #FAFAF9;
        color: #57534E;
        text-decoration: none;
    }

    @media (max-width: 480px) {
        .edit-card-body { padding: 1.25rem; }
        .avatar-section { gap: 12px; }
    }
</style>

<div class="edit-profile-wrap">
    <div class="edit-profile-card">

        <div class="edit-card-header">
            <h3 class="edit-card-title">
                <i class='bx bx-user-circle'></i> Edit Profil
            </h3>
            <a href="{{ route('profile.show') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>

        <div class="edit-card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- AVATAR -- rata kiri, info nama di kanan avatar --}}
                <div class="avatar-section">
                    <div class="avatar-container">
                        <div class="avatar-display">
                            @if($user->foto_profil)
                                <img id="preview" src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil">
                            @else
                                <span id="preview-initial">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                <img id="preview" src="" style="display:none; width:100%; height:100%; object-fit:cover; border-radius:50%;">
                            @endif
                        </div>
                        <label for="foto_profil" class="avatar-overlay" title="Ganti foto">
                            <i class='bx bx-camera'></i>
                        </label>
                    </div>
                    <div class="avatar-info">
                        <div class="avatar-info-name">{{ $user->name }}</div>
                        <label for="foto_profil" class="change-photo-label">
                            <i class='bx bx-camera'></i> Ganti Foto Profil
                        </label>
                    </div>
                    <input type="file" id="foto_profil" name="foto_profil" accept="image/*"
                           style="display:none;" onchange="previewFoto(this)">
                </div>

                {{-- NAMA --}}
                <div class="form-field">
                    <label class="form-field-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input-custom"
                        value="{{ old('name', $user->name) }}" required
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-field">
                    <label class="form-field-label">Email</label>
                    <input type="email" name="email" class="form-input-custom"
                        value="{{ old('email', $user->email) }}" required
                        placeholder="Masukkan email">
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="form-field">
                    <label class="form-field-label">Role</label>
                    <div class="form-input-disabled">
                        {{ $user->role === 'admin' ? '👑 Administrator' : '✓ Member' }}
                    </div>
                </div>

                <hr class="form-divider">

                <button type="submit" class="btn-submit-custom">
                    <i class='bx bx-save'></i> Simpan Perubahan
                </button>
                <a href="{{ route('profile.show') }}" class="btn-cancel-custom">Batal</a>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            const initial = document.getElementById('preview-initial');
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (initial) initial.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush