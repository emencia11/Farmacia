@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ventas Registradas</h2>

        <div class="d-flex justify-content-start mb-3 gap-2">
            <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
                <i class="bi bi-house-door-fill me-2 text-primary"></i> 
                <span>Menú Principal</span>
            </a>
            <a href="{{ route('ventas.create') }}" class="btn btn-success">Registrar Nueva Venta</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->usuario->name }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                        <td>{{ $venta->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection