<?php

namespace App\Http\Controllers\Panadero;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use App\Models\Producto;
use Illuminate\Http\Request;

class NotificacionPanaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notificaciones = Notificacion::with('producto', 'venta')->get();
        return view('notificacion_panadero', compact('notificaciones'));


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
    public function busquedaAjax(Request $request)
    {
        $searchTerm = trim($request->input('search'));

        if (empty($searchTerm)) {
            $notificaciones = collect([]);
        } else {
            $notificaciones = Producto::where('cantidad', '>', 0)->whereRaw('LOWER(notificacion) LIKE ?', [strtolower($searchTerm) . '%'])
                ->orderBy('nombre', 'asc')
                ->get();
        }

        $html = view('partials.notificacion_panadero_list', ['productos' => $notificaciones])->render();

        return response()->json([
            'html' => $html,
            'count' => $notificaciones->count()
        ]);
    }
}
