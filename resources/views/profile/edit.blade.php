@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Edit Profil - DapurCeria')
@section('page-title', 'Edit Profil')

@section('content')

<style>
    .edit-profile-wrap {
        max-width: 600px;
        margin: 0 auto;
        padding-bottom: 2rem;
    }

    /* ── KARTU FORM UTAMA ── */
    .edit-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 12px rgba(245,158,11,0.08);
        overflow: hidden;
    }

    .edit-card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #FEF3C7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #FFFBEB;
    }

    .edit-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #1C1917;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .edit-card-title i {
        font-size: 18px;
        color: #D97706;
    }

    .btn-back {
        font-size: 12px;
        font-weight: 600;
        color: #92400E;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .btn-back:hover { text-decoration: underline; }

    .edit-card-body {
        padding: 1.5rem;
    }

    /* ── UPLOAD FOTO ── */
    .upload-photo-section {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #FEF3C7;
    }

    .photo-preview-wrap {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #F3F4F6;
        border: 3px solid #FDE68A;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .photo-preview-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview-wrap .inisial {
        font-size: 2rem;
        font-weight: 700;
        color: #A8A29E;
    }

    .upload-controls {
        flex: 1;
    }

    .btn-choose-file {
        display: inline-block;
        padding: 8px 16px;
        background: #FFFBEB;
        color: #92400E;
        border: 1.5px solid #FDE68A;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-choose-file:hover {
        background: #FDE68A;
        border-color: #FBBF24;
    }

    /* Input file disembunyikan, di-trigger via label */
    .input-file-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        border: 0;
    }

    .upload-help-text {
        display: block;
        font-size: 11px;
        color: #78716C;
        margin-top: 6px;
    }

    /* ── FORM INPUT ── */
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
        padding: 10px 14px;
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

    /* ── TOMBOL AKSI ── */
    .edit-action-bar {
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #FEF3C7;
        display: flex;
        justify-content: flex-end;
    }

    .btn-submit-custom {
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: opacity 0.15s;
        font-family: inherit;
    }

    .btn-submit-custom:hover { opacity: 0.9; }

    /* Responsive */
    @media (max-width: 480px) {
        .edit-card-body { padding: 1rem; }
        .upload-photo-section { gap: 14px; }
        .photo-preview-wrap { width: 64px; height: 64px; font-size: 1.5rem; }
    }
</style>

<div class="edit-profile-wrap">

    <div class="edit-card">
        <div class="edit-card-header">
            <h3 class="edit-card-title">
                <i class='bx bx-user-circle'></i> Perbarui Informasi Profil
            </h3>
            <a href="{{ route('profile.show') }}" class="btn-back">
                <i class='bx bx-chevron-left'></i> Batal
            </a>
        </div>

        <div class="edit-card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- SEKSI UPLOAD FOTO --}}
                <div class="upload-photo-section">
                    <div class="photo-preview-wrap" id="photoPreview">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Pratinjau Foto" class="image-preview">
                        @else
                            <span class="inisial">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        @endif
                    </div>
                    <div class="upload-controls">
                        <label for="foto_profil" class="btn-choose-file">
                            <i class='bx bx-image-add'></i> Pilih Foto Baru
                        </label>
                        <input type="file" name="foto_profil" id="foto_profil" class="input-file-hidden" accept="image/jpeg,image/png,image/jpg">
                        <span class="upload-help-text">JPG, PNG, atau JPEG. Maksimal 2MB.</span>
                        @error('foto_profil') <span style="color:#EF4444; font-size:11px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- FORM INPUT NAMA --}}
                <div class="form-group-custom">
                    <label class="form-label-custom" for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-input-custom" value="{{ old('name', $user->name) }}" required>
                    @error('name') <span style="color:#EF4444; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                {{-- FORM INPUT EMAIL --}}
                <div class="form-group-custom">
                    <label class="form-label-custom" for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-input-custom" value="{{ old('email', $user->email) }}" required>
                    @error('email') <span style="color:#EF4444; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="edit-action-bar">
                    <button type="submit" class="btn-submit-custom">
                        <i class='bx bx-check-double'></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

{{-- SCRIPT UNTUK PREVIEW FOTO INSTAN --}}
<script>
    document.getElementById('foto_profil').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();
        const previewWrap = document.getElementById('photoPreview');

        if (file) {
            reader.onload = function(event) {
                // Hapus konten lama (inisial atau img lama)
                previewWrap.innerHTML = '';
                
                // Buat elemen img baru
                const img = document.createElement('img');
                img.setAttribute('src', event.target.result);
                img.setAttribute('alt', 'Pratinjau Foto');
                img.setAttribute('class', 'image-preview');
                
                // Tambahkan ke wrap
                previewWrap.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection