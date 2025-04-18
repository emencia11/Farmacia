<?php

namespace App\Http\Controllers;

use App\Models\EntradaInventario;
use App\Models\SalidaInventario;
use App\Models\Medicamento;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::all();
        return view('inventario.index', compact('medicamentos'));
    }
    // Este método ahora se encargará de pasar las entradas y salidas junto con los medicamentos
    public function verMovimientos()
    {
        // Obtener las entradas y salidas de la base de datos
        $entradas = EntradaInventario::with(['medicamento', 'usuario', 'proveedor'])->get();
        $salidas = SalidaInventario::with(['medicamento', 'usuario'])->get();

        // Pasar las variables a la vista
        return view('inventario.movimientos', compact('entradas', 'salidas'));
    }
}


