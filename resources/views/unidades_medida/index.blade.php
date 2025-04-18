@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Unidades de Medida</h2>

    <div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>
        @can('canCreateUnidades')
            <a href="{{ route('unidades-medida.create') }}" class="btn btn-primary">Nueva Unidad</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Conversión</th>
                    @can('canEditUnidades')
                        <th style="width: 200px;">Acciones</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($unidades as $unidad)
                <tr class="text-center">
                    <td>{{ $unidad->nombre }}</td>
                    <td>{{ $unidad->conversion ?? '-' }}</td>
                    @can('canEditUnidades')
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('unidades-medida.edit', $unidad) }}" class="btn btn-sm btn-warning">Editar</a>
                            @can('isRoot')
                            <form action="{{ route('unidades-medida.destroy', $unidad->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta unidad de medida?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                            @endcan
                        </div>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection