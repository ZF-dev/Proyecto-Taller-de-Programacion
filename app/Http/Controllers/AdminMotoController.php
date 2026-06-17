<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;
use App\Models\Marca;

class AdminMotoController extends Controller
{
    public function index()
    {
        $motos = Moto::orderBy('nombre')->paginate(10);
        return view('Inventario', compact('motos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'marca'       => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $marca = Marca::firstOrCreate([
            'nombre' => trim($request->marca)
        ]);

        Moto::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'stock'       => $request->stock,
            'marca_id'    => $marca->id, // 👈 CORREGIDO: Ahora nunca va a faltar este campo
            'activo'      => true,
        ]);

        return redirect()->back()->with('success', 'Moto añadida al catálogo correctamente.');
    }

    public function actualizarStock(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'operacion' => 'required|in:sumar,restar'
        ]);

        $moto = Moto::findOrFail($id);

        if ($request->operacion === 'sumar') {
            $moto->increment('stock', $request->cantidad);
        } else {
            if ($moto->stock < $request->cantidad) {
                return redirect()->back()->with('error', 'No podés restar más unidades de las que hay en stock.');
            }
            $moto->decrement('stock', $request->cantidad);
        }

        return redirect()->back()->with('success', 'Inventario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $moto = Moto::findOrFail($id);
        $moto->delete();

        return redirect()->back()->with('success', 'Moto eliminada del sistema.');
    }

    public function actualizarPrecio(Request $request, $id)
    {
        $request->validate([
            'precio' => 'required|numeric|min:0'
        ]);

        $moto = Moto::findOrFail($id);
        $moto->update(['precio' => $request->precio]);

        return redirect()->back()->with('success', "Precio de la unidad '{$moto->nombre}' actualizado con éxito.");
    }

    public function venderFisica(Request $request)
    {
        $request->validate([
            'moto_id'      => 'required|integer|exists:motos,id',
            'titular_pago' => 'required|string|max:255',
            'dni_pagador'  => 'required|integer|digits_between:7,9',
            'amount'       => 'nullable|integer|min:1', // Para compatibilidad por si mandan cantidad
        ]);

        $cantidad = $request->cantidad ?? 1;
        $moto = Moto::findOrFail($request->moto_id);

        if ($moto->stock < $cantidad) {
            return redirect()->back()->with('error', "No se pudo concretar la venta física. Stock disponible insuficiente ({$moto->stock} uds).");
        }

        $montoTotal = $moto->precio * $cantidad;

        \Illuminate\Support\Facades\DB::transaction(function () use ($moto, $montoTotal, $request, $cantidad) {
            
            $venta = \App\Models\Venta::create([
                'user_id'                  => auth()->id(), 
                'total'                    => $montoTotal,
                'metodo_pago'              => 'efectivo',
                'titular_pago'             => $request->titular_pago,
                'dni_pagador'              => $request->dni_pagador,
                'comprobante_transferencia'=> null,
                'tarjeta_ultimos_cuatro'   => null,
            ]);

            \App\Models\VentaItem::create([
                'user_id'               => auth()->id(),
                'venta_id'              => $venta->id,
                'moto_id'               => $moto->id,
                'moto_modelo_historico' => $moto->nombre,
                'cantidad'              => $cantidad,
                'precio_unitario'       => $moto->precio,
            ]);

            $moto->decrement('stock', $cantidad);
        });

        return redirect()->back()->with('success', "¡Venta de mostrador facturada con éxito! Se descontaron {$cantidad} unidades de '{$moto->nombre}'.");
    }
}
