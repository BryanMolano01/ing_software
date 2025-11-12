<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Requests\StoreUbicacionRequest;
use App\Http\Requests\EditUbicacionRequest;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicaciones=Ubicacion::all();
        return view('administrar_ubicaciones', compact('ubicaciones'));
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
    public function store(StoreUbicacionRequest $request)
    {
        $validated=$request->validated();

        $ubicacion = Ubicacion::create($validated);
        return redirect()->route('administrador.ubicacion.index')->with('success', 'Ubicacion creado correctamente');
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
    public function edit(Ubicacion $ubicacion)
    {
        

        return view('editar_ubicaciones', compact('ubicacion'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUbicacionRequest $request, Ubicacion $ubicacion)
    {
        $validated=$request->validated();
        $ubicacion->update($validated);
        return redirect()->route('administrador.ubicacion.index')->with('success', 'Ubicacion actualizado correctamente');

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
            $ubicaciones = collect([]); 
        } else {
            $ubicaciones = Ubicacion::whereRaw('LOWER(ubicacion) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('ubicacion', 'asc')
                ->get();
        }

        $html = view('partials.ubicacion_buscar', ['ubicaciones' => $ubicaciones])->render();

        return response()->json([
            'html' => $html,
            'count' => $ubicaciones->count()
        ]);
    }
}
