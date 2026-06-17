<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moto;
use App\Models\Marca;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $marcas = Marca::orderBy('nombre')->get();

        $marcaSeleccionada = $request->query('marca');

        $query = Moto::where('activo', true)->with('marca');

        if ($marcaSeleccionada) {
            $query->where('marca_id', $marcaSeleccionada);
        }

        $motos = $query->orderBy('nombre')->paginate(9);

        return view('Catalogo', compact('motos', 'marcas', 'marcaSeleccionada'));
    }
}

