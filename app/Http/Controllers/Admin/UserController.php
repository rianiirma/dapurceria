<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // List users
    public function index()
    {
        $users = User::where('role', 'user')
            ->withCount('reseps')
            ->latest()
            ->paginate(20);

        return view('admin.user.index', compact('users'));
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        // Tidak bisa hapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }
}
