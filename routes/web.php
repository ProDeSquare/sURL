<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->get('/', function () {
    return Inertia::render('Welcome');
});

Route::group(['middleware' => ['auth:sanctum, verified']], function () {

    Route::get('/dashboard', [HomeController::class, 'view'])
        ->name('dashboard');

    Route::get('/create-a-link', [ShortsController::class, 'view'])
        ->name("create-a-link");

    Route::post('/create-a-link', [ShortsController::class, 'create'])
        ->name('submit-a-link');

    Route::get('/update-link/{short}', [ShortsController::class, 'edit'])
        ->name('edit-link-page');

    Route::put('/update-link/{short}', [ShortsController::class, 'update'])
        ->name('update-link');

    Route::delete('/delete-link/{short}', [ShortsController::class, 'delete'])
        ->name('delete-link');

});

Route::get('/l/{hash}', [ShortsController::class, 'redirect']);
