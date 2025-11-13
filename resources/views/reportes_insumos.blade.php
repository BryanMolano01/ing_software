<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Insumos</title>
    <style>
        /* Reset y Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
            background-color: #f8f9fa;
        }

        /* Contenedor Principal */
        .report-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
        }

        /* Header Principal */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #622D16 0%, #8B4513 100%);
            color: white;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 11px;
            opacity: 0.9;
        }

        /* Sección de Información */
        .info-section {
            margin-bottom: 25px;
            padding: 15px;
            background-color: #ffe0b2;
            border-left: 5px solid #FFB266;
            border-radius: 4px;
        }

        .info-section .info-grid {
            width: 100%;
        }

        .info-section .info-row {
            margin-bottom: 8px;
        }

        .info-section .info-label {
            font-weight: bold;
            color: #622D16;
            display: inline-block;
            width: 150px;
        }

        .info-section .info-value {
            color: #333;
        }

        /* Títulos de Sección */
        h3 {
            color: #622D16;
            font-size: 16px;
            margin-top: 25px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #FFB266;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tablas Mejoradas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table thead {
            background: linear-gradient(135deg, #622D16 0%, #8B4513 100%);
            color: white;
        }

        table thead th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-right: 1px solid rgba(255,255,255,0.2);
        }

        table thead th:last-child {
            border-right: none;
        }

        table tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #ffe0b2;
        }

        table tbody td {
            padding: 10px 8px;
            font-size: 9px;
            color: #555;
        }

        table tbody td:first-child {
            font-weight: 600;
            color: #622D16;
        }

        /* Fila vacía */
        .empty-row td {
            text-align: center !important;
            padding: 30px !important;
            color: #999 !important;
            font-style: italic;
        }

        /* Sección de Resumen */
        .summary {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f5f2;
            border-radius: 8px;
            border: 2px solid #FFB266;
        }

        .summary h3 {
            margin-top: 0;
            color: #622D16;
            border-bottom: 2px solid #FFB266;
        }

        .summary table {
            margin-top: 15px;
        }

        .summary table thead {
            background: linear-gradient(135deg, #FFB266 0%, #FFA726 100%);
        }

        .summary table thead th {
            color: #622D16;
        }

        /* Estadísticas destacadas */
        .stats-highlight {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .stats-highlight strong {
            color: #622D16;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #FFB266;
            text-align: center;
            color: #777;
            font-size: 9px;
        }

        .footer p {
            margin-bottom: 5px;
        }

        .footer .company-name {
            font-weight: bold;
            color: #622D16;
            font-size: 10px;
        }

        /* Paginación (para documentos largos) */
        @page {
            margin: 15mm;
        }

        /* Asegurar que las tablas no se corten entre páginas */
        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }
    </style>
</head>
<body>
<div class="report-container">
    <!-- Header Principal -->
    <div class="header">
        <h1>Reporte de Insumos Consumidos</h1>
        <p>Sistema de Gestión de Materia Prima</p>
    </div>

    <!-- Información del Reporte -->
    <div class="info-section">
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Período de análisis:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha de generación:</span>
                <span class="info-value">{{ $fecha_generacion }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Total de registros:</span>
                <span class="info-value">{{ $total_registros }} movimientos</span>
            </div>
        </div>
    </div>

    <!-- Detalle de Consumos -->
    <h3>📋 Detalle de Consumos</h3>
    <table>
        <thead>
        <tr>
            <th style="width: 20%;">Fecha/Hora</th>
            <th style="width: 20%;">Tipo</th>
            <th style="width: 25%;">Proveedor</th>
            <th style="width: 18%; text-align: right;">Cantidad</th>
            <th style="width: 17%; text-align: center;">Unidad</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($registros as $registro)
            <tr>
                <td>{{ \Carbon\Carbon::parse($registro->fecha_hora_registro)->format('d/m/Y H:i') }}</td>
                <td>{{ $registro->item->tipoItem->tipo ?? 'N/A' }}</td>
                <td>{{ $registro->item->proveedor->nombre ?? 'N/A' }}</td>
                <td style="text-align: right; font-weight: bold; color: #622D16;">{{ number_format($registro->cantidad_usada, 2) }}</td>
                <td style="text-align: center;">{{ $registro->item->unidad_materia_prima->unidad ?? 'N/A' }}</td>
            </tr>
        @empty
            <tr class="empty-row">
                <td colspan="5">
                    No se encontraron registros en el período seleccionado.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Resumen por Tipo -->
    @if($resumen_por_tipo->isNotEmpty())
        <div class="summary">
            <h3>📊 Resumen por Tipo de Insumo</h3>
            <table>
                <thead>
                <tr>
                    <th style="width: 40%;">Tipo de Insumo</th>
                    <th style="width: 30%; text-align: center;">Cantidad de Registros</th>
                    <th style="width: 30%; text-align: right;">Cantidad Total Usada</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($resumen_por_tipo as $tipo => $datos)
                    <tr>
                        <td style="font-weight: bold; color: #622D16;">{{ $tipo }}</td>
                        <td style="text-align: center;">{{ $datos['cantidad_registros'] }} movimientos</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($datos['cantidad_total'], 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="stats-highlight">
                <strong>Total general consumido:</strong> {{ number_format($cantidad_total_usada, 2) }} unidades
            </div>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p class="company-name">Pan Payo - Sistema de Gestión</p>
        <p>Generado automáticamente el {{ $fecha_generacion }}</p>
        <p>Este documento es un reporte interno y confidencial</p>
    </div>
</div>
</body>
</html>
