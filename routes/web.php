<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
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

    Route::get('edit_profile', [UserController::class, 'edit_profile'])->name('edit_profile');
    Route::put('update_profile/{user}', [UserController::class, 'update_profile'])->name('update_profile');
    Route::put('update_password/{user}', [UserController::class, 'update_password'])->name('update_password');

    Route::middleware(['ensureRole:admin',])->group(function () {
        Route::resource('user', UserController::class);
        Route::put('change_status/user/{user}', [UserController::class, 'change_status'])->name('user.change_status');
    });

    Route::middleware(['ensureRole:company',])->group(function () {
        Route::resource('pegawai', WorkerController::class);
        Route::get('edit_password/pegawai/{pegawai}', [WorkerController::class, 'edit_password'])->name('pegawai.edit_password');
        Route::put('update_password/pegawai/{pegawai}', [WorkerController::class, 'update_password'])->name('pegawai.update_password');
        Route::put('change_status/pegawai/{pegawai}', [WorkerController::class, 'change_status'])->name('pegawai.change_status');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
