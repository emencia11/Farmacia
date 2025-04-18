@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Registrar Venta</h2>
        
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="medicamentos">Productos:</label>
                <div id="productos-container">
                    <div class="producto-row mb-3">
                        <select name="medicamentos[0][id]" class="form-control" required>
                            <option value="">Seleccione un producto</option>
                            @foreach($medicamentos as $medicamento)
                                <option value="{{ $medicamento->id }}">{{ $medicamento->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="medicamentos[0][cantidad]" class="form-control mt-2" min="1" placeholder="Cantidad" required>
                    </div>
                </div>

                <button type="button" onclick="addProduct()" class="btn btn-secondary mb-3">+ Agregar otro producto</button>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Registrar Venta</button>
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>

    <script>
        let productIndex = 1;

        function addProduct() {
            const productRow = document.createElement('div');
            productRow.classList.add('producto-row', 'mb-3');
            productRow.innerHTML = `
                <select name="medicamentos[${productIndex}][id]" class="form-control" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($medicamentos as $medicamento)
                        <option value="{{ $medicamento->id }}">{{ $medicamento->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" name="medicamentos[${productIndex}][cantidad]" class="form-control mt-2" min="1" placeholder="Cantidad" required>
            `;
            document.getElementById('productos-container').appendChild(productRow);
            productIndex++;
        }
    </script>
@endsection