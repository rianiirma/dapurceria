@extends('layouts.admin')
@section('title', 'Resep Pending - DapurCeria Admin')
@section('page-title', 'Persetujuan Resep')

@section('content')

{{-- ── HEADER INFO ── --}}
<div style="background:#FDE8D0;border:1.5px solid #F9946A;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:14px;margin-bottom:20px;">
    <div style="font-size:32px;">⏳</div>
    <div>
        <div style="font-size:15px;font-weight:700;color:#3D2010;">{{ $pendingReseps->total() }} Resep Menunggu Persetujuan</div>
        <div style="font-size:12px;color:#9A8070;margin-top:2px;">Review dan setujui atau tolak resep dari pengguna</div>
    </div>
    @if($pendingReseps->total() > 0)
    <div style="margin-left:auto;flex-shrink:0;">
        <form action="{{ route('admin.resep.approveAll') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" onclick="return confirm('Setujui semua {{ $pendingReseps->total() }} resep pending?')">
                ✓ Setujui Semua
            </button>
        </form>
    </div>
    @endif
</div>

{{-- ── PENDING CARDS ── --}}
@if($pendingReseps->count() > 0)

<div style="display:flex;flex-direction:column;gap:14px;margin-bottom:20px;">
    @foreach($pendingReseps as $resep)
    <div style="background:#FFFBF5;border:1px solid #EDE3D8;border-radius:16px;overflow:hidden;border-left:4px solid #B08010;">
        <div style="display:flex;gap:0;">

            {{-- Thumbnail --}}
            <div style="width:140px;flex-shrink:0;background:#F0E8DC;position:relative;">
                @if($resep->gambar)
                    <img src="{{ asset('storage/'.$resep->gambar) }}" style="width:100%;height:100%;object-fit:cover;min-height:120px;" alt="" loading="lazy">
                @else
                    <div style="width:100%;min-height:120px;display:flex;align-items:center;justify-content:center;font-size:40px;">🍳</div>
                @endif
            </div>

            {{-- Content --}}
            <div style="flex:1;padding:16px 18px;display:flex;flex-direction:column;gap:8px;">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
                    <div>
                        <div style="font-family:'Playfair Display',serif;font-size:16px;color:#3D2010;margin-bottom:4px;">{{ $resep->judul }}</div>
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                            <span class="badge badge-primary">{{ $resep->kategori?->nama_kategori ?? '-' }}</span>
                            <span style="font-size:11px;color:#9A8070;">
                                oleh <strong>{{ $resep->user?->name ?? '-' }}</strong>
                            </span>
                            <span style="font-size:11px;color:#9A8070;">· {{ $resep->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <span class="badge badge-warning" style="flex-shrink:0;">⏳ Menunggu</span>
                </div>

                <p style="font-size:12px;color:#7A6050;line-height:1.6;margin:0;">{{ Str::limit($resep->deskripsi, 120) }}</p>

                {{-- Meta chips --}}
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <span style="font-size:11px;color:#9A8070;">⏱ {{ $resep->waktu_memasak }} mnt</span>
                    <span style="font-size:11px;color:#9A8070;">🍽 {{ $resep->porsi }} porsi</span>
                    @php $d = $resep->tingkat_kesulitan; @endphp
                    <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:8px;
                        background:{{ $d=='mudah'?'#D4F0E0':($d=='sedang'?'#FEF3C0':'#FDDEDE') }};
                        color:{{ $d=='mudah'?'#1A6B3A':($d=='sedang'?'#856404':'#8B1A1A') }};">
                        {{ ucfirst($d) }}
                    </span>
                </div>

                {{-- Actions --}}
                <div style="display:flex;gap:8px;margin-top:4px;flex-wrap:wrap;">
                    <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary" target="_blank">👁 Pratinjau</a>
                    <form action="{{ route('admin.resep.approve', $resep->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">✓ Setujui</button>
                    </form>
                    <button type="button" class="btn btn-sm btn-danger" onclick="openRejectModal({{ $resep->id }}, '{{ addslashes($resep->judul) }}')">
                        ✗ Tolak
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Pagination --}}
<div style="display:flex;justify-content:center;">
    {{ $pendingReseps->links() }}
</div>

@else
<div style="background:#FFFBF5;border:1px solid #EDE3D8;border-radius:16px;padding:60px 24px;text-align:center;">
    <div style="font-size:52px;margin-bottom:16px;">🎉</div>
    <div style="font-family:'Playfair Display',serif;font-size:20px;color:#3D2010;margin-bottom:8px;">Semua bersih!</div>
    <p style="font-size:14px;color:#9A8070;">Tidak ada resep yang menunggu persetujuan saat ini.</p>
    <a href="{{ route('admin.resep.index') }}" class="btn btn-primary" style="margin-top:16px;">Lihat Semua Resep</a>
</div>
@endif

{{-- ── MODAL TOLAK ── --}}
<div id="rejectModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#FFFBF5;border-radius:20px;padding:28px;width:480px;max-width:92%;box-shadow:0 20px 60px rgba(0,0,0,.25);">
        <h4 style="margin:0 0 4px;font-size:17px;color:#3D2010;font-family:'Playfair Display',serif;">Tolak Resep</h4>
        <p id="rejectResepName" style="font-size:13px;color:#9A8070;margin:0 0 14px;"></p>
        <form id="rejectForm" method="POST">
            @csrf
            <label style="font-size:12px;font-weight:700;color:#7A3D1A;display:block;margin-bottom:6px;">Alasan Penolakan <span style="color:#E8621A;">*</span></label>
            <textarea name="alasan_tolak" rows="4" required
                style="width:100%;border:1.5px solid #E0D0C0;border-radius:12px;padding:12px 14px;font-size:13px;resize:vertical;font-family:inherit;outline:none;color:#3D2010;background:#fff;"
                placeholder="Contoh: Foto resep belum jelas, tolong upload ulang dengan pencahayaan yang baik..."></textarea>
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
function openRejectModal(id, judul) {
    document.getElementById('rejectForm').action = `/admin/resep/${id}/reject`;
    document.getElementById('rejectResepName').textContent = '"' + judul + '"';
    document.getElementById('rejectModal').style.display = 'flex';
}
function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
    document.getElementById('rejectForm').reset();
}
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endpush