@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles de la Venta #{{ $venta->id }}</h2>
        <p><strong>Vendedor:</strong> {{ $venta->usuario->name }}</p>
        <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
        <p><strong>Fecha de Venta:</strong> {{ $venta->created_at->format('d-m-Y H:i') }}</p>

        <h3>Productos Vendidos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->medicamento->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('ventas.index') }}" class="btn btn-primary">Volver a la lista de ventas</a>
    </div>
@endsection