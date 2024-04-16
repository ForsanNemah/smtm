<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('front', [App\Http\Controllers\Frontend\FeontendController::class, 'index']);
Route::get('about', [App\Http\Controllers\Frontend\FeontendController::class, 'about']);
Route::get('blog', [App\Http\Controllers\Frontend\FeontendController::class, 'blog']);
Route::get('header', [App\Http\Controllers\Frontend\FeontendController::class, 'header']);
