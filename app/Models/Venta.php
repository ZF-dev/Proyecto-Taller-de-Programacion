<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Casts;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'total', 'metodo_pago', 'comprobante_transferencia', 'tarjeta_ultimos_cuatro', 'titular_pago', 'dni_pagador'])]
#[Casts(['total' => 'decimal:2', 'user_id' => 'integer', 'dni_pagador' => 'integer'])]
class Venta extends Model
{
    protected $table = 'ventas';

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación directa con sus motos compradas
    public function items(): HasMany
    {
        return $this->hasMany(VentaItem::class, 'venta_id');
    }

    protected static function booted()
    {
        // 💰 Escucha la creación exitosa de una venta comercial
        static::created(function ($venta) {
            Auditoria::create([
                'user_id'        => auth()->id(), // ID del cliente si compró por la web, o del Admin si fue venta física
                'accion'         => 'Cierre de Venta Comercial',
                'tabla_afectada' => 'ventas',
                'ip_address'     => request()->ip(),
                'detalles'       => json_encode([
                    'venta_id'    => $venta->id,
                    'total'       => $venta->total,
                    'metodo_pago' => $venta->metodo_pago,
                    'comprador'   => $venta->titular_pago ?? 'Cliente General'
                ])
            ]);

            \App\Models\Notificacion::create([
                'mensaje'  =>  "💰 ¡Venta Online Procesada! Cobro de $" . number_format($venta->total, 2, ',', '.') . " mediante " . strtoupper($venta->metodo_pago),
                'color'    => 'success', // Verde
                'leido'    => false,
                'consulta' => null
            ]);
        });

    }
}


