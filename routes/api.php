<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);      // 200
Route::post('/products', [ProductController::class, 'store']);     // 201 / 422
Route::get('/products/{id}', [ProductController::class, 'show']);  // 200 / 404
Route::put('/products/{id}', [ProductController::class, 'update']); // 200 / 404 / 422
Route::delete('/products/{id}', [ProductController::class, 'destroy']); //200 / 404
