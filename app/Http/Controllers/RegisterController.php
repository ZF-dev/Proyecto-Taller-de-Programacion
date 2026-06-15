<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function mostrarRegistro()
    {
        return view('registro');
    }

    public function registrar(Request $request)
{
    $datosValidados = $request->validate([
        'name'             => 'required|string|max:255',
        'email'            => 'required|string|email|max:255|unique:users,email',
        'password'         => 'required|string|min:6',
        'dni'              => 'required|numeric|digits_between:7,8|unique:users,DNI', 
        'fecha_nacimiento' => 'required|date',
    ]);

    $usuario = User::create([
        'name'             => $datosValidados['name'],
        'email'            => $datosValidados['email'],
        'password'         => bcrypt($datosValidados['password']), 
        'dni'              => $datosValidados['dni'],
        'fecha_nacimiento' => $datosValidados['fecha_nacimiento']
    ]);

    event(new Registered($usuario)); 

    auth()->login($usuario);

    return redirect()->to('/')->with('exito', '¡Cuenta creada con éxito! Bienvenido.');
}


}
