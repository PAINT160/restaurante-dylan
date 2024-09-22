<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = collect([
            (object) ['id' => 1, 'name' => 'Juan Pérez'],
            (object) ['id' => 2, 'name' => 'Ana Gómez'],
            (object) ['id' => 3, 'name' => 'Pedro Martínez']
        ]);

        // Datos ficticios para publicaciones
        $posts = collect([
            (object) ['id' => 1, 'title' => 'Nuevo en Laravel', 'content' => 'Hoy aprendí sobre Eloquent.'],
            (object) ['id' => 2, 'title' => 'Prueba de Datos', 'content' => 'Esto es solo una prueba.'],
            (object) ['id' => 3, 'title' => 'Introducción a PHP', 'content' => 'PHP es un lenguaje de programación popular.']
        ]);


        // Pasar datos a la vista
        // return view('dashboard', ['items' => $items]);
        return view('dashboard', compact('users', 'posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear un nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Encriptar la contraseña
        $user->save(); // Guardar en la base de datos

        // Opcionalmente, puedes redirigir al usuario a otra página o devolver una respuesta
        return redirect()->route('dashboard')->with('success', 'Registro exitoso');
    }


    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        return view('dashboard.show', compact('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
    
}
