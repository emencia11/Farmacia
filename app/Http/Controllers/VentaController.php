<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Medicamento;
use App\Models\SalidaInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('usuario')->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $this->authorize('canCreateVentas');
        $medicamentos = Medicamento::all();
        return view('ventas.create', compact('medicamentos'));
    }

    public function store(Request $request)
    {
        $this->authorize('canCreateVentas');

        $request->validate([
            'medicamentos.*.id' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
        
            // Crear la venta
            $venta = Venta::create([
                'id_usuario' => Auth::id(),
                'total' => 0, // Temporal, se actualizará después
            ]);

            foreach ($request->medicamentos as $item) {
                $medicamento = Medicamento::find($item['id']);
                $cantidad = $item['cantidad'];
                $precio_unitario = $medicamento->precio_unitario;
                $subtotal = $precio_unitario * $cantidad;

                // Registrar detalle de la venta
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'medicamento_id' => $medicamento->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal,
                ]);

                // Registrar la salida de inventario
                SalidaInventario::create([
                    'id_medicamento' => $medicamento->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'id_usuario' => Auth::id(),
                    'tipo' => 'venta',
                ]);

                // Actualizar el stock del medicamento
                $medicamento->stock -= $cantidad;  // Restar la cantidad vendida
                $medicamento->save();

                // Acumular el total de la venta
                $total += $subtotal;
            }

            // Actualizar el total de la venta
            $venta->update(['total' => $total]);
        });

        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
    }

    public function show($id)
    {
        $venta = Venta::with('detalles.medicamento')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }
}