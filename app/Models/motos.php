<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nombre', 'marca_id', 'descripcion', 'precio', 'stock', 'url_imagen', 'activo'])]
class motos extends Model
{
    public function marca(){
        return $this->belongsTo(Marca::class);
    }
}
