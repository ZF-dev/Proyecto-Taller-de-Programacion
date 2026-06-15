<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auditoria;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Casts;

#[Fillable(['nombre', 'marca_id', 'descripcion', 'precio', 'stock', 'imagen', 'activo'])]
#[Casts(['precio' => 'decimal:2', 'stock' => 'integer', 'activo' => 'boolean'])]

class Moto extends Model
{
    protected $table = 'motos';

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    protected static function booted()
    {
        static::created(function ($moto) {
            Auditoria::create([
                'user_id'        => auth()->id(),
                'accion'         => 'Alta de Producto',
                'tabla_afectada' => 'motos',
                'ip_address'     => request()->ip(),
                'detalles'       => json_encode([
                    'nombre' => $moto->nombre,
                    'precio' => $moto->precio,
                    'stock'  => $moto->stock
                ])
            ]);
        });

        static::updated(function ($moto) {
            $cambios = [];
            $esCambioStock = false;

            foreach ($moto->getDirty() as $campo => $valorNuevo) {
                $cambios[$campo] = [
                    'antes'   => $moto->getOriginal($campo),
                    'despues' => $valorNuevo
                ];
                if ($campo === 'stock') {
                    $esCambioStock = true;
                }
            }

            $accion = $esCambioStock ? 'Actualización de Inventario' : 'Modificación de Producto';

            Auditoria::create([
                'user_id'        => auth()->id(),
                'accion'         => $accion,
                'tabla_afectada' => 'motos',
                'ip_address'     => request()->ip(),
                'detalles'       => json_encode([
                    'nombre'  => $moto->nombre,
                    'cambios' => $cambios
                ])
            ]);

            if ($esCambioStock) {
                $stockViejo = $moto->getOriginal('stock');
                $stockNuevo = $moto->stock;

                if ($stockNuevo == 0 && $stockViejo > 0) {
                    \App\Models\Notificacion::create([
                        'mensaje'  => "🚨 CRÍTICO: La moto '{$moto->nombre}' se ha quedado SIN STOCK en el sistema.",
                        'color'    => 'danger',
                        'leido'    => false,
                        'consulta' => null
                    ]);
                }
                
                elseif ($stockNuevo <= 3 && $stockNuevo > 0 && $stockViejo > 3) {
                    \App\Models\Notificacion::create([
                        'mensaje'  => "⚠️ ADVERTENCIA: Stock bajo para '{$moto->nombre}'. Quedan solo {$stockNuevo} unidades.",
                        'color'    => 'warning',
                        'leido'    => false,
                        'consulta' => null
                    ]);
                }
            }
        });

        static::deleted(function ($moto) {
            Auditoria::create([
                'user_id'        => auth()->id(),
                'accion'         => 'Baja de Producto',
                'tabla_afectada' => 'motos',
                'ip_address'     => request()->ip(),
                'detalles'       => json_encode([
                    'nombre' => $moto->nombre,
                ])
            ]);
        });
    }
}
