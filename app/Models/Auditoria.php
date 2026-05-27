<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Casts;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'accion', 'tabla_afectada', 'detalles', 'ip_address', 'created_at'])]
#[Casts(['detalles' => 'array', 'created_at' => 'datetime'])]

class Auditoria extends Model
{
    public $timestamps = false; 

    protected $table = 'auditorias';


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Sistema Automático' // Si user_id es null, muestra esto
        ]);
    }
}

