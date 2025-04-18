<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        $unidades = UnidadMedida::all();
        return view('unidades_medida.index', compact('unidades'));
    }

    public function create()
    {
        if (!Gate::allows('canCreateUnidades')) abort(403);
        return view('unidades_medida.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('canCreateUnidades')) abort(403);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'conversion' => 'nullable|integer',
        ]);

        UnidadMedida::create($request->all());

        return redirect()->route('unidades-medida.index')->with('success', 'Unidad de medida creada correctamente.');
    }

    public function edit(UnidadMedida $unidadMedida)
    {
        if (!Gate::allows('canEditUnidades')) abort(403);
        return view('unidades_medida.edit', compact('unidadMedida'));
    }

    public function update(Request $request, UnidadMedida $unidadMedida)
    {
        if (!Gate::allows('canEditUnidades')) abort(403);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'conversion' => 'nullable|integer',
        ]);

        // Actualizar la unidad de medida
        $unidadMedida->update($request->only('nombre', 'conversion'));

        return redirect()->route('unidades-medida.index')->with('success', 'Unidad de medida actualizada correctamente.');
    }

    public function destroy($id)
    {
        $unidadMedida = UnidadMedida::findOrFail($id);
        $unidadMedida->delete();

        return redirect()->route('unidades-medida.index')->with('success', 'Unidad de medida eliminada.');
    }
}