<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class AdminVentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['usuario', 'items'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('VentasHistorial', compact('ventas'));
    }
}

