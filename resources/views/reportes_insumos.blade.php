<x-app-layout>
    
    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'administrador.dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.items.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />
    {{-- Encabezado --}}
    
    <div class="report-container">
        <h2 class="mb-4" style="color: #622D16;">Reporte de Insumos Consumidos</h2> 
        <div class="info-section">
            <p><strong>Período:</strong>{{-- {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}--}} </p>
            <p><strong>Fecha de generación:</strong> {{-- {{ $fecha_generacion }} --}}</p>
            <p><strong>Total de registros:</strong> {{-- {{ $total_registros }} --}}</p>
        </div>

        {{-- Tabla de Registros Detallados --}}
        <h3 style="color: #622D16; margin-top: 20px;">Detalle de Consumos</h3>
        <table>
            <thead>
                <tr>
                    <th>Fecha/Hora</th>
                    <th>Tipo</th>
                    <th>Proveedor</th>
                    <th>Cantidad Usada</th>
                    <th>Unidad</th>
                </tr>
            </thead>
            <tbody>
                {{-- 
                @forelse ($registros as $registro)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($registro->datetime_consumo)->format('d/m/Y H:i') }}</td>
                        <td>{{ $registro->item->tipoItem->tipo ?? 'N/A' }}</td>
                        <td>{{ $registro->item->proveedor->nombre ?? 'N/A' }}</td>
                        <td>{{ $registro->cantidad_usada }}</td>
                        <td>{{ $registro->item->unidad_materia_prima->unidad ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px; color: #888;">
                            No se encontraron registros en el período seleccionado
                        </td>
                    </tr>
                @endforelse
                --}}
            </tbody>
        </table>

        {{-- Resumen por Tipo --}}
        {{--  @if($resumen_por_tipo->isNotEmpty())--}}
            <div class="summary">
                <h3>Resumen por Tipo de Insumo</h3>
                <table style="margin-top: 10px;">
                    <thead>
                        <tr>
                            <th>Tipo de Insumo</th>
                            <th>Cantidad de Registros</th>
                            <th>Cantidad Total Usada</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--  
                        @foreach ($resumen_por_tipo as $tipo => $datos)
                            <tr>
                                <td>{{ $tipo }}</td>
                                <td>{{ $datos['cantidad_registros'] }}</td>
                                <td>{{ $datos['cantidad_total'] }}</td>
                            </tr>
                        @endforeach
                        --}}
                    </tbody>
                </table>
            </div>
        {{--  @endif--}}

        {{-- Pie de página --}}
        <div class="footer">
            <p>Generado automáticamente por el Sistema de Gestión de Materia Prima</p>
        </div>
    </div>
    {{-- Información del Reporte --}}
    
</x-app-layout>
<style>
    /* ELIMINADO: * { margin: 0; padding: 0; box-sizing: border-box; } - ESTO CAUSABA EL CONFLICTO GLOBAL */
    /* ELIMINADO: body { ... } - ESTO CAMBIABA EL FONDO Y MARGEN DE TODA LA PÁGINA */
    
    /* Si necesitas un reset local, aplica margin y padding a los hijos directos del contenedor: */
    .report-container > * { 
        box-sizing: border-box; 
    }

    /* 2. Estilos del Contenedor Base */
    .report-container {
        font-family: Arial, sans-serif;
        font-size: 11px;
        color: #333;
        /* El padding original del body ahora se aplica al contenedor */
        padding: 25px; 
        background-color: white; 
        /* Aseguramos que el contenedor se muestre correctamente en el layout principal */
        width: 100%;
        max-width: 900px; /* Ejemplo de ancho máximo */
        margin: 0 auto; /* Centrar el reporte */
    }

    /* 3. Estilos del Encabezado */
    .report-container .header { /* Prefijo añadido */
        text-align: center;
        margin-bottom: 25px;
        border-bottom: 3px solid #FFB266; 
        padding-bottom: 15px;
    }
    .report-container .header h1 { /* Prefijo añadido */
        color: #622D16;
        font-size: 26px;
        margin-bottom: 5px;
    }
    .report-container .header p { /* Prefijo añadido */
        color: #A0522D;
        font-size: 14px;
    }

    /* 4. Información del Reporte */
    .report-container .info-section { /* Prefijo añadido */
        margin-bottom: 25px;
        padding: 10px 15px;
        border-left: 4px solid #ffe0b2; 
        background-color: #fcfcfc;
    }
    .report-container .info-section p { /* Prefijo añadido */
        margin: 4px 0;
    }
    .report-container .info-section strong { /* Prefijo añadido */
        color: #622D16;
        font-weight: bold;
    }

    /* 5. Estilos de la Tabla (Detalle de Consumos) */
    .report-container h3 { /* Prefijo añadido */
        color: #622D16; 
        margin-top: 25px;
        margin-bottom: 15px;
        font-size: 18px;
    }
    .report-container table { /* Prefijo añadido */
        width: 100%;
        border-collapse: collapse;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    /* Continúa añadiendo el prefijo '.report-container ' a TODAS las demás reglas de la tabla (th, td, tr, etc.) */
    .report-container table thead th {
        background-color: #ffe0b2; 
        border: 1px solid #FFB266 ; 
        color: #622D16; 
        padding: 12px 10px;
        text-align: left;
        font-weight: bold;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
    /* ... el resto de las reglas de table, summary y footer ... */
</style>