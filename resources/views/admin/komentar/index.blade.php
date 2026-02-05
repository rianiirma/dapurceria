@extends('layouts.admin')

@section('title', 'Kelola Komentar')
@section('page-title', 'Kelola Komentar')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-message-square-dots'></i> Daftar Komentar</h3>
        <form action="{{ route('admin.komentar.readAll') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Tandai Semua Sudah Dibaca</button>
        </form>
    </div>

    @if($komentars->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>User</th>
                    <th>Resep</th>
                    <th>Komentar</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($komentars as $komentar)
                <tr style="{{ !$komentar->is_read ? 'background: #fff3cd;' : '' }}">
                    <td>
                        @if($komentar->is_read)
                            <span class="badge badge-success">Sudah Dibaca</span>
                        @else
                            <span class="badge badge-warning">Belum Dibaca</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $komentar->user->name }}</strong>
                        <div style="font-size: 0.75rem; color: #999;">{{ $komentar->user->email }}</div>
                    </td>
                    <td>
                        <a href="{{ route('resep.show', $komentar->resep->id) }}" style="color: #ff6b6b; text-decoration: none;">
                            {{ Str::limit($komentar->resep->judul, 30) }}
                        </a>
                    </td>
                    <td>{{ Str::limit($komentar->isi_komentar, 80) }}</td>
                    <td>{{ $komentar->created_at->diffForHumans() }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            <a href="{{ route('resep.show', $komentar->resep->id) }}" class="btn btn-sm btn-secondary"><i class='bx bx-show-alt'></i></a>
                            
                            @if(!$komentar->is_read)
                            <form action="{{ route('admin.komentar.read', $komentar->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Tandai Dibaca</button>
                            </form>
                            @endif

                            <form action="{{ route('admin.komentar.destroy', $komentar->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="padding: 1.5rem; display: flex; justify-content: center;">
            {{ $komentars->links() }}
        </div>
    @else
        <p style="padding: 2rem; text-align: center; color: #999;">Belum ada komentar</p>
    @endif
</div>
@endsection