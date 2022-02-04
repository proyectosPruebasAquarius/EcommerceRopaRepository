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
/*Frontend */

Route::get('/', function () {
    /* return view('frontend.blank'); */
    return view('frontend.layouts.home');
});

Route::get('/perfil', [App\Http\Controllers\UserController::class, 'index'])->middleware(['auth'])->name('perfil');

Route::get('/productos', function () {
    return view('frontend.layouts.shop');
})->name('productos');

Route::get('/productos/{name}', [App\Http\Controllers\InventarioController::class, 'index'])->name('details');

Route::get('/checkout', function () {
    return view('frontend.layouts.checkout');
})->middleware(['auth'])->name('checkout');

Route::get('/administracion', function () {
    return view('backend.blank');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/*End Frontend */











/*Backend */
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
    Route::get('/productos', 'CategoriaController@indexProducto');
    Route::get('/ofertas', 'CategoriaController@indexOferta');
    Route::get('/metodos-pagos', 'CategoriaController@indexMetodo');
    Route::get('/proveedores','CategoriaController@indexProveedor');
    Route::get('/inventarios','CategoriaController@indexInventario');
    Route::get('/ventas','CategoriaController@indexVenta');
});
/*End Backend */
