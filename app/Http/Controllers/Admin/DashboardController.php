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
        // STATISTIK
        $totalUsers = User::where('role', 'user')->count();
        $totalReseps = Resep::approved()->count();
        $totalKomentars = Komentar::count();
        $avgRating = round(Rating::avg('rating') ?? 0, 1);

        // RESEP PENDING
        $pendingResepsQuery = Resep::pending()
            ->with(['user:id,name', 'kategori:id,nama_kategori'])
            ->latest();

        $pendingReseps = $pendingResepsQuery->take(5)->get();
        $totalPendingReseps = $pendingResepsQuery->count();

        // KOMENTAR BELUM DIBACA
        $unreadKomentarsQuery = Komentar::unread()
            ->with(['user:id,name', 'resep:id,judul'])
            ->latest();

        $unreadKomentars = $unreadKomentarsQuery->take(5)->get();
        $totalUnreadKomentars = $unreadKomentarsQuery->count();

        // RESEP TERBARU
        $latestReseps = Resep::with([
            'user:id,name',
            'kategori:id,nama_kategori',
            'ratings',
        ])
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
