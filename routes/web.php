<?php

use App\Http\Controllers\ControladorRegistroEInicio;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ControladorPago;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/IniciarSesion', function () {
    return view('InicioSesion');
});

Route::post('/IniciarSesion', [ControladorRegistroEInicio::class, 'iniciarSesion']);

Route::get('/Quienes-Somos', function(){
    return view('QuienesSomos');
});

Route::get('/Terminos-y-Condiciones', function(){
    return view('TerminosyCondiciones');
});

Route::get('/Catalogo', function(){
    return view('Catalogo');
});

Route::get('/Comercializacion', function(){
    return view('Comercializacion');
});

Route::get('/Contactos', function(){
    return view('Contactos');
});

Route::get('/exito-consulta', function(){
    return view('exitoConsulta');
});

Route::post('/carrito/agregar', [CarritoController::class, 'agregar']);

Route::get('/carrito',
    [CarritoController::class, 'mostrar'
]);

Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar']);

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

    Route::controller(RegisterController::class)->name('register.')->group(function () {
        Route::get('/registro', 'mostrarRegistro')->name('mostrar');
        Route::post('/registro', 'registrar')->name('crear');
    });
});


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'salir'])->name('logout');

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





