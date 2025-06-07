<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoProductController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PromoProductController::class, 'index'])->name('home_page');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add')->middleware('auth');


Route::middleware('auth:admin')->get('/admin/index', [ProductController::class, 'index'])->name('admin.dashboard');
Route::get('sweets/{product}/edit', [ProductController::class, 'edit'])
    ->middleware('auth:admin')
    ->name('product.edit');

Route::get('sweets/create', [ProductController::class, 'create'])
    ->middleware('auth:admin')
    ->name('product.add');

Route::post('/sweets', [ProductController::class, 'store'])
    ->name('product.store')
    ->middleware('auth:admin');

Route::put('/sweets/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('auth:admin');

Route::delete('/sweets/{product}', [ProductController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('product.destroy');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login_page');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register_page');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware(['auth:web,admin'])
    ->name('logout');


    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');
?>
