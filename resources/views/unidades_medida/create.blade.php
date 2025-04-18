@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nueva Unidad de Medida</h2>

    <form action="{{ route('unidades-medida.store') }}" method="POST" class="w-50 mx-auto">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="conversion" class="form-label">Conversión (opcional)</label>
            <input type="number" name="conversion" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('unidades-medida.index') }}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection