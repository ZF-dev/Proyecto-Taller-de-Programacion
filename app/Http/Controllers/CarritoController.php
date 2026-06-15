<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\VentaItem;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $productoId = $request->producto_id;
        $cantidad = $request->cantidad;

        $producto = Moto::select('id', 'precio','descripcion', 'nombre', 'imagen')->find($productoId);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        $userId = auth()->id();

        $item = VentaItem::where('user_id', $userId)
                         ->whereNull('venta_id')
                         ->where('moto_id', $productoId)
                         ->first();

        if ($item) {
            $item->increment('cantidad', $cantidad);
        } else {
            VentaItem::create([
                'user_id'               => $userId,
                'venta_id'              => null, // Queda nulo hasta que pase por el VentaController
                'moto_id'               => $productoId,
                'moto_modelo_historico' => $producto->nombre, // ➔ TEXTO (ej: Dominar 250)
                'cantidad'              => $cantidad,         // ➔ NÚMERO DE UNIDADES (ej: 1, 2)
                'precio_unitario'       => $producto->precio, // ➔ DINERO EN PESOS (ej: 7150000.00)
            ]);

        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function mostrar()
    {
        $userId = auth()->id();
        
        $items = VentaItem::where('user_id', $userId)
                          ->whereNull('venta_id')
                          ->with(['moto' => fn($q) => $q->select('id', 'nombre', 'stock', 'imagen', 'precio')])
                          ->get();
                            
        $total = $items->sum(fn ($item) => $item->precio_unitario * $item->cantidad);

        return view('carrito', ['carrito' => $items, 'total' => $total]);
    }

    public function eliminar(Request $request)
    {
        $request->validate(['producto_id' => 'required|integer']);

        $userId = auth()->id();

        VentaItem::where('user_id', $userId)
                 ->whereNull('venta_id')
                 ->where('moto_id', $request->producto_id)
                 ->delete();

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function modificarCantidad(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'accion'      => 'required|in:sumar,restar'
        ]);

        $userId = auth()->id();

        // Buscamos el ítem activo en el carrito de este usuario
        $item = VentaItem::where('user_id', $userId)
                        ->whereNull('venta_id')
                        ->where('moto_id', $request->producto_id)
                        ->with('moto')
                        ->first();

        if (!$item) {
            return redirect()->back()->with('error', 'El producto no está en tu carrito.');
        }

        if ($request->accion === 'sumar') {
            // Control de seguridad: No permitir sumar más de lo que hay en stock físico
            if ($item->moto && $item->cantidad >= $item->moto->stock) {
                return redirect()->back()->with('error', "No podés agregar más. Stock máximo alcanzado ({$item->moto->stock} uds).");
            }
            $item->increment('cantidad', 1);
        } else {
            // Si tiene 1 sola unidad y le da a restar, lo eliminamos de forma limpia
            if ($item->cantidad <= 1) {
                $item->delete();
                return redirect()->back()->with('success', 'Producto removido del carrito.');
            }
            $item->decrement('cantidad', 1);
        }

        return redirect()->back()->with('success', 'Cantidad actualizada.');
    }
}

