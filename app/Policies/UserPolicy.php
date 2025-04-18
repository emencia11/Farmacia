<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $authUser)
    {
        return $authUser->rol === 'root'; // Solo root puede ver todos los usuarios
    }

    public function update(User $authUser, User $user)
    {
        return $authUser->rol === 'root' || $authUser->id === $user->id; // Root o el propio usuario
    }

    public function delete(User $authUser, User $user)
    {
        return $authUser->rol === 'root'; // Solo root puede eliminar usuarios
    }
}