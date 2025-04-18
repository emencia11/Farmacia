<?php

namespace App\Http\Controllers;

use App\Models\SalidaInventario;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalidaInventarioController extends Controller
{
    public function create()
    {
        $medicamentos = Medicamento::all();
        return view('inventario.salidas.create', compact('medicamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_medicamento' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'tipo' => 'required|in:daño,vencimiento',
        ]);
    
        // Registrar la salida de inventario
        $salida = SalidaInventario::create([
            'id_medicamento' => $request->id_medicamento,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'tipo' => $request->tipo,
            'id_usuario' => Auth::id(),
        ]);
    
        // Actualizar el stock del medicamento
        $medicamento = Medicamento::findOrFail($request->id_medicamento);
        
        // Verificamos si hay suficiente stock
        if ($medicamento->stock < $request->cantidad) {
            return redirect()->back()->with('error', 'No hay suficiente stock para esta salida.');
        }
    
        // Restar la cantidad que se ha salido del inventario
        $medicamento->stock -= $request->cantidad;
        $medicamento->save();
    
        return redirect()->route('inventario.index')->with('success', 'Salida registrada con éxito y stock actualizado.');
    }    

    public function edit($id)
    {
        $salida = SalidaInventario::findOrFail($id);

        if (in_array($salida->tipo, ['venta'])) {
            abort(403); // No se puede editar venta automática
        }

        $medicamentos = Medicamento::all();
        return view('inventario.salidas.edit', compact('salida', 'medicamentos'));
    }

    public function update(Request $request, $id)
    {
        $salida = SalidaInventario::findOrFail($id);

        if (in_array($salida->tipo, ['venta'])) {
            abort(403);
        }

        $salida->update($request->only(['id_medicamento', 'cantidad', 'precio_unitario', 'tipo']));
        return redirect()->route('inventario.index')->with('success', 'Salida actualizada.');
    }

    public function destroy($id)
    {
        $salida = SalidaInventario::findOrFail($id);

        if (in_array($salida->tipo, ['venta'])) {
            abort(403);
        }

        $salida->delete();
        return redirect()->route('inventario.index')->with('success', 'Salida eliminada.');
    }
}