<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index(Request $request)
    {
        $query = Komentar::with([
            'user:id,name',
            'resep:id,judul',
        ])
            ->latest();

        // Filter berdasarkan status (read / unread)
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Search komentar / user / resep
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('isi_komentar', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('resep', function ($q3) use ($request) {
                        $q3->where('judul', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $komentars = $query->paginate(20)->withQueryString();

        $totalKomentar = Komentar::count();
        $totalUnread   = Komentar::where('is_read', false)->count();

        return view('admin.komentar.index', compact(
            'komentars',
            'totalKomentar',
            'totalUnread'
        ));
    }

    public function markAsRead($id)
    {
        $komentar = Komentar::findOrFail($id);

        if (! $komentar->is_read) {
            $komentar->update(['is_read' => true]);
        }
        

        return back()->with('success', 'Komentar ditandai sudah dibaca!');
    }

    public function markAllAsRead()
    {
        Komentar::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua komentar ditandai sudah dibaca!');
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
