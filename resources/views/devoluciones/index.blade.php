@extends('layouts.app')

@section('content')
<h2>Historial de Devoluciones</h2>

<div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>
    @can('gestionar-devoluciones')
        <a href="{{ route('devoluciones.create') }}" class="btn btn-primary">Registrar Devolución</a>
    @endcan
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Registrado por</th>
            <th>Fecha</th>
            <th>Medicamentos Devueltos</th>
            <th>Total Monto Devuelto</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($devoluciones as $dev)
            <tr>
                <td>{{ $dev->id }}</td>
                <td>{{ $dev->usuario->name }}</td>
                <td>{{ $dev->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    {{ $dev->detalles->unique('medicamento_id')->count() }} medicamentos, 
                    {{ $dev->detalles->sum('cantidad') }} unidades
                </td>
                <td>
                    ${{ number_format($dev->detalles->sum(function($detalle) {
                        return $detalle->cantidad * $detalle->medicamento->precio_unitario;
                    }), 2) }}
                </td>
                <td>
                    <a href="{{ route('devoluciones.show', $dev->id) }}" class="btn btn-sm btn-secondary">Ver</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection