@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')

@section('content')

<style>
    .edit-profile-wrap {
        max-width: 600px;
        margin: 0 auto;
    }

    .edit-profile-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 16px rgba(245,158,11,0.08);
        overflow: hidden;
    }

    .edit-card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #FEF3C7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .edit-card-title {
        font-size: 15px;
        font-weight: 700;
        color: #1C1917;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .edit-card-title i { font-size: 18px; color: #D97706; }

    .btn-back {
        background: #FFFBEB;
        color: #92400E;
        border: 1px solid #FDE68A;
        padding: 7px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        transition: all 0.15s;
        flex-shrink: 0;
    }

    .btn-back:hover {
        background: #FEF3C7;
        border-color: #FCD34D;
        color: #78350F;
        text-decoration: none;
    }

    .edit-card-body { padding: 1.5rem; }

    /* AVATAR */
    .avatar-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #FEF3C7;
    }

    .avatar-container {
        position: relative;
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
    }

    .avatar-display {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        border: 4px solid #FDE68A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #fff;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(0,0,0,0.12);
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
        width: 30px;
        height: 30px;
        background: #F59E0B;
        border-radius: 50%;
        border: 2px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        transition: background 0.15s;
    }

    .avatar-overlay:hover { background: #D97706; }
    .avatar-overlay i { font-size: 15px; color: #fff; }

    .change-photo-label {
        font-size: 13px;
        color: #D97706;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: none;
        border: none;
        padding: 0;
    }

    .change-photo-label:hover { color: #B45309; }

    /* FORM — stack vertikal di semua ukuran layar */
    .form-field {
        margin-bottom: 1rem;
    }

    .form-field-label {
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
        transition: border-color 0.15s;
        outline: none;
        box-sizing: border-box;
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
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        font-weight: 600;
        box-sizing: border-box;
    }

    .error-text {
        color: #EF4444;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .form-divider {
        border: none;
        border-top: 1px solid #FEF3C7;
        margin: 1.25rem 0;
    }

    /* TOMBOL */
    .btn-row {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 1.25rem;
    }

    .btn-submit-custom {
        width: 100%;
        background: #F59E0B;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        transition: background 0.15s;
    }

    .btn-submit-custom:hover { background: #D97706; }
    .btn-submit-custom i { font-size: 16px; }

    .btn-cancel-custom {
        width: 100%;
        background: #fff;
        color: #78716C;
        border: 1.5px solid #E7E5E4;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
    }

    .btn-cancel-custom:hover {
        background: #FAFAF9;
        color: #57534E;
        text-decoration: none;
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

                {{-- AVATAR --}}
                <div class="avatar-section">
                    <div class="avatar-container">
                        <div class="avatar-display" id="avatar-display">
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
                    <label for="foto_profil" class="change-photo-label">
                        <i class='bx bx-camera'></i> Ganti Foto
                    </label>
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
                        {{ $user->role === 'admin' ? 'Administrator' : 'Member' }}
                    </div>
                </div>

                <hr class="form-divider">

                <div class="btn-row">
                    <button type="submit" class="btn-submit-custom">
                        <i class='bx bx-save'></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.show') }}" class="btn-cancel-custom">Batal</a>
                </div>

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