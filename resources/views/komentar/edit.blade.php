@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Favorit</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('favorit.update', $favorit->id_favorit) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>User</label>
                    <select name="id_user" class="form-control" required>
                        @foreach($user as $u)
                        <option value="{{ $u->id_user }}" {{ $favorit->id_user == $u->id_user ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Resep Favorit</label>
                    <select name="id_resep" class="form-control" required>
                        @foreach($resep as $r)
                        <option value="{{ $r->id_resep }}" {{ $favorit->id_resep == $r->id_resep ? 'selected' : '' }}>
                            {{ $r->nama_resep }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('favorit.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

