<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function editProfile()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        // Cambié esta parte para permitir "vendedor" como rol válido
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'rol' => 'nullable|in:vendedor,root', // Permitimos "vendedor" y "root"
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Actualizo el rol solo si es root y no está editando su propio perfil
        if (Auth::user()->rol === 'root' && $user->id !== Auth::id()) {
            $user->rol = $request->input('rol'); // Se actualiza ANTES de guardar
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->cannot('delete', $user)) {
            return redirect()->route('home')->with('error', 'No tienes permisos para eliminar este usuario.');
        }

        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function toggleActivo(User $user)
    {
        if (Auth::user()->rol !== 'root' || Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'No tienes permisos para cambiar este estado.');
        }

        $user->activo = !$user->activo;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Estado del usuario actualizado.');
    }
}