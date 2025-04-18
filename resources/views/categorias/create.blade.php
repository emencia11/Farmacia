@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nueva Categoría</h2>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4"></textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>
@endsection