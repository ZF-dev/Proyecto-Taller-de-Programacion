<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ControladorPago;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminMotoController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\AdminVentaController;
use Illuminate\Support\Facades\Route;

    Route::get('/mapa', function(){return view('Mapa');});
    Route::get('/Catalogo', [CatalogoController::class, 'mostrar']);
    Route::get('/Comercializacion', function(){return view('Comercializacion');});
    Route::get('/Contactos', function(){return view('Contactos');});
    Route::get('/exito-consulta', function(){return view('exitoConsulta');});
    Route::get('/', function () {return view('welcome');});
    Route::get('/Quienes-Somos', function(){return view('QuienesSomos');});
    Route::get('/Terminos-y-Condiciones', function(){return view('TerminosyCondiciones');});
    Route::post('/enviar-consulta', [NotificacionController::class, 'enviarConsulta'])->name('consultas.enviar');

Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->name('login.')->group(function () {
        Route::get('/IniciarSesion', 'mostrarLogin')->name('mostrar');
        Route::post('/IniciarSesion', 'conectar')->name('conectar');
    });
    Route::get('/IniciarSesion', [LoginController::class, 'mostrarLogin'])->name('login'); 
    

    Route::controller(RegisterController::class)->name('register.')->group(function () {
        Route::get('/registro', 'mostrarRegistro')->name('mostrar');
        Route::post('/registro', 'registrar')->name('crear');
    });

});


Route::middleware(['auth'])->group(function () {


    Route::post('/logout', [LoginController::class, 'salir'])->name('logout');
    Route::get('/mostrarPerfil', [UserController::class, 'mostrarPerfil'])->name('verPerfil');

    Route::post('/carrito/agregar', [CarritoController::class, 'agregar']);
    Route::get('/carrito', [CarritoController::class, 'mostrar']);
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar']);

    //Route::get('/finalizarCompra', function(){return view('finalizarCompra');});
    Route::post('/finalizarCompra', [ControladorPago::class, 'registrarVenta'])->name('finalizarCompra');
    Route::get('/confirmarPago', [ControladorPago::class, 'DatosPagoCompletado'])->name('ventaConfirmada');



    Route::middleware(['admin'])->group(function () {
    
        Route::controller(UserController::class)->name('usuarios.')->group(function () {
            Route::get('/usuarios', 'index')->name('index');
            Route::patch('/usuarios/{id}/rol', 'cambiarRol')->name('rol');
            Route::delete('/usuarios/{id}', 'destroy')->name('destroy');
        });

        Route::get('/dashboard/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::patch('/dashboard/notificaciones/{id}/leer', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leer');
        Route::get('/dashboard/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');

        Route::controller(DashboardController::class)->name('dashboard.')->group(function(){
            Route::get('/dashboard', 'index')->name('index');

        });

        Route::get('/dashboard/motos', [AdminMotoController::class, 'index'])->name('admin.motos.index');
        Route::post('/dashboard/motos', [AdminMotoController::class, 'store'])->name('admin.motos.store');
        Route::patch('/dashboard/motos/{id}/stock', [AdminMotoController::class, 'actualizarStock'])->name('admin.motos.stock');
        Route::delete('/dashboard/motos/{id}', [AdminMotoController::class, 'destroy'])->name('admin.motos.destroy');

        Route::get('/dashboard/usuarios', [AdminUserController::class, 'index'])->name('admin.usuarios.index');
        Route::post('/dashboard/usuarios', [AdminUserController::class, 'store'])->name('admin.usuarios.store');
        Route::patch('/dashboard/usuarios/{id}/rol', [AdminUserController::class, 'cambiarRol'])->name('admin.usuarios.rol');
        Route::delete('/dashboard/usuarios/{id}', [AdminUserController::class, 'destroy'])->name('admin.usuarios.destroy');

        Route::get('/dashboard/ventas', [AdminVentaController::class, 'index'])->name('admin.ventas.index');

    });
});





