<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\DetalleDevolucion;
use App\Models\Medicamento;
use App\Models\EntradaInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevolucionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->can('gestionar-devoluciones')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $devoluciones = Devolucion::with('usuario')->latest()->get();
        return view('devoluciones.index', compact('devoluciones'));
    }

    public function create()
    {
        $medicamentos = Medicamento::all();
        return view('devoluciones.create', compact('medicamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicamentos.*.id_medicamento' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
            'medicamentos.*.motivo' => 'nullable|string|max:255',
        ]);
    
        $total = 0;
        $detalles = [];
    
        foreach ($request->medicamentos as $detalle) {
            $medicamento = Medicamento::find($detalle['id_medicamento']);
    
            if (!$medicamento) continue;
    
            $precio = $medicamento->precio_unitario ?? 0;
            $cantidad = $detalle['cantidad'];
            $subtotal = $precio * $cantidad;
    
            $total += $subtotal;
    
            $detalles[] = [
                'medicamento' => $medicamento,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'subtotal' => $subtotal,
                'motivo' => $detalle['motivo'] ?? null,
            ];
        }
    
        if (count($detalles) === 0) {
            return back()->with('error', 'No se pudo procesar la devolución.');
        }
    
        $devolucion = Devolucion::create([
            'id_usuario' => Auth::id(),
            'total' => $total,
        ]);
    
        foreach ($detalles as $d) {
            DetalleDevolucion::create([
                'devolucion_id' => $devolucion->id,
                'medicamento_id' => $d['medicamento']->id,
                'cantidad' => $d['cantidad'],
                'precio_unitario' => $d['precio'],
                'subtotal' => $d['subtotal'],
                'motivo' => $d['motivo'],
            ]);
    
            // Sumar al stock
            $d['medicamento']->stock += $d['cantidad'];
            $d['medicamento']->save();
    
            // Registrar entrada
            EntradaInventario::create([
                'id_medicamento' => $d['medicamento']->id,
                'cantidad' => $d['cantidad'],
                'precio_unitario' => $d['precio'],
                'tipo' => 'devolucion',
                'id_usuario' => Auth::id(),
            ]);
        }
    
        return redirect()->route('devoluciones.index')->with('success', 'Devolución registrada con éxito.');
    }    

    public function show($id)
    {
        $devolucion = Devolucion::with(['usuario', 'detalles.medicamento'])->findOrFail($id);
        return view('devoluciones.show', compact('devolucion'));
    }
}