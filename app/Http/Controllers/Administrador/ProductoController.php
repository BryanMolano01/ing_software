<?php

namespace App\Http\Controllers\Administrador;

use App\Models\EstadoProducto;
use App\Models\Producto;
use App\Models\TamanoProducto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\EditProductoRequest;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos=Producto::all();
        $tipos=TipoProducto::all();
        $tamanos=TamanoProducto::all();
        return view('administrar_recetas', compact('productos', 'tipos', 'tamanos'));

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
    public function store(StoreProductoRequest $request)
    {
        $validated=$request->validated();
        $validated['estado_producto_id_estado_producto'] = 1;
        $producto = Producto::create($validated);
        return redirect()->route('administrador.producto.index')->with('success', 'Producto creado correctamente');
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
    public function edit(Producto $producto)
    {
        $tipos=TipoProducto::all();
        $tamanos=TamanoProducto::all();
        $estados=EstadoProducto::all();
        return view('editar_recetas', compact('producto', 'tamanos', 'tipos', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductoRequest $request, Producto $producto)
    {
        $validated=$request->validated();
        $producto->update($validated);
        return redirect()->route('administrador.producto.index')->with('success', 'Producto actualizado correctamente');
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
            $productos = collect([]);
        } else {
            $productos = Producto::with(['tipoProducto', 'tamanoProducto', 'estadoProducto'])
                ->whereRaw('LOWER(nombre) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('nombre', 'asc')
                ->get();
        }

        $html = view('partials.//', ['productos' => $productos])->render();

        return response()->json([
            'html' => $html,
            'count' => $productos->count()
        ]);
    }
}
