<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubCatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('login');
});
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
// Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/category', function () {
        return view('admin/category/create');
    })->name('category');
    Route::resource('categories', CategoryController::class);
    Route::resource('category.subcat',SubCatController::class)->shallow();//important
    Route::resource('tag', TagController::class);
    Route::resource('product', ProductController::class);
});
