@extends('layouts.admin')
@section('title', 'Kelola Resep - DapurCeria Admin')
@section('page-title', 'Kelola Resep')

@section('content')

{{-- ── FILTER ── --}}
<div class="card" style="margin-bottom:16px;">
    <form action="{{ route('admin.resep.index') }}" method="GET" style="padding:18px 20px;">
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto auto;gap:12px;align-items:flex-end;">
            <div>
                <label style="display:block;font-size:11px;font-weight:700;color:#7A3D1A;margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px;">Cari Resep</label>
                <input type="text" name="search" class="form-control" placeholder="Cari judul resep..." value="{{ request('search') }}">
            </div>
            <div>
                <label style="display:block;font-size:11px;font-weight:700;color:#7A3D1A;margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px;">Kategori</label>
                <select name="kategori" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block;font-size:11px;font-weight:700;color:#7A3D1A;margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px;">Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="white-space:nowrap;">🔍 Filter</button>
            @if(request('search') || request('kategori') || request('status'))
                <a href="{{ route('admin.resep.index') }}" class="btn btn-secondary" style="white-space:nowrap;">✕ Reset</a>
            @endif
        </div>
    </form>
</div>

{{-- ── RESEP LIST ── --}}
<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-food-menu'></i> Daftar Resep
            <span style="font-size:12px;font-weight:400;color:#9A8070;margin-left:6px;">({{ $reseps->total() }} resep)</span>
        </h3>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.resep.pending') }}" class="btn btn-sm btn-warning">
                ⏳ Pending
                @php $pc = \App\Models\Resep::where('status','pending')->count(); @endphp
                @if($pc > 0)<span style="background:#C62828;color:#fff;border-radius:50%;min-width:16px;height:16px;display:inline-flex;align-items:center;justify-content:center;font-size:10px;margin-left:4px;">{{ $pc }}</span>@endif
            </a>
            <a href="{{ route('admin.resep.create') }}" class="btn btn-sm btn-primary">+ Tambah Resep</a>
        </div>
    </div>

    @if($reseps->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Resep</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Rating</th>
                <th>Suka</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reseps as $resep)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:48px;height:48px;border-radius:10px;overflow:hidden;background:#F0E8DC;flex-shrink:0;">
                            @if($resep->gambar)
                                <img src="{{ asset('storage/'.$resep->gambar) }}" style="width:100%;height:100%;object-fit:cover;" alt="" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:22px;">🍳</div>
                            @endif
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:13px;color:#3D2010;line-height:1.3;">{{ $resep->judul }}</div>
                            <div style="font-size:11px;color:#9A8070;">{{ $resep->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </td>
                <td><span class="badge badge-primary">{{ $resep->kategori->nama_kategori }}</span></td>
                <td>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:24px;height:24px;border-radius:50%;background:#E8621A;color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;flex-shrink:0;">
                            {{ strtoupper(substr($resep->user->name, 0, 2)) }}
                        </div>
                        <span style="font-size:12px;">{{ $resep->user->name }}</span>
                    </div>
                </td>
                <td>
                    @if($resep->status === 'approved')
                        <span class="badge badge-success">✓ Disetujui</span>
                    @elseif($resep->status === 'pending')
                        <span class="badge badge-warning">⏳ Pending</span>
                    @else
                        <span class="badge badge-danger">✗ Ditolak</span>
                    @endif
                </td>
                <td style="font-size:13px;">⭐ {{ number_format($resep->averageRating(), 1) }}</td>
                <td style="font-size:13px;">❤️ {{ $resep->totalSuka() }}</td>
                <td style="font-size:11px;color:#9A8070;">{{ $resep->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:5px;flex-wrap:wrap;">
                        <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary" target="_blank" title="Lihat">👁</a>
                        <a href="{{ route('admin.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning" title="Edit">✏️</a>
                        <form action="{{ route('admin.resep.destroy', $resep->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus resep \'{{ addslashes($resep->judul) }}\'?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">🗑</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div style="padding:14px 16px;border-top:1px solid #EDE3D8;">
        {{ $reseps->withQueryString()->links() }}
    </div>

    @else
    <div style="padding:48px;text-align:center;color:#9A8070;">
        <div style="font-size:40px;margin-bottom:12px;">🔍</div>
        <p style="font-size:14px;font-weight:600;color:#3D2010;margin-bottom:4px;">Tidak ada resep ditemukan</p>
        <p style="font-size:13px;">Coba ubah filter pencarian</p>
    </div>
    @endif
</div>

@endsection