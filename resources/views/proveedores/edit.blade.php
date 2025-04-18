@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Editar Proveedor</h1>

    <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre">Nombre *</label>
            <input type="text" name="nombre" id="nombre" value="{{ $proveedor->nombre }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ $proveedor->telefono }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="{{ $proveedor->direccion }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $proveedor->email }}" class="form-control">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>
@endsection