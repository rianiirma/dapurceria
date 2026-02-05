@extends('layouts.app')

@section('title', 'Upload Resep - Dapur Ceria')

@section('styles')
<style>
    .form-container {
        max-width: 800px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-header {
        margin-bottom: 2rem;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 1rem;
    }
    .form-header h2 {
        color: #ff6b6b;
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
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }
    .error {
        color: #ff6b6b;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .help-text {
        font-size: 0.875rem;
        color: #666;
        margin-top: 0.25rem;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2><i class="bx bxs-book-bookmark"></i> Upload Resep Baru</h2>
        <p>Bagikan resep masakan favorit Anda dengan komunitas Dapur Ceria!</p>
    </div>

    <form action="{{ route('user.resep.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="judul">Judul Resep *</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
            @error('judul')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_kategori">Kategori *</label>
            <select name="id_kategori" id="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('id_kategori')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi *</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi') }}</textarea>
            <span class="help-text">Jelaskan secara singkat tentang resep ini</span>
            @error('deskripsi')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="bahan">Bahan-bahan *</label>
            <textarea name="bahan" id="bahan" class="form-control" required>{{ old('bahan') }}</textarea>
            <span class="help-text">Tulis satu bahan per baris. Contoh:<br>- 500gr daging ayam<br>- 2 siung bawang putih</span>
            @error('bahan')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="langkah_langkah">Langkah-langkah *</label>
            <textarea name="langkah_langkah" id="langkah_langkah" class="form-control" required>{{ old('langkah_langkah') }}</textarea>
            <span class="help-text">Tulis langkah-langkah memasak secara detail</span>
            @error('langkah_langkah')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar">Gambar Resep</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            <span class="help-text">Format: JPG, PNG. Maksimal 2MB</span>
            @error('gambar')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="video_url">URL Video (YouTube)</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">
            <span class="help-text">Opsional: Link video tutorial YouTube</span>
            @error('video_url')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="waktu_memasak">Waktu Memasak (menit) *</label>
            <input type="number" name="waktu_memasak" id="waktu_memasak" class="form-control" value="{{ old('waktu_memasak') }}" min="1" required>
            @error('waktu_memasak')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="porsi">Porsi *</label>
            <input type="number" name="porsi" id="porsi" class="form-control" value="{{ old('porsi') }}" min="1" required>
            @error('porsi')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tingkat_kesulitan">Tingkat Kesulitan *</label>
            <select name="tingkat_kesulitan" id="tingkat_kesulitan" class="form-control" required>
                <option value="">Pilih Tingkat Kesulitan</option>
                <option value="mudah" {{ old('tingkat_kesulitan') == 'mudah' ? 'selected' : '' }}> Mudah</option>
                <option value="sedang" {{ old('tingkat_kesulitan') == 'sedang' ? 'selected' : '' }}> Sedang</option>
                <option value="sulit" {{ old('tingkat_kesulitan') == 'sulit' ? 'selected' : '' }}> Sulit</option>
            </select>
            @error('tingkat_kesulitan')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Upload Resep</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection