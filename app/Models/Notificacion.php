<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Prunables;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Casts;

#[Fillable(['mensaje', 'color', 'leido'])]
#[Casts(['leido' => 'boolean'])]

class Notificacion extends Model
{
    use Prunables;
    
    protected $table = 'notificaciones';


    public function prunable(): Builder
    {
        return static::where('leido', true)
                     ->where('created_at', '<=', now()->subDays(15));
    }
    
}
