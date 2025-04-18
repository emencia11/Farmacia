@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Medicamento</h1>

        <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $medicamento->nombre }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion">{{ $medicamento->descripcion }}</textarea>
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoría</label>
                <select class="form-control" id="id_categoria" name="id_categoria" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $medicamento->id_categoria == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_unidad_medida">Unidad de Medida</label>
                <select class="form-control" id="id_unidad_medida" name="id_unidad_medida" required>
                    @foreach ($unidades as $unidad)
                        <option value="{{ $unidad->id }}" {{ $medicamento->id_unidad_medida == $unidad->id ? 'selected' : '' }}>{{ $unidad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_proveedor">Proveedor</label>
                <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ $medicamento->id_proveedor == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $medicamento->stock }}" required>
            </div>

            <div class="form-group">
                <label for="precio_unitario">Precio Unitario</label>
                <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" value="{{ $medicamento->precio_unitario }}" required>
            </div>

            <div class="form-group">
                <label for="cantidad_por_empaque">Cantidad por Empaque</label>
                <input type="number" class="form-control" id="cantidad_por_empaque" name="cantidad_por_empaque" value="{{ $medicamento->cantidad_por_empaque }}" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="activo" {{ $medicamento->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="descontinuado" {{ $medicamento->estado == 'descontinuado' ? 'selected' : '' }}>Descontinuado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_fabricacion">Fecha de Fabricación</label>
                <input type="date" class="form-control" id="fecha_fabricacion" name="fecha_fabricacion" value="{{ $medicamento->fecha_fabricacion }}">
            </div>

            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ $medicamento->fecha_vencimiento }}" required>
            </div>

            <!-- Botones alineados igual que en la vista de crear -->
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-warning" style="margin-right: 10px;">Actualizar</button>
                <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">Volver</a>
            </div>
            <div class="d-flex justify-content-between mt-4"></div>
        </form>
    </div>
@endsection