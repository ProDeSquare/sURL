<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', ['\App\Http\Controllers\HomeController', 'view'])
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/create-a-link', ['\App\Http\Controllers\LinksController', 'view'])
    ->name("create-a-link");

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/create-a-link', ['\App\Http\Controllers\LinksController', 'create'])
    ->name('submit-a-link');

// must be at end
Route::get('/l/{hash}', ['\App\Http\Controllers\LinksController', 'redirect']);
