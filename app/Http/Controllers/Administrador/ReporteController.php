<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Registro_item;
use App\Http\Requests\ReporteRequest;
class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rutanodefinida');
    }

    public function generarPdf(ReporteRequest $request){
        $fechaInicio = $request->validated()['fecha_inicio'];
        $fechaFin = $request->validated()['fecha_fin'];

        $registros = Registro_item::with(['item.tipoItem', 'item.unidad_materia_prima', 'item.proveedor'])
            ->whereBetween('datetime_consumo', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->orderBy('datetime_consumo', 'desc')
            ->get();
        $totalRegistros= $registros->count();
        $cantidadTotalUsada = $registros->sum();

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
