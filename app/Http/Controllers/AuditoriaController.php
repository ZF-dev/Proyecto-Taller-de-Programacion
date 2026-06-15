<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    public function index()
    {
        $auditorias = Auditoria::with('user')
            ->orderByDesc('created_at')
            ->paginate(20); // Muestra de a 20 registros por página

        return view('Auditoria', compact('auditorias'));
    }
}

