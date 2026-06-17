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
            'marca_id'    => $marca->id,
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
}
