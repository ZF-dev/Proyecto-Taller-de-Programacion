<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPago extends Controller
{
    public function DatosPagoCompletado(request $request){

        return view('confirmarPago');

    }
}
?>