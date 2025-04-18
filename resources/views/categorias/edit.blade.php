@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Categoría</h2>

    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ $categoria->descripcion }}</textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>
@endsection