<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\TableSchemaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("v1")
    ->group(function () {
        Route::post('/register', [UserController::class, 'register'])
            ->name('register');
        Route::post('/login', [UserController::class, 'login'])
            ->name('login');

        Route::middleware('auth:sanctum')->group(function () {
            /**
             * Table Routes
             * Schema
             */
            Route::get('/schema', [TableSchemaController::class, 'index'])
                ->name('schema.index');
            Route::post('/schema', [TableSchemaController::class, 'store'])
                ->name('schema.store');
            Route::get('/schema/{tableSchema}', [TableSchemaController::class, 'show'])
                ->name('schema.show');

            /**
             * Data
             */
            Route::get('/data/{tableSchema}', [DataController::class, 'index'])
                ->name('data.index');
            Route::post('/data/{tableSchema}', [DataController::class, 'store'])
                ->name('data.store');
            Route::get('/data/show/{data}', [DataController::class, 'show'])
                ->name('data.index');
            Route::put('/data/update/{data}', [DataController::class, 'update'])
                ->name('data.index');
        });
    });
