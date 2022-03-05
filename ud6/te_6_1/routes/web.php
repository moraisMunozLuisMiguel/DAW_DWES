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

Route::get('/', 'App\Http\Controllers\pagesController@inicio')->name('inicio_ruta');

Route::get('inicio', 'App\Http\Controllers\pagesController@inicio')->name('inicio_ruta');

Route::get('producto', 'App\Http\Controllers\pagesController@producto')->name('producto_ruta');

Route::get('cesta', 'App\Http\Controllers\pagesController@cesta')->name('cesta_ruta');
