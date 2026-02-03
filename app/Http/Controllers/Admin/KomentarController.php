<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;

class KomentarController extends Controller
{
    // List komentar
    public function index()
    {
        $komentars = Komentar::with(['user', 'resep'])
            ->latest()
            ->paginate(20);

        return view('admin.komentar.index', compact('komentars'));
    }

    // Mark as read
    public function markAsRead($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->update(['is_read' => true]);

        return back()->with('success', 'Komentar ditandai sudah dibaca!');
    }

    // Mark all as read
    public function markAllAsRead()
    {
        Komentar::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua komentar ditandai sudah dibaca!');
    }

    // Delete
    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
