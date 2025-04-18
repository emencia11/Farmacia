@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Lista de Medicamentos</h1>

    <div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>
        <a href="{{ route('medicamentos.create') }}" class="btn btn-primary">Agregar Medicamento</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Unidad de Medida</th>
                    <th>Proveedor</th>
                    <th>Stock</th>
                    <th>Cantidad por Empaque</th>
                    <th style="width: 500px;">Precio Unitario</th>
                    <th style="width: 10px;">Estado</th>
                    <th style="width: 110px;">Fabricación</th>
                    <th>Vencimiento</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicamentos as $medicamento)
                    <tr class="text-center">
                        <td class="text-start">{{ $medicamento->nombre }}</td>
                        <td class="text-start">{{ $medicamento->descripcion }}</td>
                        <td>{{ $medicamento->categoria->nombre }}</td>
                        <td>{{ $medicamento->unidadMedida->nombre }}</td>
                        <td>{{ $medicamento->proveedor->nombre }}</td>
                        <td>{{ $medicamento->stock }}</td>
                        <td>{{ $medicamento->cantidad_por_empaque }}</td>
                        <td>L. {{ number_format($medicamento->precio_unitario, 2) }}</td>
                        <td>{{ $medicamento->estado }}</td>
                        <td>{{ $medicamento->fecha_fabricacion }}</td>
                        <td>{{ $medicamento->fecha_vencimiento }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @can('canEditMedicamentos')
                                    <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                @endcan

                                @can('canDeleteMedicamentos')
                                    <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este medicamento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-between mt-4"></div>
@endsection