<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditMateriaPrimaRequest;
use App\Http\Requests\StoreMateriaPrimaRequest;
use App\Models\Item;
use App\Models\Proveedor;
use App\Models\Registro_item;
use App\Models\TipoItem;
use App\Models\Ubicacion;
use App\Models\Unidad_materia_prima;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Items = Item::with(['tipoItem', 'unidad_materia_prima'])->get();
        $primerosRegistros= Registro_item::with('Item')->latest('fecha_hora_registro')->take(10)->get();
        $proveedores = Proveedor::all();

        return view('administrador_materia_prima', compact('Items', 'primerosRegistros', 'proveedores'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medidas = Unidad_materia_prima::all();
        $proveedores = Proveedor::all();
        $tipo_items = TipoItem::all();
        $ubicaciones = Ubicacion::all();

        return view('crear_materia', compact('medidas','proveedores', 'tipo_items', 'ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMateriaPrimaRequest $request)
    {
        $validated=$request->validated();

        $item = Item::create($validated);
        return redirect()->route('administrador.items.index')->with('success', 'Item creado correctamente');
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
    public function edit(Item $item)
    {
        $medidas = Unidad_materia_prima::all();
        $proveedores = Proveedor::all();
        $tipo_items = TipoItem::all();
        $ubicaciones = Ubicacion::all();

        return view('editar_materia', compact('item','medidas', 'proveedores', 'tipo_items', 'ubicaciones'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditMateriaPrimaRequest $request, Item $item)
    {
        $validated=$request->validated();
        $item->update($validated);
        return redirect()->route('administrador.items.index')->with('success', 'Item actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
