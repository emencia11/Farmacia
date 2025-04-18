@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administrar Usuarios</h1>
    
    <div class="d-flex justify-content-start mb-3 gap-2">
        <a href="{{ route('home') }}" class="btn btn-light border shadow-sm d-flex align-items-center">
            <i class="bi bi-house-door-fill me-2 text-primary"></i> 
            <span>Menú Principal</span>
        </a>

        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-person-circle me-2"></i>
            <span>Editar Mi Perfil</span>
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->rol) }}</td>
                    <td>
                        @if ($user->activo)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->rol === 'root' || Auth::id() === $user->id)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        @endif

                        @if (Auth::user()->rol === 'root' && Auth::id() !== $user->id)
                            <form action="{{ route('users.toggleActivo', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                @if ($user->activo)
                                    <button type="submit" class="btn btn-secondary btn-sm">Desactivar</button>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm">Activar</button>
                                @endif
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection