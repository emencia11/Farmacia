<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    protected $table = 'detalle_devoluciones'; // 👈 Asegura que use el nombre correcto

    protected $fillable = [
        'devolucion_id',
        'medicamento_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'motivo',
    ];

    public function devolucion()
    {
        return $this->belongsTo(Devolucion::class);
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}