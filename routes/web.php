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

Route::get('/Quienes-Somos', function(){
    return view('QuienesSomos');
});

Route::get('/Terminos-y-Condiciones', function(){
    return view('TerminosyCondiciones');
});
<<<<<<< HEAD
=======

Route::get('/Catalogo',function(){
    return view('Catalogo');
});
?>
>>>>>>> fe8295f683632ecd9f322ca2e5f45d7bb7c97090
