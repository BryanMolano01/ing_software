<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUnidadMedidaRequest;
use App\Http\Requests\StoreUnidadMedidaRequest;

use App\Models\Unidad_item;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades=Unidad_item::all();
        return view('administrar_medidas', compact('unidades'));
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
    public function store(StoreUnidadMedidaRequest $request)
    {
        $validated=$request->validated();

        $medida = Unidad_item::create($validated);
        return redirect()->route('administrador.medida.index')->with('success', 'unidad de medida creada correctamente');
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
    public function edit(Unidad_item $medida)
    {


        return view('editar_medidas', compact('medida'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUnidadMedidaRequest $request, Unidad_item $medida)
    {
        $validated=$request->validated();
        $medida->update($validated);
        return redirect()->route('administrador.medida.index')->with('success', 'unidad de medida actualizada correctamente');

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
            $unidades = collect([]);
        } else {
            $unidades = Unidad_item::whereRaw('LOWER(unidad) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('unidad', 'asc')
                ->get();
        }

        $html = view('partials.medida_buscar', ['unidades' => $unidades])->render();

        return response()->json([
            'html' => $html,
            'count' => $unidades->count()
        ]);
    }
}
