<?php
namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Resep;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    
    public function store(Request $request, $resepId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Resep::findOrFail($resepId); 

        
        Rating::updateOrCreate(
            [
                'id_user'  => auth()->id(),
                'id_resep' => $resepId,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return back()->with('success', 'Rating berhasil diberikan!');
    }
}
