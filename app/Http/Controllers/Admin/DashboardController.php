<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\Rating;
use App\Models\Resep;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers     = User::where('role', 'user')->count();
        $totalReseps    = Resep::where('status', 'approved')->count();
        $totalKomentars = Komentar::count();
        $avgRating      = Rating::avg('rating') ?? 0;

        // Resep pending persetujuan
        $pendingReseps = Resep::where('status', 'pending')
            ->whereHas('user')
            ->whereHas('kategori')
            ->with(['user', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        $totalPendingReseps = Resep::where('status', 'pending')->count();

        // Komentar belum dibaca
        $unreadKomentars = Komentar::where('is_read', false)
            ->whereHas('user')
            ->whereHas('resep')
            ->with(['user', 'resep'])
            ->latest()
            ->take(5)
            ->get();

        $totalUnreadKomentars = Komentar::where('is_read', false)->count();

        // Resep terbaru (semua status)
        $latestReseps = Resep::with(['user', 'kategori', 'ratings'])
            ->whereHas('user')
            ->whereHas('kategori')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalReseps',
            'totalKomentars',
            'avgRating',
            'pendingReseps',
            'totalPendingReseps',
            'unreadKomentars',
            'totalUnreadKomentars',
            'latestReseps'
        ));
    }
}
