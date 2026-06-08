<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoItem;
use App\Models\Venta;
use App\Models\motos;
use Illuminate\Support\Facades\DB;

class ControladorPago extends Controller
{
    public function DatosPagoCompletado(request $request){

        return view('confirmarPago');

    }

    public function registrarVenta(request $request){
        $userId = auth()->id();

        $items = CarritoItem::where('user_id', $userId)
                            ->with('moto')
                            ->get();

        $venta = Venta::crearDesdeCarrito($userId, $items, $request->only(['numeroTarjeta', 'nombreTitular', 'dniTitular']));

        foreach ($items as $item) {
            $moto = $item->moto;
            if ($moto) {
                $moto->stock -= $item->cantidad;
                $moto->save();
            }
        }

        CarritoItem::where('user_id', $userId)->delete();
        return redirect()->route('ventaConfirmada')->with('success', 'Compra realizada con éxito. ¡Gracias por tu compra!');
    }
}