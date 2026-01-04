<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Part E - Authentication)
|--------------------------------------------------------------------------
| Route berkaitan pendaftaran, login, logout dan profile user
*/

// Group prefix /api/auth
Route::prefix('auth')->group(function () {

    // REGISTER user baru
    // POST /api/auth/register
    Route::post('/register', [AuthController::class, 'register']);

    // LOGIN user & generate token
    // POST /api/auth/login
    Route::post('/login', [AuthController::class, 'login']);

    // Route yang perlukan authentication (token Sanctum)
    Route::middleware('auth:sanctum')->group(function () {

        // LOGOUT user (padam token semasa)
        // POST /api/auth/logout
        Route::post('/logout', [AuthController::class, 'logout']);

        // Dapatkan maklumat user login
        // GET /api/auth/me
        Route::get('/me', [AuthController::class, 'me']);
    });
});


/*
|--------------------------------------------------------------------------
| PRODUCT ROUTES (Part D)
|--------------------------------------------------------------------------
| CRUD untuk Product
| NOTE: Buat masa sekarang masih PUBLIC
| (Authorization akan dibuat dalam Part E3 - Spatie Permission)
*/

// GET semua products
Route::get('/products', [ProductController::class, 'index']);      // 200

// CREATE product baru
Route::post('/products', [ProductController::class, 'store']);     // 201 / 422

// GET product ikut ID
Route::get('/products/{id}', [ProductController::class, 'show']);  // 200 / 404

// UPDATE product
Route::put('/products/{id}', [ProductController::class, 'update']); // 200 / 404 / 422

// DELETE product
Route::delete('/products/{id}', [ProductController::class, 'destroy']); // 200 / 404
