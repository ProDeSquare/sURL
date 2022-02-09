<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortsController;
use App\Http\Controllers\SavedLinksController;
use App\Http\Controllers\CollectionsController;

Route::middleware('guest')->get('/', function () {
    return Inertia::render('Welcome');
});

Route::group(['middleware' => ['auth:sanctum, verified']], function () {

    Route::get('/dashboard/{collection?}/{name?}', [HomeController::class, 'view'])->name('dashboard');

    Route::group(['prefix' => 'short/link'], function () {

        Route::get('/create', [ShortsController::class, 'view'])->name('create-short');
        Route::post('/create', [ShortsController::class, 'create'])->name('store-short');
        Route::get('/update/{short}', [ShortsController::class, 'edit'])->name('short-options');
        Route::put('/update/{short}', [ShortsController::class, 'update'])->name('update-short');
        Route::delete('/delete/{short}', [ShortsController::class, 'delete'])->name('delete-short');

    });

    Route::group(['prefix' => 'saved/links'], function () {

        Route::get('/create', [SavedLinksController::class, 'view'])->name('create-save');
        Route::post('/create', [SavedLinksController::class, 'save'])->name('store-save');
        Route::delete('/delete/{save}', [SavedLinksController::class, 'delete'])->name('delete-save');

        Route::get('/{collection?}/{name?}', [SavedLinksController::class, 'index'])->name('saved-links-index');

    });

    Route::group(['prefix' => 'collections'], function () {
        Route::get('/', [CollectionsController::class, 'view'])->name('create-collection-page');
        Route::post('/', [CollectionsController::class, 'create'])->name('collection-save');
        Route::delete('/{collection}', [CollectionsController::class, 'delete'])->name('collection-delete');
    });

});

Route::get('/l/{short}', [ShortsController::class, 'redirect'])->name('short-redirect');
