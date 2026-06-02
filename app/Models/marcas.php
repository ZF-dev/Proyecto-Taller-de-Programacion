<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nombre'])]

class marcas extends Model
{
    public function motos(){
        return $this->hasMany(Moto::class);
    }
}
