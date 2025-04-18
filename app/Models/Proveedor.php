<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores'; // 👈 ESPECIFICAMOS LA TABLA CORRECTA

    protected $fillable = ['nombre', 'telefono', 'direccion', 'email'];
}
