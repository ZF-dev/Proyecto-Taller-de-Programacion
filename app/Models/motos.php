<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nombre', 'marca_id', 'descripcion', 'precio', 'stock', 'imagen', 'activo'])]
class motos extends Model
{
    protected $table = 'motos';

    public function marca(){
        return $this->belongsTo(Marca::class);
    }
}
