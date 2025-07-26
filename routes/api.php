<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("v1")
    ->group(function () {
        Route::post('/register', [UserController::class, 'register'])
            ->name('user.register');
        Route::post('/login', [UserController::class, 'login'])
            ->name('user.login');
    });
