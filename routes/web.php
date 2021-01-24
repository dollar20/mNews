<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\NewsController::class, 'index'])->name('mainpage');

Route::get('/subscribe', [App\Http\Controllers\NewsController::class,'subscribe'])->name('subscribe');

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/news/{news_url}', [App\Http\Controllers\NewsController::class,'getnews'])->name('getnews');

Route::resource('adm/news', App\Http\Controllers\DB\NewsController::class,['index'])->middleware('auth');

Route::get('/profile/{user_name}', [App\Http\Controllers\Auth\ProfileController::class,'index'])->name('profile');