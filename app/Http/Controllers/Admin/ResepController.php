<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function index(Request $request)
    {
        $query = Resep::with(['user', 'kategori'])
            ->withCount(['komentars', 'ratings', 'sukas']);

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $reseps    = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.resep.index', compact('reseps', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.resep.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url'         => 'nullable|url',
            'waktu_memasak'     => 'required|integer|min:1',
            'porsi'             => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        $validated['id_user'] = auth()->id();
        $validated['status']  = 'approved'; // Admin upload langsung approved

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create($validated);

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $resep     = Resep::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.resep.edit', compact('resep', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $validated = $request->validate([
            'id_kategori'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil diupdate!');
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil dihapus!');
    }

    // FITUR PERSETUJUAN RESEP

    public function pending()
    {
        $pendingReseps = Resep::where('status', 'pending')
            ->with(['user', 'kategori'])
            ->latest()
            ->paginate(10);

        return view('admin.resep.pending', compact('pendingReseps'));
    }

    public function approve($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->update([
            'status'       => 'approved',
            'alasan_tolak' => null,
        ]);

        return back()->with('success', "Resep \"{$resep->judul}\" berhasil disetujui!");
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ]);

        $resep = Resep::findOrFail($id);
        $resep->update([
            'status'       => 'rejected',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return back()->with('success', "Resep \"{$resep->judul}\" berhasil ditolak.");
    }

    public function approveAll()
    {
        $count = Resep::where('status', 'pending')->count();
        Resep::where('status', 'pending')->update(['status' => 'approved']);

        return back()->with('success', "{$count} resep berhasil disetujui semua!");
    }
}
