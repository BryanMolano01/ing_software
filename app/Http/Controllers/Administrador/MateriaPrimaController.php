<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Proveedor;
use App\Models\Registro_item;
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
