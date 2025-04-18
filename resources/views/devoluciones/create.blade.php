@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Registrar Devolución</h2>

    <form method="POST" action="{{ route('devoluciones.store') }}" onsubmit="return desactivarBoton();">
        @csrf

        <div id="productos">
            <div class="producto border p-3 mb-3" id="producto-0">
                <label>Medicamento:</label>
                <select name="medicamentos[0][id_medicamento]" class="form-control medicamento-select" required>
                    @foreach ($medicamentos as $med)
                        <option value="{{ $med->id }}" data-nombre="{{ $med->nombre }}">{{ $med->nombre }}</option>
                    @endforeach
                </select>

                <label>Cantidad:</label>
                <input type="number" name="medicamentos[0][cantidad]" class="form-control" min="1" required>

                <label>Motivo:</label>
                <textarea name="medicamentos[0][motivo]" class="form-control" placeholder="Opcional..."></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" onclick="agregarProducto()" class="btn btn-secondary mb-3">+ Agregar Otro Producto</button>
            <div>
                <button type="submit" class="btn btn-success mb-3" id="btnGuardar">Guardar Devolución</button>
                <a href="{{ route('devoluciones.index') }}" class="btn btn-secondary mb-3 ms-2">Volver</a>
            </div>
        </div>
    </form>
</div>

<script>
    let index = 1;
    const medicamentosSeleccionados = [];

    function agregarProducto() {
        const nuevo = `
            <div class="producto border p-3 mb-3" id="producto-${index}">
                <label>Medicamento:</label>
                <select name="medicamentos[${index}][id_medicamento]" class="form-control medicamento-select" required onchange="validarMedicamentoSeleccionado(${index})">
                    @foreach ($medicamentos as $med)
                        <option value="{{ $med->id }}" data-nombre="{{ $med->nombre }}">{{ $med->nombre }}</option>
                    @endforeach
                </select>

                <label>Cantidad:</label>
                <input type="number" name="medicamentos[${index}][cantidad]" class="form-control" min="1" required>

                <label>Motivo:</label>
                <textarea name="medicamentos[${index}][motivo]" class="form-control" placeholder="Opcional..."></textarea>
            </div>`;

        document.getElementById('productos').insertAdjacentHTML('beforeend', nuevo);
        index++;
    }

    function validarMedicamentoSeleccionado(index) {
        const select = document.querySelector(`#producto-${index} .medicamento-select`);
        const selectedValue = select.value;

        // Verificar si el medicamento ya ha sido seleccionado
        if (medicamentosSeleccionados.includes(selectedValue)) {
            alert("Este medicamento ya ha sido seleccionado. Elige otro.");
            select.value = ""; // Limpiar selección
        } else {
            // Agregar medicamento a la lista de seleccionados
            medicamentosSeleccionados.push(selectedValue);
        }
    }

    // Desactivar el botón de envío después de hacer clic
    function desactivarBoton() {
        const btn = document.getElementById('btnGuardar');
        btn.disabled = true;
        btn.innerText = 'Guardando...';
        return true;
    }
</script>
@endsection