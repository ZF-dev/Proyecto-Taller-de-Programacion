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

        $producto = Moto::select('id', 'precio', 'modelo', 'nombre')->find($productoId);
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
                'venta_id'              => null, // Queda nulo hasta que se procese el pago
                'moto_id'               => $productoId,
                'moto_modelo_historico' => $producto->modelo ?? $producto->nombre,
                'cantidad'              => $cantidad,
                'precio_unitario'       => $producto->precio,
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function mostrar()
    {
        $userId = auth()->id();
        
        $items = VentaItem::where('user_id', $userId)
                          ->whereNull('venta_id')
                          ->with(['moto' => fn($q) => $q->select('id', 'nombre', 'modelo', 'stock')])
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
}

