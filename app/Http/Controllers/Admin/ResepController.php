<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::with(['user', 'kategori'])
            ->withCount(['komentars', 'ratings', 'sukas'])
            ->latest()
            ->paginate(10);

        return view('admin.resep.index', compact('reseps'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.resep.create', compact('kategoris'));
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

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create($validated);

        return redirect()->route('admin.resep.index')
            ->with('success', 'Resep berhasil ditambahkan!');
    }

    public function show(Resep $resep)
    {
        $resep->load(['user', 'kategori', 'komentars.user', 'ratings.user']);
        return view('admin.resep.show', compact('resep'));
    }

    public function edit(Resep $resep)
    {
        $kategoris = Kategori::all();
        return view('admin.resep.edit', compact('resep', 'kategoris'));
    }

    public function update(Request $request, Resep $resep)
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

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($resep->gambar) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $resep->update($validated);

        return redirect()->route('admin.resep.index')
            ->with('success', 'Resep berhasil diupdate!');
    }

    public function destroy(Resep $resep)
    {
        // Hapus gambar
        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('admin.resep.index')
            ->with('success', 'Resep berhasil dihapus!');
    }
}
