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
                'venta_id'              => null, 
                'moto_id'               => $productoId,
                'moto_modelo_historico' => $producto->nombre, 
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

        $item = VentaItem::where('user_id', $userId)
                        ->whereNull('venta_id')
                        ->where('moto_id', $request->producto_id)
                        ->with('moto')
                        ->first();

        if (!$item) {
            if ($request->ajax()) {
                return response()->json(['error' => 'El producto no está en tu carrito.'], 404);
            }
            return redirect()->back()->with('error', 'El producto no está en tu carrito.');
        }

        $removido = false;

        if ($request->accion === 'sumar') {
            if ($item->moto && $item->cantidad >= $item->moto->stock) {
                if ($request->ajax()) {
                    return response()->json(['error' => "Stock máximo alcanzado ({$item->moto->stock} uds)."], 422);
                }
                return redirect()->back()->with('error', "No podés agregar más. Stock máximo alcanzado.");
            }
            $item->increment('cantidad', 1);
        } else {
            if ($item->cantidad <= 1) {
                $item->delete();
                $removido = true;
            } else {
                $item->decrement('cantidad', 1);
            }
        }

        if ($request->ajax()) {
            $todosLosItems = VentaItem::where('user_id', $userId)->whereNull('venta_id')->get();
            $nuevoTotalCarrito = $todosLosItems->sum(fn($i) => $i->precio_unitario * $i->cantidad);
            $nuevoConteoCarrito = $todosLosItems->sum('cantidad');

            return response()->json([
                'success'        => true,
                'cantidad'       => $removido ? 0 : $item->fresh()->cantidad,
                'subtotal'       => $removido ? 0 : ($item->fresh()->precio_unitario * $item->fresh()->cantidad),
                'totalCarrito'   => $nuevoTotalCarrito,
                'conteoCarrito'  => $nuevoConteoCarrito,
                'removido'       => $removido
            ]);
        }

        return redirect()->back()->with('success', 'Cantidad actualizada.');
    }
}

