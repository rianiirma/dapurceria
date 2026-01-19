@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Langkah Memasak</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('langkah.update', $langkah->id_langkah) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Resep</label>
                    <select name="id_resep" class="form-control" required>
                        @foreach($resep as $r)
                        <option value="{{ $r->id_resep }}" {{ $langkah->id_resep == $r->id_resep ? 'selected' : '' }}>
                            {{ $r->nama_resep }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $langkah->urutan) }}" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Langkah</label>
                    <textarea name="deskripsi_langkah" class="form-control" rows="3" required>
                    {{ old('deskripsi_langkah', $langkah->deskripsi_langkah) }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('langkah.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

