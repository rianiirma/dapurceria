<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resep_id' => 'required|exists:reseps,id',
            'rating'   => 'required|integer|min:1|max:5',
        ]);

        $validated['user_id'] = auth()->id();

        // Cek apakah user sudah pernah rating
        $existingRating = Rating::where('user_id', auth()->id())
            ->where('resep_id', $request->resep_id)
            ->first();

        if ($existingRating) {
            $existingRating->update(['rating' => $request->rating]);
            $message = 'Rating berhasil diupdate!';
        } else {
            Rating::create($validated);
            $message = 'Rating berhasil ditambahkan!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function update(Request $request, Rating $rating)
    {
        // Pastikan user hanya bisa update rating sendiri
        if ($rating->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating->update($validated);

        return redirect()->back()
            ->with('success', 'Rating berhasil diupdate!');
    }
}
