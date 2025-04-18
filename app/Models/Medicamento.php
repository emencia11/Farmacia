<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_unidad_medida',
        'fecha_vencimiento',
        'stock',
        'precio_unitario',
        'id_categoria',
        'cantidad_por_empaque',
        'estado',
        'fecha_fabricacion',
        'id_proveedor',
    ];

    // Relación con la unidad de medida
    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'id_unidad_medida');
    }

    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // Relación con el proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}