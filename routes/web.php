<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)
    ->group(function() {
        Route::view('/login', 'auth.login');
        
        Route::post('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');

        Route::view('/admin', 'admin.home')->middleware('admin');
    });

Route::controller(UserController::class)
    ->name('user.')
    ->group(function() {

        Route::view('/register', 'user.register')->name('show-register');
        Route::post('/register', 'register')->name('store');

    });