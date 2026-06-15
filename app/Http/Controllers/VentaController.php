<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\VentaItem;
use App\Models\Moto;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Exception;

class VentaController extends Controller
{
    public function registrarVenta(Request $request)
    {
        $userId = auth()->id();

        // 1. Validación estricta en una sola pasada
        $request->validate([
            'metodo_pago'  => ['required', Rule::in(['tarjeta', 'transferencia', 'efectivo'])],
            'titular_pago' => ['required', 'string', 'max:255'],
            'dni_pagador'  => ['required', 'integer', 'digits_between:7,9'],
            'numeroTarjeta'=> ['required_if:metodo_pago,tarjeta', 'nullable', 'numeric', 'digits:16'],
            'comprobante'  => ['required_if:metodo_pago,transferencia', 'nullable', 'string', 'max:255'],
        ]);

        try {
            // 2. Traemos los ítems del carrito activo de este usuario
            $itemsCarrito = VentaItem::where('user_id', $userId)
                ->whereNull('venta_id')
                ->with(['moto' => fn($q) => $q->select('id', 'nombre', 'stock')])
                ->get();

            if ($itemsCarrito->isEmpty()) {
                return redirect()->back()->with('error', 'No se pudo procesar el pago porque tu carrito está vacío.');
            }

            $totalVenta = 0;
            $idsItemsAActualizar = [];
            $descuentosStock = [];

            foreach ($itemsCarrito as $item) {
                // CONTROL CRÍTICO DE STOCK: Evita sobreventas comerciales
                if (!$item->moto || $item->moto->stock < $item->cantidad) {
                    return redirect()->back()->with('error', "Operación cancelada. Stock insuficiente en el salón para la unidad: " . ($item->moto->nombre ?? 'Moto Seleccionada'));
                }

                // 🔒 IMPORTANTE: Forzamos el cálculo basado en el precio_unitario real guardado en tu VentaItem
                $totalVenta += ($item->precio_unitario * $item->cantidad);
                
                $idsItemsAActualizar[] = $item->id;
                $descuentosStock[$item->moto_id] = $item->cantidad;
            }

            // 3. Transacción SQL Segura y Atómica (Previene bloqueos de tablas y condiciones de carrera)
            DB::transaction(function () use ($userId, $totalVenta, $request, $idsItemsAActualizar, $descuentosStock) {
                
                // Creamos el ticket general en la tabla 'ventas'
                $venta = Venta::create([
                    'user_id'                  => $userId,
                    'total'                    => $totalVenta,
                    'metodo_pago'              => $request->metodo_pago,
                    'titular_pago'             => $request->titular_pago,
                    'dni_pagador'              => $request->dni_pagador,
                    'comprobante_transferencia'=> $request->metodo_pago === 'transferencia' ? $request->comprobante : null,
                    'tarjeta_ultimos_cuatro'   => $request->metodo_pago === 'tarjeta' ? substr($request->numeroTarjeta, -4) : null,
                ]);

                // ⚡ Pasamos las filas de estado "carrito" a estado "comprado" asignando el venta_id
                VentaItem::whereIn('id', $idsItemsAActualizar)->update([
                    'venta_id' => $venta->id
                ]);

                // ⚡ Descuento de stock directo en el motor de base de datos SQL (Altísima velocidad)
                foreach ($descuentosStock as $motoId => $cantidad) {
                    Moto::where('id', $motoId)->decrement('stock', $cantidad);
                }
            });

            return redirect()->route('finalizarCompra.vista')->with('success', '¡Compra web procesada con éxito total! Tu pedido ya está asentado en el sistema.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error inesperado al procesar el cobro en el servidor: ' . $e->getMessage());
        }
    }
}


