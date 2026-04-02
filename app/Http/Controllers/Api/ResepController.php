<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function index(Request $request)
    {
        $query = Resep::with(['user', 'kategori'])
            ->where('status', 'approved');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $reseps = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $reseps,
        ]);
    }

    public function show($id)
    {
        $resep = Resep::with(['user', 'kategori', 'komentars.user', 'ratings'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => [
                'resep'          => $resep,
                'average_rating' => $resep->averageRating(),
                'total_rating'   => $resep->totalRating(),
                'total_suka'     => $resep->totalSuka(),
                'total_komentar' => $resep->totalKomentar(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|max:2048',
            'video_url'         => 'nullable|url',
            'waktu_memasak'     => 'required|integer|min:1',
            'porsi'             => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status']  = 'pending';

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $resep = Resep::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Resep berhasil diupload! Menunggu persetujuan admin.',
            'data'    => $resep,
        ], 201);
    }

    public function myReseps(Request $request)
    {
        $reseps = Resep::where('user_id', auth()->id())
            ->with('kategori')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $reseps,
        ]);
    }

    public function destroy($id)
    {
        $resep = Resep::where('user_id', auth()->id())->findOrFail($id);

        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resep berhasil dihapus',
        ]);
    }
}
