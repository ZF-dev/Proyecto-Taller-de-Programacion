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

Route::get('/nosotros', function(){
    return view('nosotros');
});
?>