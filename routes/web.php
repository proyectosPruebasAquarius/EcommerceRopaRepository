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
    return view('frontend.blank');
});

Route::prefix('administracion')->group(function () {
    Route::get('/', function () {
        return view('backend.home');
    });
    Route::get('/categorias','CategoriaController@index');
    Route::get('/sub-categorias', 'CategoriaController@indexSub');
    Route::get('/marcas', function () {
        return view('backend.marcas');
    });

    Route::get('/colores', function () {
        return view('backend.colores');
    });
    Route::get('/tallas', function () {
        return view('backend.tallas');
    });

    Route::get('/ofertas', function () {
        return view('backend.ofertas');
    });

    Route::get('/proveedores', function () {
        return view('backend.proveedores');
    });
});
