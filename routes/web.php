<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoProductController;
use App\Http\Controllers\RegisteredUserController;


Route::get('/', [PromoProductController::class, 'index'])->name('home_page');


Route::middleware('auth:web')->post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth:web')->name('checkout');
Route::get('/invoice', [CartController::class, 'invoiceGen'])->middleware('auth:web')->name('invoice.generate');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login_page');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth:web,admin'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register_page');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');


Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest')->name('password.update');


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/index', [ProductController::class, 'index'])->name('admin.dashboard');
    Route::get('sweets/create', [ProductController::class, 'create'])->name('product.add');
    Route::post('/sweets', [ProductController::class, 'store'])->name('product.store');
    Route::get('sweets/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/sweets/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/sweets/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/sweets', [ProductController::class, 'showProducts'])->name('products.index');
    Route::get('/sweets/{product}', [ProductController::class, 'show'])->name('products.show');
});
