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
Route::get('/carrito', function () { 
    return view('frontend.layouts.cart');
})->middleware('cartVerify')->name('carrito');

Route::get('/perfil', [App\Http\Controllers\UserController::class, 'index'])->middleware(['auth'])->name('perfil');

Route::get('/productos', function () {
    return view('frontend.layouts.shop');
})->name('productos');

Route::get('/productos/{name}', [App\Http\Controllers\InventarioController::class, 'index'])->name('details');

Route::get('/checkout', function () {
    return view('frontend.layouts.checkout');
})->middleware(['auth','cartVerify'])->name('checkout');



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
    Route::get('/categorias','IndexBackendController@indexCategoria');
    Route::get('/sub-categorias', 'IndexBackendController@indexSub');
    Route::get('/marcas',  'IndexBackendController@indexMarca');
    Route::get('/estilos', 'IndexBackendController@indexEstilo');
    Route::get('/colores', 'IndexBackendController@indexColor');
    Route::get('/tallas', 'IndexBackendController@indexTalla');
    Route::get('/productos', 'IndexBackendController@indexProducto');
    Route::get('/ofertas', 'IndexBackendController@indexOferta');
    Route::get('/metodos-pagos', 'IndexBackendController@indexMetodo');
    Route::get('/proveedores','IndexBackendController@indexProveedor');
    Route::get('/inventarios','IndexBackendController@indexInventario');
    Route::get('/ventas','IndexBackendController@indexVenta');
    Route::get('/pedidos','IndexBackendController@indexPedido');
    
});
/*End Backend */
