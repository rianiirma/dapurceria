<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FavoritController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KomentarController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ResepController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Routes (tanpa auth)
Route::get('/kategoris', [KategoriController::class, 'index']);
Route::get('/reseps', [ResepController::class, 'index']);
Route::get('/reseps/{id}', [ResepController::class, 'show']);

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (perlu auth)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Resep
    Route::post('/reseps', [ResepController::class, 'store']);
    Route::put('/reseps/{id}', [ResepController::class, 'update']);
    Route::delete('/reseps/{id}', [ResepController::class, 'destroy']);
    Route::get('/my-reseps', [ResepController::class, 'myReseps']);

    // Komentar
    Route::post('/komentars', [KomentarController::class, 'store']);
    Route::delete('/komentars/{id}', [KomentarController::class, 'destroy']);

    // Rating
    Route::post('/ratings', [RatingController::class, 'store']);

    // Favorit
    Route::get('/favorits', [FavoritController::class, 'index']);
    Route::post('/favorits/{resep_id}', [FavoritController::class, 'toggle']);
});
