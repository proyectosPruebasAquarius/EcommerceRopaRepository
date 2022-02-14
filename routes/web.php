<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'isVerfied'], function() {
    Route::get('/', [App\Http\Controllers\InicioController::class, 'index'])->name('inicio');
    
    Route::get('/perfil', [App\Http\Controllers\UserController::class, 'index'])->middleware(['auth'])->name('perfil');
    
    Route::get('/productos', function (Request $request) {
        if (isset($request->search)) {
            $search = $request->search;
            session(['search' => $search]);
        } else {
            if (session()->has('search')) {
                session()->forget('search');
            }
        }
        return view('frontend.layouts.shop');
    })->name('productos');
    
    Route::get('/productos/{name}', [App\Http\Controllers\InventarioController::class, 'index'])->where('name', '(.*)')->name('details');
    
    Route::get('/checkout', function () {
        return view('frontend.layouts.checkout');
    })->middleware(['auth', 'cartVerify'])->name('checkout');
    
    Route::get('/carrito', function () { 
        return view('frontend.layouts.cart');
    })->middleware('cartVerify')->name('carrito');
    
   

    Route::get('/sobre-nosotros', function () {
        return view('frontend.layouts.about-us');
    })->name('about');

    Route::get('/contactanos', function () {
        return view('frontend.layouts.contact-us');
    })->name('contact');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.iniciar-sesion');
})->name('login');

Route::get('/register', function () {
    return view('auth.registrar');
})->name('register');

Route::get('/email-validation', function () {
    return view('frontend.emails.confirmation-email');
})->middleware('auth')->name('email.validation');

/* Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify'); */

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*End Frontend */











/*Backend */
Route::prefix('administracion')->middleware(['auth','typeuser'])->group(function () {
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
    Route::get('/banners','IndexBackendController@indexBanner');
    
});
/*End Backend */
