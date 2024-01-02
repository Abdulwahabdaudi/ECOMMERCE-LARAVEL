
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Inertia\Inertia;

Route::get('/', [LoginController::class, 'create'])->name('login');
Route::post('/', [LoginController::class, 'login']);





Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/users', function () {
        return view('user');
    });
});


Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    });
});

Route::get('/admin/dashboard', function () {
    return Inertia::render('admin/Dashboard', ['pos' => route('admin.pos')]);
});
Route::get('/admin/pos', [PosController::class, 'index'])->name('admin.pos');
Route::post('/admin/pos', [PosController::class, 'store']);
Route::post('/admin/pos/change', [PosController::class, 'change']);
Route::delete('/admin/pos/delete/{product}', [PosController::class, 'destroy']);
Route::delete('/admin/pos/empty', [PosController::class, 'empty']);



Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::post('/admin/product', [ProductController::class, 'store'])->name('admin.product.store');
Route::put('/admin/product/{product}', [ProductController::class, 'update'])->name('admin.product.update');
Route::delete('/admin/product/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
