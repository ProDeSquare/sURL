<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortsController;

Route::middleware('guest')->get('/', function () {
    return Inertia::render('Welcome');
});

Route::group(['middleware' => ['auth:sanctum, verified']], function () {

    Route::get('/dashboard', [HomeController::class, 'view'])->name('dashboard');

    Route::group(['prefix' => 'short/link'], function () {

        Route::get('/create', [ShortsController::class, 'view'])->name("create-short");
        Route::post('/create', [ShortsController::class, 'create'])->name('create-short');
        Route::get('/update/{short}', [ShortsController::class, 'edit'])->name('update-short');
        Route::put('/update/{short}', [ShortsController::class, 'update'])->name('update-short');
        Route::delete('/delete/{short}', [ShortsController::class, 'delete'])->name('delete-short');

    });

});

Route::get('/l/{hash}', [ShortsController::class, 'redirect']);
