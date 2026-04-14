@extends('layouts.admin')
@section('title', 'Dashboard - DapurCeria Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── ALERT PENDING ── --}}
@if($totalPendingReseps > 0)
<div style="background:#FDE8D0;border:1.5px solid #F9946A;border-radius:14px;padding:14px 18px;display:flex;align-items:center;gap:12px;margin-bottom:20px;font-size:13px;color:#7A3D1A;">
    <div style="background:#E8621A;color:#fff;border-radius:50%;min-width:26px;height:26px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;">{{ $totalPendingReseps }}</div>
    <span>Ada <strong>{{ $totalPendingReseps }} resep</strong> menunggu persetujuanmu — review sekarang!</span>
    <a href="{{ route('admin.resep.pending') }}" style="margin-left:auto;padding:7px 16px;background:#E8621A;color:#fff;border-radius:10px;font-size:12px;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0;">Review →</a>
</div>
@endif

{{-- ── STATS ── --}}
<div class="stats-grid" style="grid-template-columns:repeat(5,1fr);margin-bottom:20px;">
    <div class="stat-card" style="border-left-color:#E8621A;">
        <h4>Total Pengguna</h4>
        <div class="stat-value">{{ $totalUsers }}</div>
        <p>Pengguna terdaftar</p>
    </div>
    <div class="stat-card" style="border-left-color:#B08010;">
        <h4>Total Resep</h4>
        <div class="stat-value">{{ $totalReseps }}</div>
        <p>Resep tersedia</p>
    </div>
    <div class="stat-card" style="border-left-color:#C62828;">
        <h4>Menunggu Approval</h4>
        <div class="stat-value" style="color:{{ $totalPendingReseps > 0 ? '#C62828' : 'inherit' }}">{{ $totalPendingReseps }}</div>
        <p>Perlu ditinjau</p>
    </div>
    <div class="stat-card" style="border-left-color:#2E7D32;">
        <h4>Total Komentar</h4>
        <div class="stat-value">{{ $totalKomentars }}</div>
        <p>Komentar masuk</p>
    </div>
    <div class="stat-card" style="border-left-color:#F0C840;">
        <h4>Rata-rata Rating</h4>
        <div class="stat-value">{{ number_format($avgRating, 1) }}</div>
        <p>Dari semua resep</p>
    </div>
</div>

{{-- ── RESEP PENDING ── --}}
<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-time-five'></i> Resep Menunggu Persetujuan
            @if($totalPendingReseps > 0)
                <span style="background:#FDDEDE;color:#8B1A1A;font-size:11px;padding:2px 10px;border-radius:10px;font-weight:700;margin-left:6px;">{{ $totalPendingReseps }}</span>
            @endif
        </h3>
        @if($pendingReseps->count() > 0)
        <div style="display:flex;gap:8px;">
            <form action="{{ route('admin.resep.approveAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Setujui semua resep pending?')">
                    ✓ Setujui Semua
                </button>
            </form>
            <a href="{{ route('admin.resep.pending') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
        </div>
        @endif
    </div>

    @if($pendingReseps->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Resep</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Dikirim</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingReseps as $resep)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:44px;height:44px;border-radius:10px;overflow:hidden;background:#F0E8DC;flex-shrink:0;">
                            @if($resep->gambar)
                                <img src="{{ asset('storage/'.$resep->gambar) }}" style="width:100%;height:100%;object-fit:cover;" alt="">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:20px;">🍳</div>
                            @endif
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:13px;color:#3D2010;">{{ $resep->judul }}</div>
                            <div style="font-size:11px;color:#9A8070;">{{ Str::limit($resep->deskripsi, 50) }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div style="display:flex;align-items:center;gap:7px;">
                        <div style="width:28px;height:28px;border-radius:50%;background:#E8621A;color:#fff;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;">
                            {{ strtoupper(substr($resep->user?->name ?? 'U', 0, 2)) }}
                        </div>
                        <span style="font-size:13px;">{{ $resep->user?->name ?? '-' }}</span>
                    </div>
                </td>
                <td><span class="badge badge-primary">{{ $resep->kategori?->nama_kategori ?? '-' }}</span></td>
                <td style="font-size:12px;color:#9A8070;">{{ $resep->created_at->diffForHumans() }}</td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary" target="_blank">👁 Pratinjau</a>
                        <form action="{{ route('admin.resep.approve', $resep->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">✓ Setujui</button>
                        </form>
                        <button type="button" class="btn btn-sm btn-danger" onclick="openRejectModal({{ $resep->id }})">✗ Tolak</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($totalPendingReseps > 5)
    <div style="padding:14px;text-align:center;border-top:1px solid #EDE3D8;">
        <a href="{{ route('admin.resep.pending') }}" class="btn btn-primary">Lihat Semua {{ $totalPendingReseps }} Resep Pending →</a>
    </div>
    @endif
    @else
    <div style="padding:40px;text-align:center;color:#9A8070;">
        <div style="font-size:36px;margin-bottom:10px;">🎉</div>
        <p style="font-size:14px;">Tidak ada resep yang menunggu persetujuan</p>
    </div>
    @endif
</div>

{{-- ── KOMENTAR BELUM DIBACA ── --}}
<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-message-square-dots'></i> Komentar Belum Dibaca
            @if($totalUnreadKomentars > 0)
                <span style="background:#FDDEDE;color:#8B1A1A;font-size:11px;padding:2px 10px;border-radius:10px;font-weight:700;margin-left:6px;">{{ $totalUnreadKomentars }}</span>
            @endif
        </h3>
        @if($totalUnreadKomentars > 0)
        <form action="{{ route('admin.komentar.readAll') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-success">✓ Tandai Semua Dibaca</button>
        </form>
        @endif
    </div>

    @if($unreadKomentars->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Resep</th>
                <th>Komentar</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unreadKomentars as $komentar)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:7px;">
                        <div style="width:28px;height:28px;border-radius:50%;background:#8AAB7A;color:#fff;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;">
                            {{ strtoupper(substr($komentar->user?->name ?? 'U', 0, 2)) }}
                        </div>
                        <strong style="font-size:13px;">{{ $komentar->user?->name ?? '-' }}</strong>
                    </div>
                </td>
                <td style="font-size:12px;">{{ Str::limit($komentar->resep?->judul ?? '-', 35) }}</td>
                <td style="font-size:12px;color:#5A3A20;">{{ Str::limit($komentar->isi_komentar, 60) }}</td>
                <td style="font-size:11px;color:#9A8070;">{{ $komentar->created_at->diffForHumans() }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        @if($komentar->resep)
                        <a href="{{ route('resep.show', $komentar->resep->id) }}" class="btn btn-sm btn-secondary" target="_blank">Lihat</a>
                        @endif
                        <form action="{{ route('admin.komentar.read', $komentar->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">✓ Dibaca</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($totalUnreadKomentars > 5)
    <div style="padding:14px;text-align:center;border-top:1px solid #EDE3D8;">
        <a href="{{ route('admin.komentar.index') }}" class="btn btn-primary">Lihat Semua Komentar →</a>
    </div>
    @endif
    @else
    <div style="padding:40px;text-align:center;color:#9A8070;">
        <div style="font-size:36px;margin-bottom:10px;">🎉</div>
        <p style="font-size:14px;">Semua komentar sudah dibaca!</p>
    </div>
    @endif
</div>

{{-- ── RESEP TERBARU ── --}}
<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-food-menu'></i> Resep Terbaru</h3>
        <a href="{{ route('admin.resep.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>

    @if($latestReseps->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Resep</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Rating</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestReseps as $resep)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:40px;height:40px;border-radius:9px;overflow:hidden;background:#F0E8DC;flex-shrink:0;">
                            @if($resep->gambar)
                                <img src="{{ asset('storage/'.$resep->gambar) }}" style="width:100%;height:100%;object-fit:cover;" alt="">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:18px;">🍳</div>
                            @endif
                        </div>
                        <span style="font-weight:600;font-size:13px;color:#3D2010;">{{ $resep->judul }}</span>
                    </div>
                </td>
                <td><span class="badge badge-primary">{{ $resep->kategori?->nama_kategori ?? '-' }}</span></td>
                <td style="font-size:13px;">{{ $resep->user?->name ?? '-' }}</td>
                <td>
                    @if($resep->status === 'approved')
                        <span class="badge badge-success">✓ Disetujui</span>
                    @elseif($resep->status === 'pending')
                        <span class="badge badge-warning">⏳ Pending</span>
                    @else
                        <span class="badge badge-danger">✗ Ditolak</span>
                    @endif
                </td>
                <td style="font-size:13px;">⭐ {{ number_format($resep->ratings->avg('rating') ?? 0, 1) }}</td>
                <td style="font-size:12px;color:#9A8070;">{{ $resep->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:5px;">
                        <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary" target="_blank">👁</a>
                        <a href="{{ route('admin.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning">✏️</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="padding:40px;text-align:center;color:#9A8070;">
        <p>Belum ada resep</p>
    </div>
    @endif
</div>

{{-- ── MODAL TOLAK ── --}}
<div id="rejectModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#FFFBF5;border-radius:20px;padding:28px;width:460px;max-width:92%;box-shadow:0 20px 60px rgba(0,0,0,.25);">
        <h4 style="margin:0 0 6px;font-size:17px;color:#3D2010;font-family:'Playfair Display',serif;">Alasan Penolakan</h4>
        <p style="font-size:13px;color:#9A8070;margin:0 0 14px;">Jelaskan alasan agar user bisa memperbaiki resepnya.</p>
        <form id="rejectForm" method="POST">
            @csrf
            <textarea name="alasan_tolak" rows="4"
                style="width:100%;border:1.5px solid #E0D0C0;border-radius:12px;padding:12px 14px;font-size:13px;resize:vertical;font-family:inherit;outline:none;color:#3D2010;"
                placeholder="Contoh: Foto resep belum jelas, tolong upload ulang..."></textarea>
            <div style="display:flex;gap:8px;margin-top:14px;justify-content:flex-end;">
                <button type="button" onclick="closeRejectModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-danger">✗ Tolak Resep</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openRejectModal(id) {
    document.getElementById('rejectForm').action = `/admin/resep/${id}/reject`;
    document.getElementById('rejectModal').style.display = 'flex';
}
function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endpush