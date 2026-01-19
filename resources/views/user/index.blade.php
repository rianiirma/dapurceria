@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Data User</h3>

    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Tambah User</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $key => $u)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->role }}</td>
                        <td>
                            <a href="{{ route('user.edit', $u->id_user) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('user.destroy', $u->id_user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

