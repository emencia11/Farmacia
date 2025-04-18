<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    protected $table = 'devoluciones'; // 👈 Esto soluciona el problema

    protected $fillable = [
        'id_usuario',
        'total',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleDevolucion::class);
    }
}