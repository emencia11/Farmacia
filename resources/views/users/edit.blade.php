{{-- users/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    <form action="{{ Auth::user()->id === $user->id ? route('user.profile.update') : route('users.update', $user->id) }}" method="POST">
    @csrf
    @if(Auth::user()->id !== $user->id)
        @method('PUT')
    @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nueva contraseña">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar nueva contraseña">
        </div>

        @if (Auth::user()->rol === 'root' && $user->id !== Auth::id())
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" id="rol" class="form-control">
                    <option value="vendedor" {{ $user->rol === 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    <option value="root" {{ $user->rol === 'root' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
        @endif

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>

            @if (Auth::id() === $user->id)
                <a href="{{ route('home') }}" class="btn btn-secondary">Volver</a>
            @else
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
            @endif
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection