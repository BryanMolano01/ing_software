<?php

namespace App\Http\Controllers\Panadero;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\TamanoProducto;
use App\Models\TipoProducto;
use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Http\Request;

class ProductoPanaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos= Producto::all();
        $tamanosProducto = TamanoProducto::all();
        $tiposProducto = TipoProducto::all();

        return view('producto_panadero', compact('productos', 'tamanosProducto', 'tiposProducto'));
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
        \Log::info('Request completo', $request->all());

        $registros = $request->input('productos',[]);

        \Log::info('Productos recibidos', ['productos' => $registros]);

        foreach($registros as $registro){
            $idProducto = $registro['id'];
            $cantidad = $registro['cantidad'];
            $producto =Producto::find($idProducto);
            $producto->cantidad = $producto->cantidad + $cantidad;
            $producto->save();
        }
        return response()->json([
            'mensaje'   => 'productos a la venta registrados',
            'productos' => $registros,
        ]);
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
    public function busquedaAjax(Request $request)
    {
        $searchTerm = trim($request->input('search'));

        if (empty($searchTerm)) {
            $productos = collect([]);
        } else {
            $productos = Producto::whereRaw('LOWER(nombre) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('nombre', 'asc')
                ->get();
        }

        $html = view('partials.producto_pedido_list', ['productos' => $productos])->render();

        return response()->json([
            'html' => $html,
            'count' => $productos->count()
        ]);
    }
}
