<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil
     */
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan halaman edit profil
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update Nama, Email, dan Foto Profil
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            // Simpan foto baru
            $user->foto_profil = $request->file('foto_profil')->store('profil', 'public');
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (! Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah!');
    }

    /**
     * Hapus Akun Permanen
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        // 1. Hapus Foto Profil dari Storage jika ada
        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // 2. Logout user secara paksa
        Auth::logout();

        // 3. Hapus data user dari database
        $user->delete();

        // 4. Bersihkan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 5. Tendang ke halaman depan
        return redirect('/')->with('success', 'Akun Anda telah berhasil dihapus secara permanen.');
    }
}
