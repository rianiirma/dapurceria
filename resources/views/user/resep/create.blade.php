@extends('layouts.app')
@section('title', 'Upload Resep - DapurCeria')

@push('styles')
<style>
    body { background: #FDF6EC; }

    .form-page {
        max-width: 680px;
        margin: 0 auto;
        padding: 32px 20px 60px;
    }

    /* ── PAGE HEADER ── */
    .form-page-header {
        background: #3D2010;
        border-radius: 20px;
        padding: 28px 28px 24px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .form-page-header::before {
        content: '';
        position: absolute;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(232,98,26,.2);
        top: -60px; right: -40px;
    }

    .form-page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        color: #fff;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .form-page-header p {
        font-size: 13px;
        color: rgba(255,255,255,.55);
        position: relative;
        z-index: 1;
    }

    /* approval notice */
    .notice-box {
        background: #FDE8D0;
        border-radius: 14px;
        padding: 12px 16px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 24px;
        font-size: 12px;
        color: #7A3D1A;
        line-height: 1.6;
    }

    .notice-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }

    /* ── CARD ── */
    .form-card {
        background: #FFFBF5;
        border-radius: 20px;
        border: 1px solid #EDE3D8;
        padding: 24px 24px 28px;
        margin-bottom: 16px;
    }

    .form-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        color: #3D2010;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ── FIELD ── */
    .fg { margin-bottom: 16px; }

    .fg label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #7A3D1A;
        margin-bottom: 6px;
        letter-spacing: .2px;
    }

    .fg .required { color: #E8621A; }

    .fg input,
    .fg select,
    .fg textarea {
        width: 100%;
        padding: 11px 14px;
        background: #fff;
        border: 1.5px solid #E0D0C0;
        border-radius: 12px;
        font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #3D2010;
        outline: none;
        transition: border-color .2s;
    }

    .fg input:focus,
    .fg select:focus,
    .fg textarea:focus { border-color: #E8621A; background: #fff; }

    .fg input::placeholder,
    .fg textarea::placeholder { color: #C0A090; }

    .fg select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239A8070' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px; }

    .fg textarea { resize: vertical; min-height: 120px; line-height: 1.7; }

    .fg .help { font-size: 11px; color: #B09080; margin-top: 5px; line-height: 1.5; }

    .fg .err { font-size: 11px; color: #C62828; margin-top: 4px; display: flex; align-items: center; gap: 4px; }

    .fg input.is-invalid,
    .fg select.is-invalid,
    .fg textarea.is-invalid { border-color: #C62828; }

    /* 2 col grid */
    .fg-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    /* difficulty pills */
    .diff-pills { display: flex; gap: 8px; }

    .diff-pill {
        flex: 1;
        padding: 10px 8px;
        border-radius: 12px;
        border: 1.5px solid #E0D0C0;
        background: #fff;
        font-size: 12px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        text-align: center;
        transition: all .2s;
        color: #9A8070;
    }

    .diff-pill:hover { border-color: #E8621A; color: #E8621A; }
    .diff-pill.sel-mudah  { background: #D4F0E0; border-color: #2E7D32; color: #1A6B3A; }
    .diff-pill.sel-sedang { background: #FEF3C0; border-color: #B08010; color: #856404; }
    .diff-pill.sel-sulit  { background: #FDDEDE; border-color: #C62828; color: #8B1A1A; }

    /* image upload */
    .img-upload-area {
        border: 2px dashed #E0D0C0;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        position: relative;
        overflow: hidden;
    }

    .img-upload-area:hover { border-color: #E8621A; background: #FEF8F4; }

    .img-upload-area input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        border: none;
        padding: 0;
    }

    .img-upload-icon { font-size: 32px; margin-bottom: 8px; }
    .img-upload-text { font-size: 13px; font-weight: 600; color: #7A3D1A; margin-bottom: 4px; }
    .img-upload-hint { font-size: 11px; color: #B09080; }

    .img-preview-wrap { margin-top: 12px; display: none; }
    .img-preview { width: 100%; max-height: 200px; object-fit: cover; border-radius: 12px; }

    /* ── SUBMIT ── */
    .form-actions { display: flex; gap: 10px; }

    .btn-submit {
        flex: 1;
        padding: 14px;
        background: #E8621A;
        color: #fff;
        border: none;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .2s;
    }

    .btn-submit:hover { background: #C84E0E; }

    .btn-cancel {
        padding: 14px 24px;
        background: none;
        border: 1.5px solid #E0D0C0;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
        color: #9A8070;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all .2s;
    }

    .btn-cancel:hover { border-color: #7A3D1A; color: #7A3D1A; }

    @media (max-width: 480px) {
        .fg-row { grid-template-columns: 1fr; }
        .diff-pills { flex-wrap: wrap; }
    }
</style>
@endpush

@section('content')
<div class="form-page">

    <div class="form-page-header">
        <h1>📤 Upload Resep Baru</h1>
        <p>Bagikan resep masakan favoritmu ke komunitas DapurCeria!</p>
    </div>

    <div class="notice-box">
        <span class="notice-icon">ℹ</span>
        <span>Resep yang kamu upload akan <strong>ditinjau oleh admin</strong> sebelum tampil di beranda. Proses persetujuan biasanya 1–2 hari kerja.</span>
    </div>

    @if($errors->any())
        <div style="background:#FDDEDE;border:1px solid #F5B7B1;border-radius:14px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#8B1A1A;">
            @foreach($errors->all() as $e)
                <div>⚠ {{ $e }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('user.resep.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- INFO DASAR --}}
        <div class="form-card">
            <div class="form-card-title">🍳 Informasi Dasar</div>

            <div class="fg">
                <label>Judul Resep <span class="required">*</span></label>
                <input type="text" name="judul" placeholder="cth: Rendang Sapi Padang Asli"
                       value="{{ old('judul') }}" required
                       class="{{ $errors->has('judul') ? 'is-invalid' : '' }}">
                @error('judul')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="fg">
                <label>Kategori <span class="required">*</span></label>
                <select name="id_kategori" required class="{{ $errors->has('id_kategori') ? 'is-invalid' : '' }}">
                    <option value="">Pilih kategori...</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ old('id_kategori') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="fg">
                <label>Deskripsi <span class="required">*</span></label>
                <textarea name="deskripsi" placeholder="Ceritakan sedikit tentang resep ini..." required
                          class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>
        </div>

        {{-- FOTO & VIDEO --}}
        <div class="form-card">
            <div class="form-card-title">📷 Foto & Video</div>

            <div class="fg">
                <label>Foto Resep</label>
                <div class="img-upload-area" id="uploadArea">
                    <input type="file" name="gambar" accept="image/*" id="gambarInput"
                           onchange="previewImage(this)">
                    <div class="img-upload-icon">📷</div>
                    <div class="img-upload-text">Ketuk untuk pilih foto</div>
                    <div class="img-upload-hint">JPG, PNG — maks 2MB</div>
                </div>
                <div class="img-preview-wrap" id="previewWrap">
                    <img id="imgPreview" class="img-preview" src="" alt="Preview">
                </div>
                @error('gambar')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="fg">
                <label>URL Video YouTube (opsional)</label>
                <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=..."
                       value="{{ old('video_url') }}"
                       class="{{ $errors->has('video_url') ? 'is-invalid' : '' }}">
                <div class="help">Link video tutorial YouTube untuk resep ini</div>
                @error('video_url')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>
        </div>

        {{-- BAHAN & LANGKAH --}}
        <div class="form-card">
            <div class="form-card-title">🛒 Bahan & Langkah</div>

            <div class="fg">
                <label>Bahan-bahan <span class="required">*</span></label>
                <textarea name="bahan" placeholder="Tulis satu bahan per baris, contoh:&#10;- 500gr daging sapi&#10;- 400ml santan kental&#10;- 5 siung bawang merah" required
                          style="min-height:140px;"
                          class="{{ $errors->has('bahan') ? 'is-invalid' : '' }}">{{ old('bahan') }}</textarea>
                <div class="help">Tulis satu bahan per baris</div>
                @error('bahan')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="fg">
                <label>Langkah Memasak <span class="required">*</span></label>
                <textarea name="langkah_langkah" placeholder="Tulis langkah-langkah, contoh:&#10;1. Haluskan semua bumbu&#10;2. Tumis bumbu hingga harum&#10;3. Masukkan daging..." required
                          style="min-height:160px;"
                          class="{{ $errors->has('langkah_langkah') ? 'is-invalid' : '' }}">{{ old('langkah_langkah') }}</textarea>
                <div class="help">Tulis setiap langkah dengan nomor urut</div>
                @error('langkah_langkah')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>
        </div>

        {{-- DETAIL MASAK --}}
        <div class="form-card">
            <div class="form-card-title">⏱ Detail Memasak</div>

            <div class="fg-row">
                <div class="fg">
                    <label>Waktu Memasak (menit) <span class="required">*</span></label>
                    <input type="number" name="waktu_memasak" placeholder="cth: 45"
                           value="{{ old('waktu_memasak') }}" min="1" required
                           class="{{ $errors->has('waktu_memasak') ? 'is-invalid' : '' }}">
                    @error('waktu_memasak')<div class="err">⚠ {{ $message }}</div>@enderror
                </div>
                <div class="fg">
                    <label>Porsi <span class="required">*</span></label>
                    <input type="number" name="porsi" placeholder="cth: 4"
                           value="{{ old('porsi') }}" min="1" required
                           class="{{ $errors->has('porsi') ? 'is-invalid' : '' }}">
                    @error('porsi')<div class="err">⚠ {{ $message }}</div>@enderror
                </div>
            </div>

            <div class="fg">
                <label>Tingkat Kesulitan <span class="required">*</span></label>
                <input type="hidden" name="tingkat_kesulitan" id="diffInput" value="{{ old('tingkat_kesulitan') }}">
                <div class="diff-pills">
                    <button type="button" class="diff-pill {{ old('tingkat_kesulitan') == 'mudah' ? 'sel-mudah' : '' }}"
                            onclick="pickDiff('mudah')">✓ Mudah</button>
                    <button type="button" class="diff-pill {{ old('tingkat_kesulitan') == 'sedang' ? 'sel-sedang' : '' }}"
                            onclick="pickDiff('sedang')">~ Sedang</button>
                    <button type="button" class="diff-pill {{ old('tingkat_kesulitan') == 'sulit' ? 'sel-sulit' : '' }}"
                            onclick="pickDiff('sulit')">↑ Sulit</button>
                </div>
                @error('tingkat_kesulitan')<div class="err">⚠ {{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('home') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">Kirim untuk Ditinjau →</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const wrap = document.getElementById('previewWrap');
    const img  = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; wrap.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}

function pickDiff(val) {
    document.getElementById('diffInput').value = val;
    document.querySelectorAll('.diff-pill').forEach(p => {
        p.className = 'diff-pill';
    });
    event.target.classList.add('sel-' + val);
}
</script>
@endpush