<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Registro;
use App\Models\Venta;
use App\Models\VentaProducto;
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
        $primerasVentas = Venta::with('productos', 'tipoVenta','usuario')->latest('fecha_hora_venta')->take(10)->get();

        return view('ventas_admin', compact('primerasVentas'));
    }

    public function generarPdf(ReporteRequest $request){
        $fechaInicio = $request->validated()['fecha_inicio'];
        $fechaFin = $request->validated()['fecha_fin'];

        $registros = Registro_item::with(['item.tipoItem', 'item.unidad_item', 'item.proveedor'])
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
    public function generarPdfVenta(ReporteRequest $request)
    {
        $fechaInicio = $request->validated()['fecha_inicio'];
        $fechaFin    = $request->validated()['fecha_fin'];

        $ventas = Venta::with(['tipoVenta', 'usuario'])
            ->whereBetween('fecha_hora_venta', [
                $fechaInicio . ' 00:00:00',
                $fechaFin    . ' 23:59:59',
            ])
            ->orderBy('fecha_hora_venta', 'desc')
            ->get();

        $totalVentas = $ventas->count();

        $resumenPorTipo = $ventas->groupBy(function (Venta $venta) {
            return $venta->tipoVenta->tipo;
        })->map(function ($grupo) {
            return [
                'cantidad_ventas' => $grupo->count(),
                'dinero_total'    => $grupo->sum('total'),
            ];
        });
        $ventasProducto = VentaProducto::with([
            'producto.estadoProducto',
            'producto.tipoProducto',
            'producto.tamanoProducto',
            'venta.tipoVenta',
        ])
            ->whereHas('venta', function ($q) use ($fechaInicio, $fechaFin) {
                $q->whereBetween('fecha_hora_venta', [
                    $fechaInicio . ' 00:00:00',
                    $fechaFin    . ' 23:59:59',
                ]);
            })
            ->orderBy('venta_id_venta')
            ->get();
        $data = [
            'fecha_inicio'   => $fechaInicio,
            'fecha_fin'      => $fechaFin,
            'ventas'         => $ventas,
            'total_ventas'   => $totalVentas,
            'resumen_por_tipo' => $resumenPorTipo,
            'ventas_producto'=> $ventasProducto,
            'fecha_generacion' => now()->format('d/m/y H:i:s'),
        ];

        $pdf = Pdf::loadView('reporte_ventas_admin', $data);

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('reporte_ventas_' . $fechaInicio . '_' . $fechaFin . '.pdf');
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
