@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📦 Inventario General de la Farmacia</h2>

    <div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>
        <a href="{{ route('inventario.movimientos') }}" class="btn btn-primary">Ver Entradas y Salidas</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Medicamento</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Unidad</th>
                    <th>Proveedor</th>
                    <th>Stock</th>
                    <th>Cantidad x Empaque</th>
                    <th>Precio Referencial</th>
                    <th>Estado</th>
                    <th>F. Fabricación</th>
                    <th>F. Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicamentos as $med)
                    <tr class="{{ $med->stock == 0 ? 'table-danger' : '' }}">
                        <td>{{ $med->nombre }}</td>
                        <td>{{ $med->descripcion }}</td>
                        <td>{{ $med->categoria->nombre ?? '—' }}</td>
                        <td>{{ $med->unidadMedida->nombre ?? '—' }}</td>
                        <td>{{ $med->proveedor->nombre ?? '—' }}</td>
                        <td>{{ $med->stock }}</td>
                        <td>{{ $med->cantidad_por_empaque }}</td>
                        <td>L {{ number_format($med->precio_referencial ?? $med->precio_unitario ?? 0, 2) }}</td>
                        <td>
                            @if ($med->estado === 'activo')
                                <span class="badge bg-success">Activo</span>
                            @elseif ($med->estado === 'inactivo')
                                <span class="badge bg-secondary">Inactivo</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ ucfirst($med->estado) }}</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($med->fecha_fabricacion)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($med->fecha_vencimiento)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection