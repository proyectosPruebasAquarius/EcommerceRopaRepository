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
    Route::get('/marcas',  'CategoriaController@indexMarca');
    Route::get('/estilos', 'CategoriaController@indexEstilo');
    Route::get('/colores', 'CategoriaController@indexColor');
    Route::get('/tallas', 'CategoriaController@indexTalla');

    Route::get('/ofertas', 'CategoriaController@indexOferta');

    Route::get('/proveedores','CategoriaController@indexProveedor');
});
