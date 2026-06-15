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
        // 👥 Creación de un nuevo usuario/admin desde el panel administrativo
        static::created(function ($usuarioCreado) {
            $accion = $usuarioCreado->role === 'admin' ? 'Alta de Administrador' : 'Alta de Usuario';
            
            Auditoria::create([
                'user_id'        => auth()->id(), // Admin que ejecutó la acción
                'accion'         => $accion,
                'tabla_afectada' => 'users',
                'ip_address'     => request()->ip(),
                'detalles'       => [
                    'usuario_afectado' => $usuarioCreado->name,
                    'email'            => $usuarioCreado->email,
                    'rol_asignado'     => $usuarioCreado->role
                ]
            ]);

            if ($usuarioCreado->role === 'user') {
                \App\Models\Notificacion::create([
                    'mensaje'  => "🎉 ¡Nuevo cliente registrado! Bienvenido al sistema, {$usuarioCreado->name}.",
                    'color'    => 'success', // Verde en Bootstrap
                    'leido'    => false,
                    'consulta' => null
                ]);
            }
        });

        // 🔐 Modificación de perfil o alteración de Roles (Escalación de Privilegios)
        static::updated(function ($usuarioModificado) {
            // Si el campo que cambió fue el rol, es un evento crítico de seguridad
            if ($usuarioModificado->wasChanged('role')) {
                Auditoria::create([
                    'user_id'        => auth()->id(),
                    'accion'         => 'Modificación de Privilegios (Seguridad)',
                    'tabla_afectada' => 'users',
                    'ip_address'     => request()->ip(),
                    'detalles'       => [
                        'usuario_afectado' => $usuarioModificado->name,
                        'rol_anterior'     => $usuarioModificado->getOriginal('role'),
                        'rol_nuevo'        => $usuarioModificado->role
                    ]
                ]);
            }
        });

        // ❌ Eliminación de una cuenta desde el panel
        static::deleted(function ($usuarioEliminado) {
            $accion = $usuarioEliminado->role === 'admin' ? 'Baja de Administrador' : 'Baja de Usuario';

            Auditoria::create([
                'user_id'        => auth()->id(),
                'accion'         => $accion,
                'tabla_afectada' => 'users',
                'ip_address'     => request()->ip(),
                'detalles'       => [
                    'usuario_eliminado' => $usuarioEliminado->name,
                    'email'             => $usuarioEliminado->email
                ]
            ]);
        });
    }
}
