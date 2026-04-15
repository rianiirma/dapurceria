@extends('layouts.admin')
@section('title', 'Kelola Pengguna - DapurCeria Admin')
@section('page-title', 'Kelola Pengguna')

@section('content')

{{-- ── STATS ROW ── --}}
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:20px;">
    <div class="stat-card" style="border-left-color:#E8621A;">
        <h4>Total Pengguna</h4>
        <div class="stat-value">{{ $users->total() }}</div>
        <p>Pengguna terdaftar</p>
    </div>
    <div class="stat-card" style="border-left-color:#2E7D32;">
        <h4>User Aktif</h4>
        <div class="stat-value">{{ \App\Models\User::where('role','user')->count() }}</div>
        <p>Role user biasa</p>
    </div>
    <div class="stat-card" style="border-left-color:#B08010;">
        <h4>Admin</h4>
        <div class="stat-value">{{ \App\Models\User::where('role','admin')->count() }}</div>
        <p>Role administrator</p>
    </div>
</div>

{{-- ── SEARCH ── --}}
<div class="card" style="margin-bottom:16px;">
    <form action="{{ route('admin.user.index') }}" method="GET" style="padding:16px 20px;">
        <div style="display:flex;gap:10px;align-items:flex-end;">
            <div style="flex:1;">
                <label style="display:block;font-size:11px;font-weight:700;color:#7A3D1A;margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px;">Cari Pengguna</label>
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">🔍 Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">✕ Reset</a>
            @endif
        </div>
    </form>
</div>

{{-- ── USER TABLE ── --}}
<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-group'></i> Daftar Pengguna
            <span style="font-size:12px;font-weight:400;color:#9A8070;margin-left:6px;">({{ $users->total() }} pengguna)</span>
        </h3>
    </div>

    @if($users->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Pengguna</th>
                <th>Email</th>
                <th>Role</th>
                <th>Resep</th>
                <th>Terdaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td style="color:#9A8070;font-size:12px;">
                    {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                </td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        {{-- DIV FOTO/INISIAL --}}
                        <div style="width:36px;height:36px;border-radius:50%;background:{{ $user->role === 'admin' ? '#E8621A' : '#8AAB7A' }};color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;overflow:hidden;">
                            @if($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            @endif
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:13px;color:#3D2010;">{{ $user->name }}</div>
                            <div style="font-size:11px;color:#9A8070;">Bergabung {{ $user->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                </td>
                <td style="font-size:13px;color:#5A3A20;">{{ $user->email }}</td>
                <td>
                    @if($user->role === 'admin')
                        <span class="badge" style="background:#FDE8D0;color:#B8440E;border:1px solid #F9946A;">🛡 Admin</span>
                    @else
                        <span class="badge badge-success">👤 User</span>
                    @endif
                </td>
                <td>
                    <span style="font-size:13px;font-weight:600;color:#3D2010;">{{ $user->reseps_count }}</span>
                    <span style="font-size:11px;color:#9A8070;"> resep</span>
                </td>
                <td style="font-size:12px;color:#9A8070;">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    @if($user->role !== 'admin')
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus user {{ addslashes($user->name) }}? Semua resep & aktivitasnya ikut terhapus!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Pengguna">🗑 Hapus</button>
                    </form>
                    @else
                    <span style="font-size:11px;color:#C0A090;">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div style="padding:14px 16px;border-top:1px solid #EDE3D8;">
        {{ $users->withQueryString()->links() }}
    </div>

    @else
    <div style="padding:48px;text-align:center;color:#9A8070;">
        <div style="font-size:40px;margin-bottom:12px;">👥</div>
        <p style="font-size:14px;font-weight:600;color:#3D2010;margin-bottom:4px;">
            {{ request('search') ? 'Pengguna tidak ditemukan' : 'Belum ada pengguna terdaftar' }}
        </p>
        @if(request('search'))
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary" style="margin-top:12px;">Reset Pencarian</a>
        @endif
    </div>
    @endif
</div>

@endsection