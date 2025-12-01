<x-app-layout>
    <x-slot name="header"></x-slot>
    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'administrador.dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.items.index'],
            ['title' => 'Ventas', 'route' => 'administrador.ventasAdmin.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" /> 
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="container mt-4">
        <h2 class="mb-4" style="color: #622D16;">Ventas</h2>
        <div class="row">
            <div class="col-md-7 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title mb-4" style="color: #a0522d; font-weight: bold;">
                        Últimas Ventas Registradas
                    </h5>
                    <div class="access-list-container flex-grow-1 overflow-auto" id="ventasListContainer">
                        @if(isset($primerasVentas) && $primerasVentas->count() > 0)
                            @foreach ($primerasVentas as $venta)
                                <div class="access-card mb-3 p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="log-total me-3">
                                            Venta #{{ $venta->id_venta }}
                                        </strong>
                                        <span class="log-total">${{ number_format($venta->total, 0, ',', '.') }}</span>
                                    </div>
                                    
                                    <div class="log-details small mt-1">
                                        <p class="mb-0">
                                            <span style="color: #8B4513;">
                                                <i class="fas fa-user me-1"></i> Atendido: {{ $venta->usuario->name ?? 'N/A' }}
                                            </span>
                                            <span class="ms-3">
                                                <i class="fas fa-tag me-1"></i> Tipo: {{ $venta->tipoVenta->tipo ?? 'N/A' }}
                                            </span>
                                            <span class="ms-3 text-muted">
                                                <i class="fas fa-clock me-1"></i> {{ $venta->fecha_hora_venta->format('d/m/Y H:i') }}
                                            </span>
                                        </p>
                                        <p class="mb-0 mt-1 text-secondary fst-italic">
                                            Productos: {{ $venta->productos->count() }} ítems en total.
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted mt-5">No se han registrado ventas recientemente.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 ">
                <div class="card p-4 custom-card-style">
                    <h5 class="card-title mb-4" style="color: #a0522d; font-weight: bold;">
                        Generar Reporte de Ventas
                    </h5>
                    <form id="reporteVentaForm" 
                          action="{{ route('administrador.reportesVenta.generar') }} "
                          method="POST"
                          target="_blank"
                          class="mt-auto pt-3"> 
                        @csrf
                        <p class="text-muted small mb-3">Selecciona el rango de fechas para generar el reporte detallado de ventas.</p>
                        <div class="align-items-end justify-content-between mb-3">
                            <div class="me-2">
                                @error('fecha_inicio')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <label for="fecha_inicio_venta"
                                       class="form-label small mb-1"
                                       style="color: #622D16; font-weight: 500;">Fecha de Inicio:</label>
                                <input type="date"
                                       id="fecha_inicio_venta"
                                       name="fecha_inicio"
                                       class="form-control btn-modificar-perfil"
                                       required 
                                       style="padding-right: 12px; height: 45px; border-color: #622D16;" 
                                       max="{{ now()->toDateString() }}"/>
                            </div>

                            <div class="flex-grow-1 me-2">
                                @error('fecha_fin')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <label for="fecha_fin_venta" class="form-label small mb-1" style="color: #622D16; font-weight: 500;">Fecha de Fin:</label>
                                <input type="date" 
                                       id="fecha_fin_venta" 
                                       name="fecha_fin"
                                       class="form-control btn-modificar-perfil" 
                                       required 
                                       style="padding-right: 12px; height: 45px; border-color: #622D16;" 
                                       max="{{ now()->toDateString() }}"/>
                            </div>
                        </div>

                        <div class="d-grid gap-2 pt-0">
                            <button type="submit" class="btn btn-modificar-perfil" style="height: 45px;">
                                Generar Reporte de Ventas PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>