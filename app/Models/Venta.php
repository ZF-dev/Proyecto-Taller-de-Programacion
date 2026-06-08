<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'descripcion', 'total', 'tarjeta', 'metodoPago', 'titularTarjeta', 'DNITitular'])]
#[casts(['total' => 'decimal:2'])]

class Venta extends Model
{
    protected $table = 'ventas';
    protected $fillable = ['user_id', 'descripcion', 'total', 'tarjeta', 'metodoPago', 'titularTarjeta', 'DNITitular'];

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function crearDesdeCarrito($userId, $items, $datosTarjeta){
        $total = $items->sum(fn ($item) => $item->precio * $item->cantidad);
        $descripcion = $items->pluck('moto.nombre')->implode(', ');

        return self::create([
            'user_id' => $userId,
            'descripcion' => $descripcion,
            'total' => $total,
            'tarjeta' => $datosTarjeta['numeroTarjeta'],
            'metodoPago' => 'tarjeta',
            'titularTarjeta' => $datosTarjeta['nombreTitular'],
            'DNITitular' => $datosTarjeta['dniTitular'],
        ]);
    }

}
