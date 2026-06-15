<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Casts;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id','venta_id', 'moto_id', 'moto_modelo_historico', 'cantidad', 'precio_unitario'])]
#[Casts(['precio_unitario' => 'decimal:2', 'cantidad' => 'integer', 'user_id' => 'integer'])]
class VentaItem extends Model
{
    protected $table = 'venta_items';

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class);
    }

    public function moto(): BelongsTo
    {
        return $this->belongsTo(Moto::class);
    }
}

