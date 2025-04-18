<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaInventario extends Model
{
    use HasFactory;

    protected $table = 'salidas'; // nombre real de la tabla
    protected $fillable = [
        'id_medicamento',
        'cantidad',
        'precio_unitario',
        'id_usuario',
        'tipo'
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}