@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido al sistema de la farmacia') }}</div>

                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 justify-content-around">
                        <a class="btn btn-primary" href="{{ route('medicamentos.index') }}">Medicamentos</a>
                        <a class="btn btn-primary" href="{{ route('unidades-medida.index') }}">Unidades de Medida</a>
                        <a class="btn btn-primary" href="{{ route('categorias.index') }}">Categorias</a>
                        <a class="btn btn-primary" href="{{ route('proveedores.index') }}">Proveedores</a>
                        <a class="btn btn-primary" href="{{ route('ventas.index') }}">Ventas</a>
                        <a class="btn btn-primary" href="{{ route('devoluciones.index') }}">Devoluciones</a>
                        <a class="btn btn-primary" href="{{ route('inventario.index') }}">Inventario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
