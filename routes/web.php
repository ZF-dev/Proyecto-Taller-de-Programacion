<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/IniciarSesion', function () {
    return view('InicioSesion');
});

Route::get('/registro', function(){
    return view('registro');
});

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