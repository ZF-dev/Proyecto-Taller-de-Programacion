<?php

use App\Http\Controllers\ControladorRegistroEInicio; // Agregar esta línea para importar el controlador(ya no lo detecta automatico a partir de laravel 8 en adelante)
                                            //Importante aunque app esta en minuscula ,para laravel es obligatorio que el namespace y la carpeta tengan la primera letra en mayuscula, de lo contrario no lo detecta
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/IniciarSesion', function () {
    return view('InicioSesion');
});

Route::post('/IniciarSesion', [ControladorRegistroEInicio::class, 'iniciarSesion']);

Route::get('/registro', function(){
    return view('registro');
});

Route::post('/registro', [ControladorRegistroEInicio::class, 'registroCompletado']);

Route::get('/QuienesSomos', function(){
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