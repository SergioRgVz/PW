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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Perfil
Route::get('/perfil', 'App\Http\Controllers\UserController@perfil')->name('mostrar_perfil');
Route::post('/perfil/guardar', 'App\Http\Controllers\UserController@guardar_perfil')->name('guardar_perfil');
Route::get('/perfil/modificar', 'App\Http\Controllers\UserController@modificar_perfil')->name('modificar_perfil');

//CRUD álbum
Route::get('/perfil/crear_album', 'App\Http\Controllers\AlbumController@crear_album')->name('crear_album');
Route::post('/perfil/guardar_album', 'App\Http\Controllers\AlbumController@guardar_album')->name('guardar_album');
Route::delete('/perfil/eliminar_album/{id}', 'App\Http\Controllers\AlbumController@eliminar')->name('eliminar_album');

//CRUD review
Route::delete('/perfil/eliminar_review/{id}', 'App\Http\Controllers\ReviewController@eliminar')->name('eliminar_review');
Route::post('/album/guardar_review', 'App\Http\Controllers\ReviewController@guardarReview')->name('guardarReview');

//Mostrar álbumes
Route::get('/', 'App\Http\Controllers\AlbumController@inicio')->name('inicio');
Route::get('/album/{alb}', 'App\Http\Controllers\AlbumController@album')->name('album');
Route::get('/album_ranking_order', 'App\Http\Controllers\AlbumController@albumranking')->name('albumranking');
Route::get('/album_fecha_order', 'App\Http\Controllers\AlbumController@albumfechaorden')->name('albumfechaorden');

//Búsqueda
Route::get('/search', 'App\Http\Controllers\AlbumController@search')->name('search');
