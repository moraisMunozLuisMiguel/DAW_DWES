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

Route::get('/', 'App\Http\Controllers\pagesController@inicio');

/*Route::get('intro', function () {
    return view('intro_vista');
})->name('intro_ruta');*/

/*Route::get('alumno', function () {
    return view('alumno_vista');
})->name('alumno_ruta');*/

Route::get('alumno', 'App\Http\Controllers\pagesController@alumno')->name('alumno_ruta');
Route::get('intro', 'App\Http\Controllers\pagesController@intro')->name('intro_ruta');
Route::post('guardar', 'App\Http\Controllers\pagesController@guardar')->name('guardar_ruta');
Route::post('nota', 'App\Http\Controllers\pagesController@anadirnota')->name('nota_ruta');
Route::get('profesor', 'App\Http\Controllers\pagesController@profesor')->name('profesor_ruta');

Route::get('publicadas', 'App\Http\Controllers\pagesController@publicar')->name('publi_ruta');
