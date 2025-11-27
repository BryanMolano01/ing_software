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
        <h2 class="mb-4" style="color: #622D16;">Administración de Productos</h2> 
        
        {{-- FILA PRINCIPAL DE 3 COLUMNAS --}}
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="card p-4 custom-card-style-create d-flex flex-column align-items-center">
                    <h5 class="card-title w-100" style="color: #a0522d;">Creación de nuevo Producto</h5>
                    <form id="createUserForm" action="{{ route('administrador.producto.store') }}" method="POST">
                        @csrf
                        <div class="w-100 text-left mb-4">
                            <input id="estado_producto_id_estado_producto" class="form-control login-input transparent-input-bottom-border" type="number" name="estado_producto_id_estado_producto" value="1" hidden required />
                            <div class="mb-4 form-group-with-icon">
                                <label for="nombre" class="form-label input-label">Nombre:</label>
                                <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="" required />
                                @error('nombre')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 form-group-with-icon">
                                <label for="descripcion" class="form-label input-label">Descripción:</label>
                                <input id="descripcion" class="form-control login-input transparent-input-bottom-border" type="tex-area" name="descripcion" value="{{ old('descripcion') }}" placeholder="" required />
                                @error('descripcion')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 form-group-with-icon">
                                <label for="precio" class="form-label input-label">Precio:</label>
                                <input id="precio" class="form-control login-input transparent-input-bottom-border" type="number" name="precio" value="{{ old('precio') }}" placeholder="" required />
                                @error('precio')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 form-group-with-icon d-flex align-items-center">
                                <label for="tipo_producto_id_tipo_producto" class="form-label input-label me-2 mb-0">Tipo:</label>
                                <select id="tipo_producto_id_tipo_producto" name="tipo_producto_id_tipo_producto" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                    
                                    <option value="" disabled selected>Seleccione un tipo </option> {{-- Placeholder --}}
                                    
                                    {{-- Bucle para cargar los roles reales --}}
                                    @isset($tipos)
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id_tipo_producto }}" {{ old('tipo_producto_id_tipo_producto') == $tipo->id_tipo_producto ? 'selected' : '' }}>
                                                {{ $tipo->tipo }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('tipo_producto_id_tipo_producto')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 form-group-with-icon d-flex align-items-center">
                                <label for="tamano_producto_id_tamano_producto" class="form-label input-label me-2 mb-0">Tamaño:</label>
                                <select id="tamano_producto_id_tamano_producto" name="tamano_producto_id_tamano_producto" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                    
                                    <option value="" disabled selected>Seleccione un tamaño</option> {{-- Placeholder --}}
                                    {{-- Bucle para cargar los roles reales --}}
                                    @isset($tamanos)
                                        @foreach ($tamanos as $tamano)
                                            <option value="{{ $tamano->id_tamano_producto }}" {{ old('tamano_producto_id_tamano_producto') == $tamano->id_tamano_producto ? 'selected' : '' }}>
                                                {{ $tamano->tamano }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('tamano_producto_id_tamano_producto')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 mt-auto"> 
                                <button type="submit" class="btn btn-modificar-perfil">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Productos existentes</h5>
                    
                    {{-- 2. Barra de Búsqueda y Botón --}}
                    <div class="d-flex mb-3">
                        {{-- Input de Búsqueda (Caja ancha con icono) --}}
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputProducto" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                    </div>
                    <div class="access-list-container flex-grow-1 overflow-auto" id="accessListContainerProductos">
                        @include('partials.producto_buscar', ['productos' => $productos])
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3 mb-5">
            @include('partials.botones_materia')
        </div>
    </div>

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
        $('#searchInputProducto').on('keyup', function() {
            var searchTerm = $(this).val(); // Obtiene el texto actual
            $.ajax({
                url: '{{ route('administrador.producto.buscar') }}', // **Usamos la ruta definida en web.php**
                method: 'GET',
                data: {
                    search: searchTerm
                }, // Envía el término de búsqueda
                success: function(response) {
                    // ¡CLAVE! Reemplaza el contenido del DIV con id="accessListContainer"
                    $('#accessListContainerProductos').html(response.html); 
                },
                error: function(error) {
                    console.error("Error en la búsqueda:", error);
                }
            });
        });
    });
</script>