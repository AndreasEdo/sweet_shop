<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login_page');
Route::get('/register', [AuthController::class, 'register'])->name('register_page');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::get('/register', [RegisteredUserController::class, 'store']);
