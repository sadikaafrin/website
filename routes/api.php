<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all-category', [ApiController::class, 'getAllCategory'])->name('all-category');
Route::get('/latest-product', [ApiController::class, 'getLatestProduct'])->name('latest-product');
Route::get('/product-by-category/{id}', [ApiController::class, 'getProductByCategory'])->name('product-by-category');
Route::get('/product-by-id/{id}', [ApiController::class, 'getProductById'])->name('product-by-id');
