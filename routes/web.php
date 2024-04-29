<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index'] );
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('/register',[App\Http\Controllers\Auth\RegisterController::class, 'index'] );
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');