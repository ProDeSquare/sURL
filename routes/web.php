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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/dashboard/{collection?}/{name?}', [HomeController::class, 'view'])->name('dashboard');

    Route::group(['prefix' => 'short/link', 'controller' => ShortsController::class], function () {

        Route::get('/create', 'view')->name('create-short');
        Route::post('/create', 'create')->name('store-short');
        Route::get('/update/{short}', 'edit')->name('short-options');
        Route::put('/update/{short}', 'update')->name('update-short');
        Route::delete('/delete/{short}', 'delete')->name('delete-short');

    });

    Route::group(['prefix' => 'saved/links', 'controller' => SavedLinksController::class], function () {

        Route::get('/create', 'view')->name('create-save');
        Route::post('/create', 'save')->name('store-save');
        Route::delete('/delete/{save}', 'delete')->name('delete-save');

        Route::get('/{collection?}/{name?}', 'index')->name('saved-links-index');

    });

    Route::group(['prefix' => 'collections', 'controller' => CollectionsController::class], function () {
        Route::get('/', 'view')->name('create-collection-page');
        Route::post('/', 'create')->name('collection-save');
        Route::delete('/{collection}', 'delete')->name('collection-delete');
    });

});

Route::get('/l/{short}', [ShortsController::class, 'redirect'])->name('short-redirect');
