<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    //Product
    Route::get('product/change_status', [ProductController::class, 'change_status'])->name('product.change_status');
    Route::resource('product', ProductController::class);

    // Distributor
    Route::resource('distributor', DistributorController::class);

    Route::resource('stock_in', StockInController::class);
    Route::resource('stock_out', StockOutController::class);

    Route::middleware(['ensureRole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::put('change_status/user/{user}', [UserController::class, 'change_status'])->name('user.change_status');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
