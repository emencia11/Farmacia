<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'rol', 'activo',
    ];    

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Método para obtener el rol del usuario
    public function isRoot()
    {
        return $this->rol === 'root';
    }

    public function isVendedor()
    {
        return $this->rol === 'vendedor';
    }
}
