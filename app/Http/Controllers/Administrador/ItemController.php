<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditMateriaPrimaRequest;
use App\Http\Requests\ReporteRequest;
use App\Http\Requests\StoreMateriaPrimaRequest;
use App\Models\Item;
use App\Models\Proveedor;
use App\Models\Registro_item;
use App\Models\TipoItem;
use App\Models\Ubicacion;
use App\Models\Unidad_item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Items = Item::with(['tipoItem', 'unidad_item'])->get();
        $primerosRegistros= Registro_item::with('Item')->latest('fecha_hora_registro')->take(10)->get();
        $proveedores = Proveedor::all();

        return view('administrador_materia_prima', compact('Items', 'primerosRegistros', 'proveedores'));

    }
    public function generarPdf(ReporteRequest $request){
        $fechaInicio = $request->validated()['fecha_inicio'];
        $fechaFin = $request->validated()['fecha_fin'];

        $registros = Registro_item::with(['item.tipoItem', 'item.unidad_item', 'item.proveedor'])
            ->whereBetween('fecha_hora_registro', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->orderBy('fecha_hora_registro', 'desc')
            ->get();
        $totalRegistros= $registros->count();
        $cantidadTotalUsada = $registros->sum('cantidad_usada');

        $resumenPorTipo = $registros->groupBy(function($registro){
            return $registro->item->tipoItem->tipo;
        })->map(function($grupo){
            return[
                'cantidad_registros'=>$grupo->count(),
                'cantidad_total'=>$grupo->sum('cantidad_usada')
            ];
        });
        $data=[
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'registros' => $registros,
            'total_registros' => $totalRegistros,
            'cantidad_total_usada' => $cantidadTotalUsada,
            'resumen_por_tipo' => $resumenPorTipo,
            'fecha_generacion'=>now()->format('d/m/y H:i:s'),
        ];

        $pdf = Pdf::loadView('reportes_insumos',$data);

        $pdf->setPaper('a4', 'portrait');
        return $pdf->download('reporte_insumos_'.$fechaInicio.'_'.$fechaFin.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medidas = Unidad_item::all();
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
        $medidas = Unidad_item::all();
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
