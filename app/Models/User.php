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

#[Fillable(['name', 'email', 'password', 'role', 'DNI', 'fecha_nacimiento'])]
#[Hidden(['password', 'remember_token'])]
#[Casts(['email_verified_at' => 'datetime', 'password' => 'hashed', 'fecha_nacimiento' => 'date', 'DNI' => 'long'])]
class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    
     * @return array<string, string>
     */
    
    protected $table = 'users';

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
