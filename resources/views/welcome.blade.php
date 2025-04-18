@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido al sistema de la farmacia') }}</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('register') }}">Registrar</a>

                    <a class="btn btn-secondary" href="{{ route('login') }}">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection