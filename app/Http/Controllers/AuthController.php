<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Manejar la solicitud de registro
    public function register(Request $request)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:root,vendedor',
        ]);

        // Crear el usuario con el rol asignado
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'rol' => $validatedData['rol'],  // Asignamos el rol al crear el usuario
        ]);

        // Iniciar sesión automáticamente después de registrarse
        Auth::login($user);

        // Redirigir al home (o donde sea necesario)
        return redirect()->route('home');
    }
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
