<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Rating;
use App\Models\Resep;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers'      => User::where('role', 'user')->count(),
            'totalAdmins'     => User::where('role', 'admin')->count(),
            'totalReseps'     => Resep::count(),
            'totalKategoris'  => Kategori::count(),
            'totalKomentars'  => Komentar::count(),
            'unreadKomentars' => Komentar::where('is_read', false)->count(),
            'averageRating'   => Rating::avg('rating') ?? 0,

            // Recent data
            'recentReseps'    => Resep::with(['user', 'kategori'])
                ->latest()
                ->take(5)
                ->get(),
            'recentKomentars' => Komentar::with(['user', 'resep'])
                ->where('is_read', false)
                ->latest()
                ->take(5)
                ->get(),
            'recentUsers'     => User::where('role', 'user')
                ->latest()
                ->take(5)
                ->get(),

            // Top rated reseps
            'topReseps'       => Resep::withAvg('ratings', 'rating')
                ->orderBy('ratings_avg_rating', 'desc')
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
