@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Categorías</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>
        @can('canCreateCategorias')
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nueva Categoría</a>
        @endcan
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td class="text-center">{{ $categoria->nombre }}</td>
                    <td class="text-center">{{ $categoria->descripcion }}</td>
                    <td class="text-center">
                        @can('canEditCategorias')
                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning mx-1">Editar</a>
                        @endcan

                        @can('isRoot')
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Estás seguro?')" class="btn btn-sm btn-danger mx-1">Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection