@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Data Resep</h3>

    <a href="{{ route('resep.create') }}" class="btn btn-primary mb-3">Tambah Resep</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>                        
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Waktu Masak</th>
                        <th>Tingkat Kesulitan</th>
                        <th>Video</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resep as $key => $r)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $r->judul }}</td>
                        <td>{{ $r->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $r->deskripsi ?? '-' }}</td>
                        <td>{{ $r->waktu_masak ?? '-' }}</td>
                        <td>{{ ucfirst($r->tingkat_kesulitan) ?? '-' }}</td>
                        <td>
                            @if($r->video_url)
                            <a href="{{ $r->video_url }}" target="_blank">Lihat Video</a>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if($r->gambar)
                            <img src="{{ asset('storage/' . $r->gambar) }}" alt="{{ $r->judul }}" width="80">
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('resep.edit', $r->id_resep) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('resep.destroy', $r->id_resep) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus resep ini?')">Hapus</button>
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

