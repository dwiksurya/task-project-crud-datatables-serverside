<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['middleware' => 'auth'], function() {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Merchants
    Route::get('/merchant/data', [MerchantController::class, 'data'])->name('merchants.data');
    Route::resource('/merchant', MerchantController::class);
    // Products
    Route::get('/product/data', [ProductController::class, 'data'])->name('products.data');
    Route::post('/product/delete', [ProductController::class, 'deleteSelected'])->name('products.delete');
    Route::put('/product/active', [ProductController::class, 'activeSelected'])->name('products.active');
    Route::resource('/product', ProductController::class);
});