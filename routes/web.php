<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\KomentarController as AdminKomentarController;
use App\Http\Controllers\Admin\ResepController as AdminResepController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SukaController;
use App\Http\Controllers\UserResepController;
use Illuminate\Support\Facades\Route;

// ============================================
// GUEST ROUTES (tanpa login)
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/resep/{id}', [HomeController::class, 'show'])->name('resep.show');

// ============================================
// AUTH ROUTES
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// USER ROUTES (harus login)
// ============================================
Route::middleware('auth')->group(function () {

    // Upload Resep
    Route::get('/user/resep/create', [UserResepController::class, 'create'])->name('user.resep.create');
    Route::post('/user/resep', [UserResepController::class, 'store'])->name('user.resep.store');
    Route::get('/user/resep/my', [UserResepController::class, 'myResep'])->name('user.resep.my');
    Route::get('/user/resep/{id}/edit', [UserResepController::class, 'edit'])->name('user.resep.edit');
    Route::put('/user/resep/{id}', [UserResepController::class, 'update'])->name('user.resep.update');
    Route::delete('/user/resep/{id}', [UserResepController::class, 'destroy'])->name('user.resep.destroy');

    // Komentar
    Route::post('/resep/{resep}/komentar', [KomentarController::class, 'store'])->name('komentar.store');

    // Suka (Like)
    Route::post('/resep/{resep}/suka', [SukaController::class, 'toggle'])->name('suka.toggle');

    // Favorit
    Route::post('/resep/{resep}/favorit', [FavoritController::class, 'toggle'])->name('favorit.toggle');
    Route::get('/favorit', [FavoritController::class, 'index'])->name('favorit.index');

    // Rating
    Route::post('/resep/{resep}/rating', [RatingController::class, 'store'])->name('rating.store');
});

// ============================================
// ADMIN ROUTES (harus login sebagai admin)
// ============================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Kategori CRUD
    Route::get('/kategori', [AdminKategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [AdminKategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [AdminKategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [AdminKategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [AdminKategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [AdminKategoriController::class, 'destroy'])->name('kategori.destroy');

    // Resep CRUD
    Route::get('/resep', [AdminResepController::class, 'index'])->name('resep.index');
    Route::get('/resep/create', [AdminResepController::class, 'create'])->name('resep.create');
    Route::post('/resep', [AdminResepController::class, 'store'])->name('resep.store');
    Route::get('/resep/{id}/edit', [AdminResepController::class, 'edit'])->name('resep.edit');
    Route::put('/resep/{id}', [AdminResepController::class, 'update'])->name('resep.update');
    Route::delete('/resep/{id}', [AdminResepController::class, 'destroy'])->name('resep.destroy');

    // Komentar
    Route::get('/komentar', [AdminKomentarController::class, 'index'])->name('komentar.index');
    Route::post('/komentar/{id}/read', [AdminKomentarController::class, 'markAsRead'])->name('komentar.read');
    Route::post('/komentar/read-all', [AdminKomentarController::class, 'markAllAsRead'])->name('komentar.readAll');
    Route::delete('/komentar/{id}', [AdminKomentarController::class, 'destroy'])->name('komentar.destroy');

    // User Management
    Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
    Route::delete('/user/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy');
});
