<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nombre'])]

class Marca extends Model
{

    protected $table = 'marcas';

    public function motos(){
        return $this->hasMany(Moto::class);
    }
}
