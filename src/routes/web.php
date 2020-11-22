<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;

// Home Pages
Route::get('/', function() { return view('home'); })->name('home');

// DashBoards
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

// Logout Pages
Route::post('/logout',[LogoutController::class, 'logout'])->name('logout');
Route::get('/logout', function() { return view('home'); });

// Login Pages
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'login']);

// Registration Pages
Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);

// Posts Pages
Route::get('/posts', function () {
    return view('posts.index');
})->name('posts');