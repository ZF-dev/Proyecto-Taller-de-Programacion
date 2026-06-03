<?php

use App\Http\Controllers\ControladorRegistroEInicio;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ControladorPago;
use App\Http\Controllers\CatalogoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Quienes-Somos', function(){
    return view('QuienesSomos');
});

Route::get('/Terminos-y-Condiciones', function(){
    return view('TerminosyCondiciones');
});

Route::get('/Catalogo', [CatalogoController::class, 'mostrar']);

Route::get('/Comercializacion', function(){
    return view('Comercializacion');
});

Route::get('/Contactos', function(){
    return view('Contactos');
});

Route::get('/exito-consulta', function(){
    return view('exitoConsulta');
});

Route::get('/finalizarCompra', function(){
    return view('finalizarCompra');
});

Route::post('/finalizarCompra', [ControladorPago::class, 'DatosPagoCompletado']);

Route::get('/confirmarPago', function(){
    return view('confirmarPago');
});


Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->name('login.')->group(function () {
        Route::get('/IniciarSesion', 'mostrarLogin')->name('mostrar');
        Route::post('/IniciarSesion', 'conectar')->name('conectar');
    });

    Route::get('/IniciarSesion', [LoginController::class, 'mostrarLogin'])->name('login'); 
    //esto es hardcodeo, en el middleware de autenticacion queria usar la ruta login.mostrar 
    // pero saltaba error de que laravel buscaba la ruta login a secas 
    // y bueno esto es lo que encontre para solucionarlo, no se si es correcto pero funciona 
    // directamente le di el nombre login al mostrarLogin y asi el middleware de autenticacion 
    // redirige a esa ruta cuando el usuario no esta autenticado

    Route::controller(RegisterController::class)->name('register.')->group(function () {
        Route::get('/registro', 'mostrarRegistro')->name('mostrar');
        Route::post('/registro', 'registrar')->name('crear');
    });
});


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'salir'])->name('logout');

    Route::post('/carrito/agregar', [CarritoController::class, 'agregar']);
    Route::get('/carrito', [CarritoController::class, 'mostrar']);
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar']);

    Route::middleware(['verified'])->group(function () {

    });

    Route::middleware(['admin'])->group(function () {
    
        Route::controller(UserController::class)->name('usuarios.')->group(function () {
            Route::get('/usuarios', 'index')->name('index');
            Route::patch('/usuarios/{id}/rol', 'cambiarRol')->name('rol');
            Route::delete('/usuarios/{id}', 'destroy')->name('destroy');
        });

    });
});





