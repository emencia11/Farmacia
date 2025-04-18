@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Unidad de Medida</h2>

    <form action="{{ route('unidades-medida.update', $unidadMedida) }}" method="POST" class="w-50 mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $unidadMedida->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="conversion" class="form-label">Conversión (opcional)</label>
            <input type="number" name="conversion" class="form-control" value="{{ old('conversion', $unidadMedida->conversion) }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('unidades-medida.index') }}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
@endsection