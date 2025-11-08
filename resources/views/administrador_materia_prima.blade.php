<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<x-app-layout> 
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/materia.css') }}">
    @endpush
    <x-slot name="header">
        {{-- Slot header vacío para eliminar el texto "Dashboard" no deseado --}}
    </x-slot>
    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.materia_prima.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    {{-- Contenedor principal de la vista --}}
    <div class="container mt-4">
        
        {{-- Título principal de la página --}}
        <h2 class="mb-4" style="color: #622D16;">Administración de Materia Prima</h2> 
        
        {{-- FILA PRINCIPAL DE 3 COLUMNAS --}}
        <div class="row">
            {{-- Columna 1: USUARIOS (col-md-4) --}}
            {{-- En dashboard_administrador.blade.php (Columna 1: USUARIOS) --}}
            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Materia Prima</h5>

                    {{-- 1. Seccion de Toggles (Seleccione Materia o Proveedor) --}}
                    <div class="d-flex align-items-center mb-3">
                        <label class="form-label mb-0 me-3" style="color: #622D16;">Seleccione</label>

                        {{-- Toggle para Materia --}}
                        <div class="form-check form-switch me-4">
                            {{-- Asegúrate de que el input tenga un ID y la etiqueta un 'for' --}}
                            <input class="form-check-input custom-toggle" type="checkbox" id="toggleMateria" checked style="background-color: #ffe0b2; border-color: #ff9800;">
                            <label class="form-check-label" for="toggleMateria" style="color: #622D16;">Materia</label>
                        </div>
                        
                        {{-- Toggle para Proveedor --}}
                        <div class="form-check form-switch">
                            <input class="form-check-input custom-toggle" type="checkbox" id="toggleProveedor" style="background-color: #ffe0b2; border-color: #ff9800;">
                            <label class="form-check-label" for="toggleProveedor" style="color: #622D16;">Proveedor</label>
                        </div>
                    </div>
                    
                    {{-- 2. Barra de Búsqueda y Dropdown --}}
                    <div class="d-flex mb-3">
                        
                        {{-- Dropdown de Tipo (Harinas, Lacteos, etc.) --}}
                        <div class="dropdown me-2">
                            <button class="btn dropdown-toggle custom-dropdown-button" type="button" id="dropdownTipo" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                Tipo
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownTipo">
                                <li><a class="dropdown-item" href="#">Harinas</a></li>
                                <li><a class="dropdown-item" href="#">Lacteos</a></li>
                                <li><a class="dropdown-item" href="#">Azúcares</a></li>
                                {{-- ... más tipos ... --}}
                            </ul>
                        </div>
                        
                        {{-- Input de Búsqueda con Icono --}}
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputHistorial" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                        
                    </div>
                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainer">
                        @if(isset($Items) && count($Items) > 0)
                            {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
                            @foreach ($Items as $items)
                                {{-- Tarjeta Individual del Acceso --}}
                                <div class="access-card mb-2 p-3">
                                    
                                    {{-- Accede a la información del usuario a través de la relación 'usuario' --}}
                                    <strong class="log-username">Tipo: {{ $items -> tipoItem -> tipo}}</strong>
                                    <div class="log-details small">
                                        <span style="color: #622D16;">Cantidad: {{  $items -> cantidad }}</span>
                                        
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
                        @endif
                    </div>

                    <div class="d-grid gap-2 mt-auto"> 
                        <a href="{{ route('administrador.materia.create') }}" class="btn btn-modificar-perfil">
                            Registrar Nuevo Insumo
                        </a>
                    </div>
                </div>
            </div>

            {{-- Columna 2: REGISTRO DE ACCESOS (col-md-5) --}}
            <div class="col-md-5 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Historial de materia prima</h5>
                    
                    {{-- 1. Fila de Filtros/Píldoras --}}
                    {{-- El mismo código HTML de tu sección Historial de Materia Prima --}}
                    <div class="d-flex align-items-center mb-3">
                        <label class="form-label mb-0 me-3" style="color: #622D16;">Seleccione</label>

                        {{-- Toggle para Materia --}}
                        <div class="form-check form-switch me-4">
                            {{-- Asegúrate de que el input tenga un ID y la etiqueta un 'for' --}}
                            <input class="form-check-input custom-toggle" type="checkbox" id="toggleMateria" checked style="background-color: #ffe0b2; border-color: #ff9800;">
                            <label class="form-check-label" for="toggleMateria" style="color: #622D16;">Entrada</label>
                        </div>
                        
                        {{-- Toggle para Proveedor --}}
                        <div class="form-check form-switch">
                            <input class="form-check-input custom-toggle" type="checkbox" id="toggleProveedor" style="background-color: #ffe0b2; border-color: #ff9800;">
                            <label class="form-check-label" for="toggleProveedor" style="color: #622D16;">Salida</label>
                        </div>
                    </div>
                    
                    {{-- 2. Barra de Búsqueda y Botón --}}
                    <div class="d-flex mb-3">
                        
                        {{-- Input de Búsqueda (Caja ancha con icono) --}}
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputHistorial" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                        
                        {{-- Botón de Búsqueda --}}
                        <button class="btn btn-search-historial" type="button" 
                                style="background-color: #ffe0b2; color: #622D16; border: 1px solid #ff9800;">
                            Buscar
                        </button>
                        
                    </div>

                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainer">
                        @if(isset($primerosRegistros) && count($primerosRegistros) > 0)
                            @foreach ($primerosRegistros as $registro)
                                <div class="access-card mb-2 p-3">
                                    <strong class="log-username">
                                        Tipo: {{ $registro->item->tipoItem?->tipo ?? 'N/A' }} 
                                    </strong
                                    <strong class="log-username d-block">
                                        Unidad: {{ $registro->item->unidad_materia_prima?->nombre ?? 'N/A' }}
                                    </strong>
                                    
                                    <div class="log-details small">
                                        <span style="color: #622D16;">
                                            Cantidad Registrada: {{ $registro->item->cantidad ?? 'N/A' }}
                                        </span>
                                        
                                        <span class="ms-3">
                                            Registro: {{ $registro->fecha_hora_registro?->format('d/m/Y H:i') ?? 'N/A' }} 
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Columna 3: MI USUARIO (col-md-3) --}}
            <div class="col-md-3 mb-4">
                <div class="card p-4 custom-card-style d-flex flex-column align-items-center">
                    <h5 class="card-title w-100" style="color: #a0522d;">Proveedores</h5>
                    <div class="mb-3">
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputHistorial" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                    </div>

                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainer">
                        @if(isset($Items) && count($Items) > 0)
                            {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
                            @foreach ($Items as $items)
                                {{-- Tarjeta Individual del Acceso --}}
                                <div class="access-card mb-2 p-3">
                                    
                                    {{-- Accede a la información del usuario a través de la relación 'usuario' --}}
                                    <strong class="log-username">Tipo: {{ $items -> tipoItem -> tipo}}</strong>
                                    <div class="log-details small">
                                        <span style="color: #622D16;">Cantidad: {{  $items -> cantidad }}</span>
                                        
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
                        @endif
                    </div>

                    <div class="d-grid gap-2 mt-auto"> 
                        <a href="{{ route('administrador.proveedor.create') }}" class="btn btn-modificar-perfil">
                            Registrar Proveedor  
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</x-app-layout>