<?php

namespace App\Http\Controllers;

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

        // Obtener productos desde config
        $productos = config('productos');
        $producto = collect($productos)->firstWhere('id', $productoId);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Obtener carrito de la sesión
        $carrito = session('carrito', []);

        // Agregar o actualizar cantidad
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += $cantidad;
        } else {
            $carrito[$productoId] = [
                'id' => $productoId,
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'imagen' => $producto['imagen'],
                'cantidad' => $cantidad,
            ];
        }

        // Guardar en sesión
        session(['carrito' => $carrito]);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function mostrar()
    {
        $carrito = session('carrito', []);
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return view('carrito', compact('carrito', 'total'));
    }

    public function eliminar(Request $request)
    {
        $request->validate(['producto_id' => 'required|integer']);
        $carrito = session('carrito', []);
        unset($carrito[$request->producto_id]);
        session(['carrito' => $carrito]);
        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
