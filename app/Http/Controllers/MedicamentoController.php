<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Categoria;
use App\Models\UnidadMedida;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index()
    {
        // Cargamos medicamentos junto con sus relaciones
        $medicamentos = Medicamento::with(['categoria', 'unidadMedida', 'proveedor'])->get();

        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create()
    {
        // Cargar las categorías, unidades de medida y proveedores
        $categorias = Categoria::all();
        $unidades = UnidadMedida::all();
        $proveedores = Proveedor::all();

        return view('medicamentos.create', compact('categorias', 'unidades', 'proveedores'));
    }

    public function store(Request $request)
    {
        // Validaciones para el formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_unidad_medida' => 'required|exists:unidades_medida,id',
            'fecha_vencimiento' => 'required|date',
            'stock' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id',
            'cantidad_por_empaque' => 'required|integer',
            'estado' => 'nullable|string|in:activo,descontinuado',
            'fecha_fabricacion' => 'nullable|date',
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);

        // Crear el medicamento
        Medicamento::create($request->all());

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento creado exitosamente.');
    }

    public function edit($id)
    {
        // Cargar el medicamento y sus relaciones
        $medicamento = Medicamento::findOrFail($id);
        $categorias = Categoria::all();
        $unidades = UnidadMedida::all();
        $proveedores = Proveedor::all();

        return view('medicamentos.edit', compact('medicamento', 'categorias', 'unidades', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        // Validaciones para el formulario de actualización
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_unidad_medida' => 'required|exists:unidades_medida,id',
            'fecha_vencimiento' => 'required|date',
            'stock' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id',
            'cantidad_por_empaque' => 'required|integer',
            'estado' => 'nullable|string|in:activo,descontinuado',
            'fecha_fabricacion' => 'nullable|date',
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);

        // Actualizar el medicamento
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->update($request->all());

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado exitosamente.');
    }

    public function destroy($id)
    {
        // Eliminar el medicamento
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado exitosamente.');
    }
}