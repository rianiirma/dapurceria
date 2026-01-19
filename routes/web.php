<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LangkahController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // atau dashboard kalau ada
});

// User CRUD
Route::resource('user', UserController::class);

// Kategori CRUD
Route::resource('kategori', KategoriController::class);

// Resep CRUD
Route::resource('resep', ResepController::class);

// Bahan CRUD
Route::resource('bahan', BahanController::class);

// Langkah CRUD
Route::resource('langkah', LangkahController::class);

// Komentar CRUD
Route::resource('komentar', KomentarController::class);

// Favorit CRUD
Route::resource('favorit', FavoritController::class);
