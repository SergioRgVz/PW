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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/AlbumRankingOrder', 'App\Http\Controllers\AlbumController@albumranking')->name('albumranking');
Route::get('/AlbumFechaOrder', 'App\Http\Controllers\AlbumController@albumfechaorden')->name('albumfechaorden');
Route::get('/search', 'App\Http\Controllers\AlbumController@search')->name('search');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
