<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<x-app-layout>
    <x-slot name="header"></x-slot>
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
        <h2 class="mb-4" style="color: #622D16;">Administración de Materia Prima</h2>

        {{-- FILA PRINCIPAL DE 3 COLUMNAS --}}
        <div class="row">
            {{-- Columna 1: USUARIOS (col-md-4) --}}
            {{-- En dashboard_administrador.blade.php (Columna 1: USUARIOS) --}}
            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Materia Prima</h5>
                    {{--  
                    <div class="d-flex align-items-center mb-3">
                        
                        <label class="form-label mb-0 me-3" style="color: #622D16;">Seleccione</label>
                        <div class="form-check form-switch me-4">
                            <input class="form-check-input custom-toggle" type="checkbox" id="toggleMateria" checked style="background-color: #ffe0b2; border-color: #ff9800;">
                            <label class="form-check-label" for="toggleMateria" style="color: #622D16;">Materia</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input custom-toggle" type="checkbox" id="toggleProveedor" style="background-color: #ffe0b2; border-color: #ff9800;">
                            <label class="form-check-label" for="toggleProveedor" style="color: #622D16;">Proveedor</label>
                        </div>
                        
                    </div>
                    --}}

                    {{-- 2. Barra de Búsqueda y Dropdown --}}
                    <div class="d-flex mb-3">

                        {{-- 
                        <div class="dropdown me-2">
                            <button class="btn dropdown-toggle custom-dropdown-button" type="button" id="dropdownTipo" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                Tipo
                            </button>
                            @if(isset($Items) && count($Items) > 0)
                                @foreach ($Items as $items)
                                    <ul class="dropdown-menu" aria-labelledby="dropdownTipo"">
                                        <li class="log-details small">
                                            <a class="dropdown-item" href="#">{{ $items -> tipoItem -> tipo}}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                        --}}


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
                                <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
                                    style="cursor: pointer;"
                                    onclick="window.location='{{ route('administrador.items.edit', $items->id_item) }}'">
                                    {{-- Accede a la información del usuario a través de la relación 'usuario' --}}
                                    <strong class="log-username">Tipo: {{ $items -> tipoItem -> tipo}}</strong>
                                    <div class="log-details small">
                                        <span style="color: #622D16;">Cantidad: {{  $items -> cantidad }}</span>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="d-grid gap-2 mt-auto">
                        <a href="{{ route('administrador.items.create') }}" class="btn btn-modificar-perfil">
                            Registrar Nuevo Insumo
                        </a>
                    </div>
                </div>
            </div>

            {{-- Columna 2: REGISTRO DE ACCESOS (col-md-5) --}}
            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Historial de materia prima</h5>

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

                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainer">
                        {{-- ... Contenido de la lista de registros (sin cambios) ... --}}
                        @if(isset($primerosRegistros) && count($primerosRegistros) > 0)
                            @foreach ($primerosRegistros as $registro)
                                <div class="access-card mb-2 p-3">
                                    <strong class="log-username">
                                        Tipo: {{ $registro->item->tipoItem?->tipo ?? 'N/A' }}
                                    </strong>
                                    <strong class="log-username d-block">
                                        Unidad: {{ $registro->item->unidad_materia_prima?->unidad ?? 'N/A' }}
                                    </strong>

                                    <div class="log-details small">
                                        <span style="color: #622D16;">
                                            Cantidad: {{ $registro->item->cantidad ?? 'N/A' }}
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

                    <form id="createUserForm" action="{{ route('administrador.reportes.generar') }} "
                          method="POST"
                          target="_blank"
                          class="mt-auto pt-3"> @csrf
                        <div class="d-flex align-items-end justify-content-between mb-3">
                            {{-- 1. Campo Fecha de Inicio --}}
                            <div class="flex-grow-1 me-2">
                                @error('fecha_inicio')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <label for="fecha_inicio"
                                       class="form-label small mb-1"
                                       style="color: #622D16;">Fecha de Inicio:</label>
                                <input type="date"
                                       id="fecha_inicio"
                                       name="fecha_inicio"
                                       for="fecha_inicio"
                                       class="form-control btn-modificar-perfil"
                                       required 
                                       style="padding-right: 12px; height: 45px;" 
                                       max="{{ now()->toDateString() }}"/>
                            </div>
                            <div class="flex-grow-1 me-2">
                                @error('fecha_fin')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <label for="fecha_fin" class="form-label small mb-1" style="color: #622D16;">Fecha de Fin:</label>
                                <input type="date" 
                                       id="fecha_fin" 
                                       name="fecha_fin"
                                       for="fecha_fin" 
                                       class="form-control btn-modificar-perfil" 
                                       required 
                                       style="padding-right: 12px; height: 45px;" 
                                       max="{{ now()->toDateString() }}"/>
                            </div>
                        </div>
                        <div class="d-grid gap-2 pt-0">
                            <button type="button" id="openConfirmationModal" class="btn btn-modificar-perfil" style="height: 45px; min-width: 150px;">
                                Generar Reporte General
                            </button>
                        </div>
                    </form>
                    {{-- END: SECCIÓN DE REPORTES CON FECHAS --}}

                </div>
            </div>

            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Proveedores</h5>

                    {{-- 2. Barra de Búsqueda y Botón --}}
                    <div class="d-flex mb-3">
                        {{-- Input de Búsqueda (Caja ancha con icono) --}}
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputProveedor" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                    </div>

                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainerProveedores">
                        @include('partials.proveedor_buscar', ['proveedores' => $proveedores])
                    </div>

                    <div class="d-grid gap-2 mt-auto">
                        <a href="{{ route('administrador.proveedores.create') }}" class="btn btn-modificar-perfil">
                            Registrar Nuevo Proveedor
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3 mb-5">
            @include('partials.botones_materia')
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom1-card-style p-4">
                <div class="modal-body text-center">
                    <img src="{{ asset('images/Alerta Triangulo.png') }}" alt="Advertencia" class="mb-3" style="width: 60px;">
                    <h5 class="mb-4" style="color: #622D16;">¿Está seguro que quiere generar este reporte?</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-custom-action" id="confirmCreateUser">Generar Reporte</button>
                        <button type="button" class="btn btn-custom-cancel" data-bs-dismiss="modal">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupPasswordToggle(toggleBtnId, passwordInputId) {
                const toggleBtn = document.getElementById(toggleBtnId);
                const passwordInput = document.getElementById(passwordInputId);

                if (toggleBtn && passwordInput) {
                    toggleBtn.addEventListener('click', function(e) {
                        e.preventDefault(); 
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                    });
                }
            }

            setupPasswordToggle('togglePassword', 'password');
            setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation');

            const openConfirmationModalBtn = document.getElementById('openConfirmationModal');
            const confirmCreateUserBtn = document.getElementById('confirmCreateUser');
            const createUserForm = document.getElementById('createUserForm');

            if (openConfirmationModalBtn && confirmCreateUserBtn && createUserForm) {
                openConfirmationModalBtn.addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    myModal.show();
                });

                confirmCreateUserBtn.addEventListener('click', function() {
                    var myModal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
                    if (myModal) {
                        myModal.hide();
                    }
                    createUserForm.submit();
                });
            }
        });
    </script>

    <style>
        .custom1-card-style {
            background-color: #F8F4F0; /* Color de fondo claro */
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
            border: none;

            padding: 30px 20px !important;
        }

        .btn-custom-action {
            background-color: #FB9F40; /* Naranja para crear usuario */
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-custom-action:hover {
            background-color: #e58d35; /* Naranja más oscuro al pasar el mouse */
            color: white;
        }

        .btn-custom-cancel {
            background-color: #f0f0f0; /* Gris claro para volver */
            color: #622D16;
            border: 1px solid #d0d0d0;
            border-radius: 20px;
            padding: 10px 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-custom-cancel:hover {
            background-color: #e0e0e0; /* Gris más oscuro al pasar el mouse */
            color: #622D16;
        }
    </style>

</x-app-layout>
<script>
    $(document).ready(function() {
        // Captura el evento 'keyup' en el input de búsqueda
        $('#searchInputProveedor').on('keyup', function() {
            var searchTerm = $(this).val(); // Obtiene el texto actual
            $.ajax({
                url: '{{ route('administrador.proveedor.buscar') }}', // **Usamos la ruta definida en web.php**
                method: 'GET',
                data: {
                    search: searchTerm
                }, // Envía el término de búsqueda
                success: function(response) {
                    // ¡CLAVE! Reemplaza el contenido del DIV con id="accessListContainer"
                    $('#accessListContainerProveedores').html(response.html);
                },
                error: function(error) {
                    console.error("Error en la búsqueda:", error);
                }
            });
        });
    });
</script>
