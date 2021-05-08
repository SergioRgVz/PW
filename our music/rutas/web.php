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

Route::get('/perfil', 'App\Http\Controllers\UserController@perfil')->name('mostrar_perfil');
Route::post('/guardar_perfil', 'App\Http\Controllers\UserController@guardar_perfil')->name('guardar_perfil');
Route::get('/modificar_perfil', 'App\Http\Controllers\UserController@modificar_perfil')->name('modificar_perfil');
Route::get('/crear_album', 'App\Http\Controllers\AlbumController@crear_album')->name('crear_album');
Route::post('/guardar_album', 'App\Http\Controllers\AlbumController@guardar_album')->name('guardar_album');
Route::delete('/eliminar_album/{id}', 'App\Http\Controllers\AlbumController@eliminar')->name('eliminar_album');
Route::delete('/eliminar_review/{id}', 'App\Http\Controllers\ReviewController@eliminar')->name('eliminar_review');
