<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Requests\StoreTipoMateriaPrimaRequest;
use App\Http\Requests\EditTipoItemRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProveedorRequest;
use App\Models\Proveedor;
use App\Models\TipoItem;

class TipoMateriaPrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos=TipoItem::all();
        return view('administrar_tipos', compact('tipos'));

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
    public function store(StoreTipoMateriaPrimaRequest $request)
    {
        $validated=$request->validated();

        $tipo = TipoItem::create($validated);
        return redirect()->route('administrador.tipoItem.index')->with('success', 'Tipo creado correctamente');
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
    public function edit(TipoItem $tipoItem)
    {
        return view('editar_tipos', compact('tipoItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTipoItemRequest $request, TipoItem $tipoItem)
    {
        $validated=$request->validated();
        $tipoItem->update($validated);
        return redirect()->route('administrador.tipoItem.index')->with('success', 'Tipo actualizado correctamente');
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
            $tipos = collect([]); 
        } else {
            $tipos = TipoItem::whereRaw('LOWER(tipo) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('tipo', 'asc')
                ->get();
        }

        $html = view('partials.//', ['proveedores' => $tipos])->render();

        return response()->json([
            'html' => $html,
            'count' => $tipos->count()
        ]);
    }
}
