<?php

namespace App\Http\Controllers;

use App\Models\motos;
use App\Models\marcas;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function mostrar(Request $request)
    {
        // Obtener todas las marcas para el filtro
        $marcas = marcas::all();
        $marcaSeleccionada = $request->input('marca', '');
        
        // Iniciar query de motos activas
        $query = motos::where('activo', true);
        
        // Filtrar por marca si se proporciona
        if (!empty($marcaSeleccionada)) {
            $query->where('marca_id', intval($marcaSeleccionada));
        }
        
        // Paginar resultados (9 por página para mantener el grid 3x3)
        $motos = $query->paginate(9);
        
        return view('Catalogo', [
            'motos' => $motos,
            'marcas' => $marcas,
            'marcaSeleccionada' => $marcaSeleccionada,
        ]);
    }
}
