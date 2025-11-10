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
            ['title' => 'Usuarios', 'route' => 'administrador.dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.items.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    {{-- Contenedor principal de la vista --}}
    <div class="container mt-4">
        
        {{-- Título principal de la página --}}
        <h2 class="mb-4" style="color: #622D16;">Administración de Tipos</h2> 
        
        {{-- FILA PRINCIPAL DE 3 COLUMNAS --}}
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="card p-4 custom-card-style-create d-flex flex-column align-items-center">
                    <h5 class="card-title w-100" style="color: #a0522d;">Creación de tipo</h5>
                    <form id="createUserForm" action="{{ route('administrador.proveedores.store') }}" method="POST">
                        @csrf
                        <div class="w-100 text-left mb-4">
                            <div class="mb-4 form-group-with-icon">
                                <label for="nombre" class="form-label input-label">Tipo:</label>
                                <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="" required />
                                @error('nombre')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 mt-auto"> 
                                <a href="{{ route('administrador.proveedores.create') }}" class="btn btn-modificar-perfil">
                                    Crear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Tipos existentes</h5>
                    
                    {{-- 2. Barra de Búsqueda y Botón --}}
                    <div class="d-flex mb-3">
                        {{-- Input de Búsqueda (Caja ancha con icono) --}}
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputHistorial" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                    </div>
                    <?php 
                        // 1. Define un array de datos de ejemplo con la estructura simplificada que necesitas mostrar
                        $Items = [
                            ['id' => 1, 'tipo' => 'Frutas'],
                            ['id' => 2, 'tipo' => 'Verduras'],
                            ['id' => 3, 'tipo' => 'Lácteos'],
                            ['id' => 4, 'tipo' => 'Carnes'],
                        ];
                    ?>
                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainer">
                        @if(isset($Items) && count($Items) > 0)
                            {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
                            @foreach ($Items as $items)
                                {{-- Tarjeta Individual del Acceso --}}
                                <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
                                    style="cursor: pointer;" 
                                    onclick="window.location='{{ route('administrador.tipos.edit') }}'"> 
                                    <strong class="log-username text-muted">Tipo: {{ $items['tipo'] }} (Ejemplo)</strong>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-3 mb-5">
            @include('partials.botones_materia')
        </div>

    </div>

</x-app-layout>