@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inventario</h2>

    <div class="d-flex gap-2 mb-4"></div>
        <a href="{{ route('inventario.index') }}" class="btn btn-secondary mb-3">Volver</a>
        <a href="{{ route('inventario.entrada.create') }}" class="btn btn-success mb-3">Registrar Entrada</a>
        <a href="{{ route('inventario.salida.create') }}" class="btn btn-danger mb-3">Registrar Salida</a>
    </div>

    <h4>Entradas</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Medicamento</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Proveedor</th>
            <th>Tipo</th> <!-- nuevo -->
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($entradas as $entrada)
        <tr>
            <td>{{ $entrada->medicamento->nombre }}</td>
            <td>{{ $entrada->cantidad }}</td>
            <td>{{ number_format($entrada->precio_unitario, 2) }}</td>
            <td>{{ $entrada->proveedor?->nombre ?? '—' }}</td>
            <td>{{ ucfirst($entrada->tipo) }}</td> <!-- nuevo -->
            <td>{{ $entrada->usuario->name }}</td>
            <td>
                <a href="{{ route('inventario.show', ['tipo' => 'entrada', 'id' => $entrada->id]) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('inventario.entrada.edit', $entrada->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('inventario.entrada.destroy', $entrada->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar entrada?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>

    <h4>Salidas</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Medicamento</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Tipo</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salidas as $salida)
            <tr>
                <td>{{ $salida->medicamento->nombre }}</td>
                <td>{{ $salida->cantidad }}</td>
                <td>L {{ number_format($salida->precio_unitario, 2) }}</td>
                <td>{{ ucfirst($salida->tipo) }}</td>
                <td>{{ $salida->usuario->name }}</td>
                <td>
                    <a href="{{ route('inventario.show', ['tipo' => 'salida', 'id' => $salida->id]) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('inventario.salida.edit', $salida->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('inventario.salida.destroy', $salida->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar salida?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection