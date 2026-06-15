<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\VentaItem;
use App\Models\Moto;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VentaController extends Controller
{
    public function registrarVenta(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'metodo_pago'  => ['required', Rule::in(['tarjeta', 'transferencia', 'efectivo'])],
            'titular_pago' => ['required', 'string', 'max:255'],
            'dni_pagador'  => ['required', 'integer', 'digits_between:7,9'],
            'numeroTarjeta'=> ['required_if:metodo_pago,tarjeta', 'nullable', 'numeric', 'digits:16'],
            'comprobante'  => ['required_if:metodo_pago,transferencia', 'nullable', 'string', 'max:255'],
        ]);

        $itemsCarrito = VentaItem::where('user_id', $userId)
            ->whereNull('venta_id')
            ->with(['moto' => fn($q) => $q->select('id', 'nombre', 'stock')])
            ->cursor();

        if ($itemsCarrito->isEmpty()) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        $totalVenta = 0;
        $idsItemsAActualizar = [];
        $descuentosStock = [];

        foreach ($itemsCarrito as $item) {
            if (!$item->moto || $item->moto->stock < $item->cantidad) {
                return redirect()->back()
                    ->with('error', "Stock insuficiente para: " . ($item->moto->nombre ?? 'Producto'));
            }

            $totalVenta += ($item->precio_unitario * $item->cantidad);
        
            $idsItemsAActualizar[] = $item->id;

            $descuentosStock[$item->moto_id] = $item->cantidad;
        }

        DB::transaction(function () use ($userId, $totalVenta, $request, $idsItemsAActualizar, $descuentosStock) {
            
            // Creamos la cabecera de la Venta
            $venta = Venta::create([
                'user_id'                  => $userId,
                'total'                    => $totalVenta,
                'metodo_pago'              => $request->metodo_pago,
                'titular_pago'             => $request->titular_pago,
                'dni_pagador'              => $request->dni_pagador,
                'comprobante_transferencia'=> $request->metodo_pago === 'transferencia' ? $request->comprobante : null,
                'tarjeta_ultimos_cuatro'   => $request->metodo_pago === 'tarjeta' ? substr($request->numeroTarjeta, -4) : null,
            ]);

            VentaItem::whereIn('id', $idsItemsAActualizar)->update([
                'venta_id' => $venta->id
            ]);

            foreach ($descuentosStock as $motoId => $cantidad) {
                Moto::where('id', $motoId)->decrement('stock', $cantidad);
            }
        });

        return redirect()->route('ventaConfirmada')->with('success', '¡Compra procesada con éxito!');
    }
}
