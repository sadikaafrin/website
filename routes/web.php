<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EcommerceController::class, 'index'])->name('home');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/manage-category', [CategoryController::class, 'manage'])->name('category.manage');
    Route::post('/new-category', [CategoryController::class, 'create'])->name('category.new');
    // Route::post('/edit-category', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/edit-category/{id}',  [CategoryController::class, 'editCategory'])->name('category.edit');
    // Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::post('/delete-category', [CategoryController::class, 'deleteCategory'])->name('category.delete');





    Route::get('/add-sub-category', [SubCategoryController::class, 'index'])->name('subcategory.add');
    Route::get('/manage-sub-category', [SubCategoryController::class, 'manage'])->name('subcategory.manage');
    Route::post('/sub-category-create', [SubCategoryController::class, 'create'])->name('sub-category.create');
    Route::get('/edit-sub-category/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
    Route::post('/update-sub-category/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
    Route::post('/delete-sub-category/{id}', [SubCategoryController::class, 'delete'])->name('sub-category.delete');



    Route::get('/add-brand', [BrandController::class, 'index'])->name('brand.add');
    Route::post('/create-brand', [BrandController::class, 'create'])->name('brand.new');
    Route::get('/manage-brand', [BrandController::class, 'manage'])->name('brand.manage');
    Route::get('/edit-brand/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/update-brand/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/delete-brand/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    Route::get('/add-unit', [UnitController::class, 'index'])->name('unit.add');
    Route::post('/create-unit', [UnitController::class, 'create'])->name('unit.create');
    Route::get('/manage-unit', [UnitController::class, 'manage'])->name('unit.manage');
    Route::get('/edit-unit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::post('/update-unit/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::get('/delete-unit/{id}', [UnitController::class, 'delete'])->name('unit.delete');


});
