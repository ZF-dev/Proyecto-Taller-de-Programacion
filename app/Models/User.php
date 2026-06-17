<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Casts;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email', 'password', 'role', 'dni', 'fecha_nacimiento'])]
#[Hidden(['password', 'remember_token'])]
#[Casts(['email_verified_at' => 'datetime', 'password' => 'hashed', 'fecha_nacimiento' => 'date', 'dni' => 'integer'])]
class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    
    protected $table = 'users';

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    protected static function booted()
    {
        static::created(function ($usuarioCreado) {
            $accion = $usuarioCreado->role === 'admin' ? 'Alta de Administrador' : 'Alta de Usuario';
            
            Auditoria::create([
                'user_id'        => auth()->id(), // Admin que ejecutó la acción
                'accion'         => $accion,
                'tabla_afectada' => 'users',
                'ip_address'     => request()->ip(),
                'detalles'       => json_encode([
                    'usuario_afectado' => $usuarioCreado->name,
                    'email'            => $usuarioCreado->email,
                    'rol_asignado'     => $usuarioCreado->role
                ])
            ]);

            if ($usuarioCreado->role === 'user') {
                \App\Models\Notificacion::create([
                    'mensaje'  => "🎉 ¡Nuevo cliente registrado! Bienvenido al sistema, {$usuarioCreado->name}.",
                    'color'    => 'success',
                    'leido'    => false,
                    'consulta' => null
                ]);
            }
        });

        static::updated(function ($usuarioModificado) {
            if ($usuarioModificado->wasChanged('role')) {
                Auditoria::create([
                    'user_id'        => auth()->id(),
                    'accion'         => 'Modificación de Privilegios (Seguridad)',
                    'tabla_afectada' => 'users',
                    'ip_address'     => request()->ip(),
                    'detalles'       => json_encode([
                        'usuario_afectado' => $usuarioModificado->name,
                        'rol_anterior'     => $usuarioModificado->getOriginal('role'),
                        'rol_nuevo'        => $usuarioModificado->role
                    ]) 
                ]);
            }
        });

        static::deleted(function ($usuarioEliminado) {
            $accion = $usuarioEliminado->role === 'admin' ? 'Baja de Administrador' : 'Baja de Usuario';

            Auditoria::create([
                'user_id'        => auth()->id(),
                'accion'         => $accion,
                'tabla_afectada' => 'users',
                'ip_address'     => request()->ip(),
                'detalles'       => json_encode([
                    'usuario_eliminado' => $usuarioEliminado->name,
                    'email'             => $usuarioEliminado->email
                ])
            ]);
        });
    }
}
