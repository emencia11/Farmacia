@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Editar Salida del Inventario</h2>

    <form action="{{ route('inventario.salida.update', $salida->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_medicamento" class="form-label">Medicamento:</label>
            <select id="id_medicamento" name="id_medicamento" class="form-select" required>
                @foreach ($medicamentos as $med)
                    <option value="{{ $med->id }}" {{ $salida->id_medicamento == $med->id ? 'selected' : '' }}>
                        {{ $med->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ $salida->cantidad }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario:</label>
            <input type="number" id="precio_unitario" name="precio_unitario" class="form-control" value="{{ $salida->precio_unitario }}" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de salida:</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="daño" {{ $salida->tipo == 'daño' ? 'selected' : '' }}>Daño</option>
                <option value="vencimiento" {{ $salida->tipo == 'vencimiento' ? 'selected' : '' }}>Vencimiento</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('inventario.movimientos') }}" class="btn btn-secondary ms-2">Volver</a>
        </div>
    </form>
</div>
@endsection