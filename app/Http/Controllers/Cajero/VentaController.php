<?php

namespace App\Http\Controllers\Cajero;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use App\Models\Producto;
use App\Models\TamanoProducto;
use App\Models\TipoProducto;
use App\Models\Unidad_item;
use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos= Producto::where('cantidad', '>', 0)->get();
        $tamanosProducto = TamanoProducto::all();
        $tiposProducto = TipoProducto::all();
        $pedidos = Venta::where('tipo_venta_id_tipo_venta',2)->get();

        return view('dashboard_cajero', compact('productos', 'tamanosProducto', 'tiposProducto', 'pedidos'));

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

        $venta=Venta::create(['fecha_hora_venta'=>now(),'total'=>0, 'tipo_venta_id_tipo_venta'=>1, 'usuario_id_usuario'=>auth()->id()]);
        $subtotales = 0;
        foreach($registros as $registro){
            $idProducto = $registro['id'];
            $cantidad = $registro['cantidad'];
            $producto =Producto::find($idProducto);
            $precioUnitario = $producto->precio;
            $ventaProducto = VentaProducto::create(['cantidad'=>$cantidad,
                'precio_unitario'=>$precioUnitario,
                'subtotal'=>$precioUnitario*$cantidad,
                'producto_id_producto'=>$idProducto,
                'venta_id_venta'=>$venta->id_venta]);
            $producto->cantidad = $producto->cantidad - $cantidad;
            $producto->save();
            $subtotales += $precioUnitario*$cantidad;
        }
        $venta->total = $subtotales;
        $venta->save();
        return response()->json([
            'mensaje'   => 'Venta creada',
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
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->fecha_hora_entrega = now();
        $venta->tipo_venta_id_tipo_venta = 3;
        $venta->save();

        Notificacion::create([
            'notificacion' => 'El pedido de la venta #'.$venta->id_venta.' se ha completado',
            'fecha_hora_notificacion' => now(),
            'venta_id_venta' => $venta->id_venta,


        ]);

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
            $productos = Producto::where('cantidad', '>', 0)->whereRaw('LOWER(nombre) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('nombre', 'asc')
                ->get();
        }

        $html = view('partials.producto_cajero_list', ['productos' => $productos])->render();

        return response()->json([
            'html' => $html,
            'count' => $productos->count()
        ]);
    }
}
