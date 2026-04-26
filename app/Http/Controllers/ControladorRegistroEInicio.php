<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorRegistroEInicio extends Controller
{
    public function registroCompletado(request $request){
        $nombreUsuario = $request->input('nombre');

        // Aquí puedes agregar la lógica para guardar los datos en la base de datos o realizar otras acciones necesarias

        return view('welcome', [
            'nombreUsuario' => $nombreUsuario
        ]);

    }

    public function iniciarSesion(request $request){
        $usuario = $request->input('usuario');

        // Aquí puedes agregar la lógica para guardar los datos en la base de datos o realizar otras acciones necesarias

        return view('welcome', [
            'nombreUsuario' => $usuario
        ]);

    }
}
?>