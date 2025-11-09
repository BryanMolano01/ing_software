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
use Illuminate\Support\Facades\Auth;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios= Usuario::with(['rol', 'estadoUsuario'])->get();
        $estados=EstadoUsuario::all();
        $usuarioSesion = Auth::user();
        $primerosRegistros=Registro::with('usuario')->latest('fecha_hora_registro')->take(10)->get();

        return view('dashboard_administrador', compact('usuarios', 'estados', 'usuarioSesion', 'primerosRegistros'));
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

        return redirect()->route('administrador.dashboard')->with('success', 'Usuario creado exitosamente.');
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
        return view('editar_usuario', compact('usuario','roles','estados'));
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
        return redirect()->route('administrador.dashboard')->with('success', 'Usuario actualizado exitosamente.');
    }
    
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('administrador.dashboard')->with('success', 'Usuario eliminado');
    }
    public function searchAccessLogs(Request $request)
    {
        $searchTerm = trim(strtolower($request->input('search'))); // Limpia y convierte a minúsculas

        // 1. Manejo del término de búsqueda vacío o nulo
        if (empty($searchTerm)) {
            // Devuelve una colección vacía para vaciar la lista en el front-end
            $registros = collect([]); 
        } else {
            // 2. Ejecuta la búsqueda real: coincidencia SÓLO al inicio del nombre
            $registros = Registro::whereHas('usuario', function ($query) use ($searchTerm) {
                // whereRaw + LOWER() permite buscar sin distinguir mayúsculas/minúsculas y solo al inicio
                $query->whereRaw('LOWER(nombre) LIKE ?', [$searchTerm . '%']); 
            })
            ->with('usuario.rol')
            ->latest('fecha_hora_registro') 
            ->get();
        }

        // 3. Renderizar y devolver la respuesta JSON
        $html = view('partials.access_list', ['registros' => $registros])->render();

        return response()->json([
            'html' => $html,
            'count' => $registros->count()
        ]);
    }

    public function cambiarEstado(Request $request, Usuario $usuario)
    {
        $request->validate([
            'estado_id' => 'required|integer|exists:estado_usuario,id_estado_usuario',
        ]);

        $usuario->update([
            'estado_usuario_id_estado_usuario' => $request->estado_id,
        ]);

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}
