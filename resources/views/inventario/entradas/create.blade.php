@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Nueva Entrada al Inventario</h2>

    <form action="{{ route('inventario.entrada.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_medicamento" class="form-label">Medicamento:</label>
            <select id="id_medicamento" name="id_medicamento" class="form-select" required>
                @foreach ($medicamentos as $med)
                    <option value="{{ $med->id }}">{{ $med->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario:</label>
            <input type="number" id="precio_unitario" name="precio_unitario" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label for="id_proveedor" class="form-label">Proveedor:</label>
            <select id="id_proveedor" name="id_proveedor" class="form-select" required>
                @foreach ($proveedores as $prov)
                    <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="restock">Reposición (Restock)</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Registrar Entrada</button>
            <a href="{{ route('inventario.movimientos') }}" class="btn btn-secondary ms-2">Volver</a>
        </div>
    </form>
</div>
@endsection