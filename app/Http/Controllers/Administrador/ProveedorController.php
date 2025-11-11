<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProveedorRequest;
use App\Http\Requests\StoreProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('crear_proveedor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {
        $validated=$request->validated();

        $proveedor = Proveedor::create($validated);
        return redirect()->route('administrador.items.index')->with('success', 'proveedor creado correctamente');
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
    public function edit(Proveedor $proveedor)
    {
        return view('editar_proveedor', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProveedorRequest $request, Proveedor $proveedor)
    {
        $validated=$request->validated();

        $proveedor = Proveedor::update($validated);
        return redirect()->route('administrador.items.index')->with('success', 'proveedor actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function busquedaAjax(Request $request)
    {
        $searchTerm = trim($request->input('search'));

        if (empty($searchTerm)) {
            $proveedores = collect([]); 
        } else {
            $proveedores = Proveedor::whereRaw('LOWER(nombre) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('nombre', 'asc')
                ->get();
        }

        $html = view('partials.proveedores_list', ['proveedores' => $proveedores])->render();

        return response()->json([
            'html' => $html,
            'count' => $proveedores->count()
        ]);
    }
}
