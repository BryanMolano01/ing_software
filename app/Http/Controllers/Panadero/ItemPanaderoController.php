<?php

namespace App\Http\Controllers\Panadero;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditItemPanaderoRequest;
use App\Models\Item;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ItemPanaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('proveedor','ubicacion','tipoItem', 'unidad_item')->get();
        return view('dashboard_panadero', compact('items'));

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
    public function edit(Item $item)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditItemPanaderoRequest $request, Item $item)
    {
        $validated=$request->validated();

        $item->update($validated);
        return redirect()->route('panadero.itemPanadero.index')->with('success', 'Item actualizado correctamente');

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

        if ($searchTerm === '') {
            $items = collect([]);
        } else {
            $items = Item::whereHas('tipoItem', function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(tipo) LIKE ?', [strtolower($searchTerm) . '%']);
            })
                ->with('tipoItem')
                ->orderBy('id_item', 'asc')
                ->get();
        }

        $html = view('partials.item_buscar', ['items' => $items])->render();

        return response()->json([
            'html'  => $html,
            'count' => $items->count(),
        ]);
    }

}
