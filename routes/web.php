<?php

use App\Http\Controllers\AuthController;
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