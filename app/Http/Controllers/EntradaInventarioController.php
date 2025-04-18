<?php

namespace App\Http\Controllers;

use App\Models\EntradaInventario;
use App\Models\SalidaInventario;
use App\Models\Medicamento;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntradaInventarioController extends Controller
{
    public function create()
    {
        $medicamentos = Medicamento::all();
        $proveedores = Proveedor::all();
        return view('inventario.entradas.create', compact('medicamentos', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_medicamento' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'id_proveedor' => 'required',
        ]);
    
        // Crear la entrada
        $entrada = EntradaInventario::create([
            'id_medicamento' => $request->id_medicamento,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'id_usuario' => Auth::id(),
            'id_proveedor' => $request->id_proveedor,
            'tipo' => 'restock',
        ]);
    
        // Actualizar el stock del medicamento (sumar)
        $medicamento = Medicamento::findOrFail($request->id_medicamento);
        $medicamento->stock += $request->cantidad;
        $medicamento->save();
    
        return redirect()->route('inventario.index')->with('success', 'Entrada registrada con éxito.');
    }    

    public function edit($id)
    {
        $entrada = EntradaInventario::findOrFail($id);
        $medicamentos = Medicamento::all();
        $proveedores = Proveedor::all();
        return view('inventario.entradas.edit', compact('entrada', 'medicamentos', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $entrada = EntradaInventario::findOrFail($id);

        if (in_array($entrada->tipo, ['devolucion'])) {
            abort(403); // No se puede editar devolución automática
        }

        $entrada->update($request->only(['id_medicamento', 'cantidad', 'precio_unitario', 'id_proveedor']));

        return redirect()->route('inventario.index')->with('success', 'Entrada actualizada.');
    }

    public function destroy($id)
    {
        $entrada = EntradaInventario::findOrFail($id);

        if (in_array($entrada->tipo, ['devolucion'])) {
            abort(403);
        }

        $entrada->delete();
        return redirect()->route('inventario.index')->with('success', 'Entrada eliminada.');
    }

    public function inventarioIndex()
    {
        $entradas = EntradaInventario::with(['medicamento', 'usuario', 'proveedor'])->get();
        $salidas = SalidaInventario::with(['medicamento', 'usuario'])->get();

        return view('inventario.index', compact('entradas', 'salidas'));
    }

    public function show($tipo, $id)
    {
        if ($tipo === 'entrada') {
            $registro = EntradaInventario::with(['medicamento', 'usuario', 'proveedor'])->findOrFail($id);
        } elseif ($tipo === 'salida') {
            $registro = SalidaInventario::with(['medicamento', 'usuario'])->findOrFail($id);
        } else {
            abort(404);
        }

        return view('inventario.show', compact('registro', 'tipo'));
    }
}