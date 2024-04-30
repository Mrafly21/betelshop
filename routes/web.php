<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index'] );
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

//Admin Dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('admin/order', [OrderController::class, 'index'])->name('order');
Route::get('admin/products', [ProductController::class, 'index'])->name('product');
Route::get('admin/category', [CategoryController::class, 'index'])->name('category');
Route::get('admin/message', [MessageController::class, 'index'])->name('message');
Route::get('admin/users', [UserController::class, 'index'])->name('user');