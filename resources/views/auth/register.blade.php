@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center fs-5 fw-bold">
                    {{ __('Registro de Usuario - Farmacia') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Correo electrónico -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Seleccionar Rol -->
                        <div class="form-group mb-4">
                            <label for="rol" class="form-label">Seleccionar Rol</label>
                            <select name="rol" id="rol" class="form-control @error('rol') is-invalid @enderror">
                                <option value="vendedor" {{ old('rol') == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                                <option value="root" {{ old('rol') == 'root' ? 'selected' : '' }}>Administrador</option>
                            </select>
                            @error('rol')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <!-- Botón de volver -->
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary d-flex align-items-center">
                                <i class="bi bi-arrow-left-circle me-2"></i> Volver al Inicio
                            </a>

                            <!-- Botón de registrar -->
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-person-plus-fill me-1"></i> {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection