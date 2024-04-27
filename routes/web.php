<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index'] );
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class, 'index'] );
Route::get('/register',[App\Http\Controllers\Auth\RegisterController::class, 'index'] );