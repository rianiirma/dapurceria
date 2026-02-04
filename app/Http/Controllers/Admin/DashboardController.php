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
        $totalReseps    = Resep::count();
        $totalKomentars = Komentar::count();
        $avgRating      = Rating::avg('rating') ?? 0;

        $unreadKomentars = Komentar::where('is_read', false)
            ->with(['user', 'resep'])
            ->latest()
            ->take(5)
            ->get();

        $totalUnreadKomentars = Komentar::where('is_read', false)->count();

        $latestReseps = Resep::with(['user', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalReseps',
            'totalKomentars',
            'avgRating',
            'unreadKomentars',
            'totalUnreadKomentars',
            'latestReseps'
        ));
    }
}
