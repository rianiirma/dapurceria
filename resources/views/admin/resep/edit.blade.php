@extends('layouts.admin')

@section('title', 'Edit Resep')
@section('page-title', 'Edit Resep')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>✏️ Edit Resep</h3>
    </div>

    <form action="{{ route('admin.resep.update', $resep->id) }}" method="POST" enctype="multipart/form-data" style="padding: 1.5rem;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul Resep *</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $resep->judul) }}" required>
            @error('judul')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_kategori">Kategori *</label>
            <select name="id_kategori" id="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('id_kategori', $resep->id_kategori) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('id_kategori')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi *</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi', $resep->deskripsi) }}</textarea>
            @error('deskripsi')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="bahan">Bahan-bahan *</label>
            <textarea name="bahan" id="bahan" class="form-control" required>{{ old('bahan', $resep->bahan) }}</textarea>
            @error('bahan')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="langkah_langkah">Langkah-langkah *</label>
            <textarea name="langkah_langkah" id="langkah_langkah" class="form-control" required>{{ old('langkah_langkah', $resep->langkah_langkah) }}</textarea>
            @error('langkah_langkah')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar">Gambar Resep</label>
            @if($resep->gambar)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $resep->gambar) }}" alt="Current" style="max-width: 200px; border-radius: 5px;">
                    <p style="font-size: 0.875rem; color: #666; margin-top: 0.5rem;">Gambar saat ini. Upload gambar baru untuk menggantinya.</p>
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            @error('gambar')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="video_url">URL Video (YouTube)</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url', $resep->video_url) }}">
            @error('video_url')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label for="waktu_memasak">Waktu Memasak (menit) *</label>
                <input type="number" name="waktu_memasak" id="waktu_memasak" class="form-control" value="{{ old('waktu_memasak', $resep->waktu_memasak) }}" min="1" required>
                @error('waktu_memasak')
                    <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="porsi">Porsi *</label>
                <input type="number" name="porsi" id="porsi" class="form-control" value="{{ old('porsi', $resep->porsi) }}" min="1" required>
                @error('porsi')
                    <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tingkat_kesulitan">Tingkat Kesulitan *</label>
                <select name="tingkat_kesulitan" id="tingkat_kesulitan" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="mudah" {{ old('tingkat_kesulitan', $resep->tingkat_kesulitan) == 'mudah' ? 'selected' : '' }}>Mudah</option>
                    <option value="sedang" {{ old('tingkat_kesulitan', $resep->tingkat_kesulitan) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="sulit" {{ old('tingkat_kesulitan', $resep->tingkat_kesulitan) == 'sulit' ? 'selected' : '' }}>Sulit</option>
                </select>
                @error('tingkat_kesulitan')
                    <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Update Resep</button>
            <a href="{{ route('admin.resep.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection