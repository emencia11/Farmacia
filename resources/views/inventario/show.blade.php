@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de {{ ucfirst($tipo) }}</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>Medicamento:</strong> {{ $registro->medicamento->nombre }}</li>
        <li class="list-group-item"><strong>Cantidad:</strong> {{ $registro->cantidad }}</li>
        <li class="list-group-item"><strong>Precio Unitario:</strong> L {{ number_format($registro->precio_unitario, 2) }}</li>
        @if($tipo == 'entrada')
            <li class="list-group-item"><strong>Proveedor:</strong> {{ $registro->proveedor?->nombre ?? '—' }}</li>
        @else
            <li class="list-group-item"><strong>Tipo de salida:</strong> {{ ucfirst($registro->tipo) }}</li>
        @endif
        <li class="list-group-item"><strong>Usuario:</strong> {{ $registro->usuario->name }}</li>
    </ul>

    <a href="{{ route('inventario.movimientos') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection