<?php

namespace App\Http\Controllers;

use App\Models\motos;
use App\Models\CarritoItem;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
        ]);

        $productoId = $request->producto_id;
        $cantidad = $request->cantidad;

        $producto = motos::find($productoId);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        $userId = auth()->id();

        $item = CarritoItem::where('user_id', $userId)
                           ->where('moto_id', $productoId)
                           ->first();

        if ($item) {
            $item->update(['cantidad' => $item->cantidad + $cantidad]);
        } else {
            CarritoItem::create([
                'user_id' => $userId,
                'moto_id' => $productoId,
                'cantidad' => $cantidad,
                'precio' => $producto->precio,
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function mostrar()
    {
        $userId = auth()->id();
        $items = CarritoItem::where('user_id', $userId)
                            ->with('moto')
                            ->get();
                            
        $total = $items->sum(fn ($item) => $item->precio * $item->cantidad);

        return view('carrito', ['carrito' => $items, 'total' => $total]);
    }

    public function eliminar(Request $request)
    {
        $request->validate(['producto_id' => 'required|integer']);

        $userId = auth()->id();

        CarritoItem::where('user_id', $userId)
                   ->where('moto_id', $request->producto_id)
                   ->delete();

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
