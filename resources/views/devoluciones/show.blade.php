@extends('layouts.app')

@section('content')
<h2>Detalle de Devolución #{{ $devolucion->id }}</h2>

<p><strong>Registrado por:</strong> {{ $devolucion->usuario->name }}</p>
<p><strong>Fecha:</strong> {{ $devolucion->created_at->format('d/m/Y H:i') }}</p>

<table class="table">
    <thead>
        <tr>
            <th>Medicamento</th>
            <th>Cantidad</th>
            <th>Motivo</th>
            <th>Precio Unitario</th>
            <th>Total Monto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($devolucion->detalles as $detalle)
            <tr>
                <td>{{ $detalle->medicamento->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->motivo ?? '—' }}</td>
                <td>${{ number_format($detalle->medicamento->precio_unitario, 2) }}</td>
                <td>${{ number_format($detalle->cantidad * $detalle->medicamento->precio_unitario, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p>
    <strong>Medicamentos Devueltos:</strong> 
    {{ $devolucion->detalles->unique('medicamento_id')->count() }} medicamentos, 
    {{ $devolucion->detalles->sum('cantidad') }} unidades devueltas.
</p>
<p>
    <strong>Total Monto Devuelto:</strong> 
    ${{ number_format($devolucion->detalles->sum(function($detalle) {
        return $detalle->cantidad * $detalle->medicamento->precio_unitario;
    }), 2) }}
</p>

<a href="{{ route('devoluciones.index') }}" class="btn btn-secondary">Volver</a>
@endsection