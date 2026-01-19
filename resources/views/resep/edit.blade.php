@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Resep</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('resep.update', $resep->id_resep) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $resep->judul) }}" required>
                    @error('judul')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $resep->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $resep->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Waktu Masak</label>
                    <input type="text" name="waktu_masak" class="form-control" value="{{ old('waktu_masak', $resep->waktu_masak) }}" placeholder="Misal: 30 menit">
                </div>

                <div class="mb-3">
                    <label>Tingkat Kesulitan</label>
                    <select name="tingkat_kesulitan" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="mudah" {{ old('tingkat_kesulitan', $resep->tingkat_kesulitan) == 'mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="sedang" {{ old('tingkat_kesulitan', $resep->tingkat_kesulitan) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="sulit" {{ old('tingkat_kesulitan', $resep->tingkat_kesulitan) == 'sulit' ? 'selected' : '' }}>Sulit</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Video YouTube (URL)</label>
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $resep->video_url) }}" placeholder="https://www.youtube.com/...">
                </div>

                <div class="mb-3">
                    <label>Gambar Resep</label>
                    @if($resep->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" width="150">
                    </div>
                    @endif
                    <input type="file" name="gambar" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Resep</button><button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('resep.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

