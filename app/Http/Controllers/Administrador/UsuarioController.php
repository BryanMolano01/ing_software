<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\Registro;

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

        $primerosregistros=Registro::with('usuario')->latest('fecha_hora_registro')->take(10)->get();

        return view('dashboard_administrador', compact('usuarios', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles= Rol::all();
        $estados = EstadoUsuario::all();
        
        return view('crear_usuario', compact('roles','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'email' => 'required|string|email|max:45|unique:usuario,email',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' busca un campo 'password_confirmation'
            'rol_id_rol' => 'required|integer|exists:rol,id_rol',
            // CORREGIDO: Ahora el estado inicial se asigna aquí, no desde el formulario
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id_rol' => $request->rol_id_rol,
            'estado_usuario_id_estado_usuario' => 1, // Estado "disponible" por defecto
            'fecha_registro' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuario creado exitosamente.');
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
    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();
        $estados = EstadoUsuario::all();
        // Debes crear esta vista: resources/views/admin/editar_usuario.blade.php
        return view('admin.editar_usuario', compact('usuario','roles','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'email' => ['required', 'string', 'email', 'max:45', Rule::unique('usuario')->ignore($usuario->id_usuario, 'id_usuario')],
            'password' => 'nullable|string|min:8|confirmed',
            'rol_id_rol' => 'required|integer|exists:rol,id_rol',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);
        return redirect()->route('dashboard')->with('success', 'Usuario actualizado exitosamente.');
    }
    
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado');
    }

    public function cambiarEstado(Request $request, Usuario $usuario)
    {
        $request->validate([
            'estado_id' => 'required|integer|exists:estado_usuario,id_estado_usuario',
        ]);
        $usuario->update(['estado_usuario_id_estado_usuario' => $request->estado_id]);
        return response()->json(['success' => true, 'message' => 'Estado actualizado.']);
    }
}
