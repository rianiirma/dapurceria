@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Alert Banner: Resep Pending --}}
    @if ($totalPendingReseps > 0)
        <div
            style="background:#FFF7ED; border:1px solid #FED7AA; border-radius:10px; padding:12px 18px; display:flex; align-items:center; gap:12px; margin-bottom:18px; font-size:13px; color:#92400E;">
            <span
                style="background:#F59E0B; color:#fff; border-radius:99px; min-width:24px; height:24px; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:500;">{{ $totalPendingReseps }}</span>
            Ada <strong>{{ $totalPendingReseps }} resep</strong> menunggu persetujuanmu — yuk review sekarang!
            <a href="{{ route('admin.resep.pending') }}" style="margin-left:auto;" class="btn btn-sm btn-primary">Review
                Sekarang</a>
        </div>
    @endif

    {{-- Stats Grid --}}
    <div class="stats-grid" style="grid-template-columns: repeat(5, 1fr);">
        <div class="stat-card">
            <h4>Total Pengguna</h4>
            <div class="stat-value">{{ $totalUsers }}</div>
            <p style="color:#92400E; font-size:0.875rem; margin-top:0.5rem;">Pengguna terdaftar</p>
        </div>
        <div class="stat-card" style="border-left-color:#FBBF24;">
            <h4>Total Resep</h4>
            <div class="stat-value">{{ $totalReseps }}</div>
            <p style="color:#92400E; font-size:0.875rem; margin-top:0.5rem;">Resep tersedia</p>
        </div>
        <div class="stat-card" style="border-left-color:#EF4444;">
            <h4>Menunggu Persetujuan</h4>
            <div class="stat-value">{{ $totalPendingReseps }}</div>
            <p style="color:#92400E; font-size:0.875rem; margin-top:0.5rem;">Perlu ditinjau</p>
        </div>
        <div class="stat-card" style="border-left-color:#10B981;">
            <h4>Total Komentar</h4>
            <div class="stat-value">{{ $totalKomentars }}</div>
            <p style="color:#92400E; font-size:0.875rem; margin-top:0.5rem;">Komentar masuk</p>
        </div>
        <div class="stat-card" style="border-left-color:#F59E0B;">
            <h4>Rata-rata Rating</h4>
            <div class="stat-value">{{ number_format($avgRating, 1) }}</div>
            <p style="color:#92400E; font-size:0.875rem; margin-top:0.5rem;">Dari semua resep</p>
        </div>
    </div>

    {{-- Resep Menunggu Persetujuan --}}
    <div class="card">
        <div class="card-header">
            <h3><i class='bx bx-time-five'></i> Resep Menunggu Persetujuan ({{ $totalPendingReseps }})</h3>
            @if ($pendingReseps->count() > 0)
                <div style="display:flex; gap:8px;">
                    <form action="{{ route('admin.resep.approveAll') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success"
                            onclick="return confirm('Setujui semua resep pending?')">
                            Setujui Semua
                        </button>
                    </form>
                    <a href="{{ route('admin.resep.pending') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
                </div>
            @endif
        </div>

        @if ($pendingReseps->count() > 0)
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
                    @foreach ($pendingReseps as $resep)
                        <tr style="background:#FFFBEB;">
                            <td>
                                <strong>{{ $resep->judul }}</strong><br>
                                <span style="font-size:11px; color:#A8A29E;">
                                    {{ Str::limit($resep->deskripsi, 50) }}
                                </span>
                            </td>
                            <td>{{ $resep->user?->name ?? '-' }}</td>
                            <td>{{ $resep->kategori?->nama_kategori ?? '-' }}</td>
                            <td>{{ $resep->created_at->diffForHumans() }}</td>
                            <td>
                                <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
                                    <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary"
                                        target="_blank">
                                        <i class='bx bx-show-alt'></i> Pratinjau
                                    </a>
                                    <form action="{{ route('admin.resep.approve', $resep->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class='bx bx-check'></i> Setujui
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="openRejectModal({{ $resep->id }})">
                                        <i class='bx bx-x'></i> Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalPendingReseps > 5)
                <div style="padding:1rem; text-align:center; border-top:1px solid #FDE68A;">
                    <a href="{{ route('admin.resep.pending') }}" class="btn btn-primary">
                        Lihat Semua {{ $totalPendingReseps }} Resep Pending
                    </a>
                </div>
            @endif
        @else
            <p style="padding:2rem; text-align:center; color:#A8A29E;">
                Tidak ada resep yang menunggu persetujuan 🎉
            </p>
        @endif
    </div>

    {{-- Komentar Belum Dibaca --}}
    <div class="card">
        <div class="card-header">
            <h3><i class='bx bx-message-square-dots'></i> Komentar Belum Dibaca ({{ $totalUnreadKomentars }})</h3>
            @if ($totalUnreadKomentars > 0)
                <form action="{{ route('admin.komentar.readAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Tandai Semua Dibaca</button>
                </form>
            @endif
        </div>

        @if ($unreadKomentars->count() > 0)
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
                    @foreach ($unreadKomentars as $komentar)
                        <tr style="background:#FFFBEB;">
                            <td><strong>{{ $komentar->user?->name ?? '-' }}</strong></td>
                            <td>{{ Str::limit($komentar->resep?->judul ?? '-', 40) }}</td>
                            <td>{{ Str::limit($komentar->isi_komentar, 60) }}</td>
                            <td>{{ $komentar->created_at->diffForHumans() }}</td>
                            <td>
                                <div style="display:flex; gap:0.5rem;">
                                    @if ($komentar->resep)
                                        <a href="{{ route('resep.show', $komentar->resep->id) }}"
                                            class="btn btn-sm btn-secondary">Lihat</a>
                                    @endif
                                    <form action="{{ route('admin.komentar.read', $komentar->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Tandai Dibaca</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalUnreadKomentars > 5)
                <div style="padding:1rem; text-align:center; border-top:1px solid #FDE68A;">
                    <a href="{{ route('admin.komentar.index') }}" class="btn btn-primary">Lihat Semua Komentar</a>
                </div>
            @endif
        @else
            <p style="padding:2rem; text-align:center; color:#A8A29E;">Semua komentar sudah dibaca! 🎉</p>
        @endif
    </div>

    {{-- Resep Terbaru --}}
    <div class="card">
        <div class="card-header">
            <h3><i class='bx bx-food-menu'></i> Resep Terbaru</h3>
            <a href="{{ route('admin.resep.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>

        @if ($latestReseps->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestReseps as $resep)
                        <tr>
                            <td><strong>{{ $resep->judul }}</strong></td>
                            <td>{{ $resep->kategori?->nama_kategori ?? '-' }}</td>
                            <td>{{ $resep->user?->name ?? '-' }}</td>
                            <td>
                                @if ($resep->status === 'approved')
                                    <span
                                        style="background:#D1FAE5; color:#065F46; border:1px solid #6EE7B7; padding:2px 8px; border-radius:99px; font-size:11px;">Disetujui</span>
                                @elseif($resep->status === 'pending')
                                    <span
                                        style="background:#FEF3C7; color:#92400E; border:1px solid #FCD34D; padding:2px 8px; border-radius:99px; font-size:11px;">Pending</span>
                                @else
                                    <span
                                        style="background:#FEE2E2; color:#991B1B; border:1px solid #FCA5A5; padding:2px 8px; border-radius:99px; font-size:11px;">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <i class='bx bxs-star' style='color:#F59E0B'></i>
                                {{ number_format($resep->ratings->avg('rating') ?? 0, 1) }}
                            </td>
                            <td>{{ $resep->created_at->format('d M Y') }}</td>
                            <td>
                                <div style="display:flex; gap:0.5rem;">
                                    <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary">
                                        <i class='bx bx-show-alt'></i>
                                    </a>
                                    <a href="{{ route('admin.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="padding:2rem; text-align:center; color:#A8A29E;">Belum ada resep</p>
        @endif
    </div>

    {{-- Modal Tolak Resep --}}
    <div id="rejectModal"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
        <div
            style="background:#fff; border-radius:14px; padding:24px; width:440px; max-width:90%; box-shadow:0 20px 60px rgba(0,0,0,.3);">
            <h4 style="margin:0 0 6px; font-size:16px; color:#78350F;">Alasan Penolakan</h4>
            <p style="font-size:13px; color:#A8A29E; margin:0 0 12px;">Jelaskan alasan agar user bisa memperbaiki resepnya.
            </p>
            <form id="rejectForm" method="POST">
                @csrf
                <textarea name="alasan_tolak" rows="4"
                    style="width:100%; border:1px solid #FDE68A; border-radius:8px; padding:10px; font-size:13px; resize:vertical; box-sizing:border-box; font-family:inherit;"
                    placeholder="Contoh: Foto resep belum jelas, tolong upload ulang dengan pencahayaan yang baik..."></textarea>
                <div style="display:flex; gap:8px; margin-top:14px; justify-content:flex-end;">
                    <button type="button" onclick="closeRejectModal()" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Resep</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function openRejectModal(resepId) {
            document.getElementById('rejectForm').action = `/admin/resep/${resepId}/reject`;
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
