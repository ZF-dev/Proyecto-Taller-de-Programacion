<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'moto_id', 'cantidad', 'precio'])]

class CarritoItem extends Model
{
    protected $table = 'carrito_items';
    protected $fillable = ['user_id', 'moto_id', 'cantidad', 'precio'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function moto(): BelongsTo
    {
        return $this->belongsTo(motos::class);
    }
}
