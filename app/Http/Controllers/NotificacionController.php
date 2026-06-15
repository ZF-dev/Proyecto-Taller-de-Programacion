<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Notificacion::orderBy('leido', 'asc')->orderByDesc('created_at');

        if ($request->tipo === 'consultas') {
            $query->whereNotNull('consulta'); // Solo las que vienen del formulario de contacto
        } elseif ($request->tipo === 'avisos') {
            $query->whereNull('consulta'); // Solo las alertas automáticas de stock/usuarios/ventas
        }

        $notificaciones = $query->paginate(10);
        $tipoActual = $request->tipo ?? 'todas';

        return view('Notificaciones', compact('notificaciones', 'tipoActual'));
    }

    public function enviarConsulta(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|max:150',
            'telefono' => 'nullable|string|max:20',
            'mensaje'  => 'required|string|max:1000',
        ]);

        Notificacion::create([
            'mensaje'  => "Nueva consulta de contacto recibida de: {$request->nombre}",
            'color'    => 'info', // Determina el color de la alerta visual (Bootstrap: info, warning, success)
            'leido'    => false,
            'consulta' => json_encode([
                'nombre'   => $request->nombre,
                'email'    => $request->email,
                'telefono' => $request->telefono ?? 'No especificado',
                'texto'    => $request->mensaje
            ])
        ]);

        return redirect()->back()->with('success', '¡Tu consulta fue enviada con éxito! Nos comunicaremos a la brevedad.');
    }

    // 3. Acción del Admin: Marcar como leída/respondida (Habilita el Prunable a los 15 días)
    public function marcarLeida($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        
        $notificacion->update([
            'leido' => true,
            'color' => 'secondary' // Cambia el color visual a gris para denotar que ya se archivó
        ]);

        return redirect()->back()->with('success', 'Notificación archivada con éxito.');
    }
}
