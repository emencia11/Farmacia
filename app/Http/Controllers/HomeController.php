<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // Aseguramos que el usuario esté autenticado antes de acceder
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
}
