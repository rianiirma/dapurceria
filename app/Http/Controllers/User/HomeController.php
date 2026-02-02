<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $reseps = Resep::with(['user', 'kategori'])
            ->withCount(['komentars', 'sukas'])
            ->latest()
            ->paginate(12);

        $kategoris = Kategori::withCount('reseps')->get();

        $popularReseps = Resep::withCount('sukas')
            ->orderBy('sukas_count', 'desc')
            ->take(6)
            ->get();

        return view('user.home', compact('reseps', 'kategoris', 'popularReseps'));
    }

    public function dashboard()
    {
        $user = auth()->user();

        $myReseps = Resep::where('user_id', $user->id)
            ->withCount(['komentars', 'sukas', 'ratings'])
            ->latest()
            ->take(5)
            ->get();

        $myFavorits = $user->favorits()
            ->with('resep.user')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'totalReseps'    => $user->reseps()->count(),
            'totalKomentars' => $user->komentars()->count(),
            'totalFavorits'  => $user->favorits()->count(),
            'totalSukas'     => $user->sukas()->count(),
        ];

        return view('user.dashboard', compact('myReseps', 'myFavorits', 'stats'));
    }

    public function kategori(Kategori $kategori)
    {
        $reseps = Resep::where('kategori_id', $kategori->id)
            ->with(['user', 'kategori'])
            ->withCount(['komentars', 'sukas'])
            ->latest()
            ->paginate(12);

        return view('user.kategori', compact('kategori', 'reseps'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('q');

        $reseps = Resep::with(['user', 'kategori'])
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%")
                    ->orWhere('bahan', 'like', "%{$keyword}%");
            })
            ->withCount(['komentars', 'sukas'])
            ->latest()
            ->paginate(12);

        return view('user.search', compact('reseps', 'keyword'));
    }
}
