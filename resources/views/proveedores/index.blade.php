@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Proveedores</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>
        @can('isRoot')
            <a href="{{ route('proveedores.create') }}" class="btn btn-primary">Nuevo Proveedor</a>
        @endcan
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td>
                        @can('isRoot')
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar proveedor?')">Eliminar</button>
                            </form>
                        @else
                            <span class="text-muted">Sin permisos</span>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection