<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index(Request $request)
    {
        $query = Komentar::with(['user', 'resep']);

        // Filter by read status
        if ($request->has('status')) {
            if ($request->status == 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status == 'read') {
                $query->where('is_read', true);
            }
        }

        $komentars   = $query->latest()->paginate(15);
        $unreadCount = Komentar::where('is_read', false)->count();

        return view('admin.komentar.index', compact('komentars', 'unreadCount'));
    }

    public function destroy(Komentar $komentar)
    {
        $komentar->delete();

        return redirect()->route('admin.komentar.index')
            ->with('success', 'Komentar berhasil dihapus!');
    }

    public function markAsRead(Komentar $komentar)
    {
        $komentar->markAsRead();

        return redirect()->back()
            ->with('success', 'Komentar ditandai sudah dibaca!');
    }

    public function markAllAsRead()
    {
        Komentar::where('is_read', false)->update(['is_read' => true]);

        return redirect()->back()
            ->with('success', 'Semua komentar ditandai sudah dibaca!');
    }
}
