<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function show(Resep $resep)
    {
        $resep->load(['user', 'kategori', 'komentars.user', 'ratings']);

        $relatedReseps = Resep::where('kategori_id', $resep->kategori_id)
            ->where('id', '!=', $resep->id)
            ->take(4)
            ->get();

        return view('user.resep.show', compact('resep', 'relatedReseps'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('user.resep.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url'         => 'nullable|url',
            'waktu_memasak'     => 'required|integer|min:1',
            'porsi'             => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create($validated);

        return redirect()->route('user.resep.my-recipes')
            ->with('success', 'Resep berhasil ditambahkan!');
    }

    public function myRecipes()
    {
        $reseps = Resep::where('user_id', auth()->id())
            ->with('kategori')
            ->withCount(['komentars', 'sukas', 'ratings'])
            ->latest()
            ->paginate(10);

        return view('user.resep.my-recipes', compact('reseps'));
    }

    public function edit(Resep $resep)
    {
        // Pastikan user hanya bisa edit resep sendiri
        if ($resep->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $kategoris = Kategori::all();
        return view('user.resep.edit', compact('resep', 'kategoris'));
    }

    public function update(Request $request, Resep $resep)
    {
        // Pastikan user hanya bisa update resep sendiri
        if ($resep->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url'         => 'nullable|url',
            'waktu_memasak'     => 'required|integer|min:1',
            'porsi'             => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        if ($request->hasFile('gambar')) {
            if ($resep->gambar) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $resep->update($validated);

        return redirect()->route('user.resep.my-recipes')
            ->with('success', 'Resep berhasil diupdate!');
    }

    public function destroy(Resep $resep)
    {
        // Pastikan user hanya bisa hapus resep sendiri
        if ($resep->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('user.resep.my-recipes')
            ->with('success', 'Resep berhasil dihapus!');
    }
}
