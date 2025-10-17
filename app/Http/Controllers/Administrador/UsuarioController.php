<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\EstadoUsuario;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios= Usuario::with(['rol', 'estadoUsuario'])->get();
        $estados=EstadoUsuario::all();

        return view('dashboard', compact('usuarios', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles= Rol::all();
        $estados = EstadoUsuario::all();
        
        return view('crear-usuario', compact('roles','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nombre'=>'required|string|max:45',
            'email'=>'required|string|email|max:45|unique:usuario,email',
            'password'=>'required|string|min:3',
            'rol_id_rol'=>'required|integer|exists:rol,id_rol',
        ]);

        Usuario::create([
            'nombre'=> $request->nombre,
            'email'=> $request->email,
            'password'=>$request->password,
            'rol_id_rol'=>$request->rol_id_rol,
            'estado_usuario_id_estado_usuario'=> '1',//no sé si funciona
            'fecha_registro'=>now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuario creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
