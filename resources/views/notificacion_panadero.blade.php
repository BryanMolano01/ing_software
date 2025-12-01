<x-app-layout> 
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/materia.css') }}">
    @endpush
    <x-slot name="header">
    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
        $bakerLinks = [
            ['title' => 'Productos', 'route' => 'panadero.productoPanadero.index'],
            ['title' => 'Notificaciones', 'route' => 'panadero.notificacion.index'],
            ['title' => 'Venta y pedidos', 'route' => 'panadero.itemPanadero.index'],
        ];
    ?>
    <x-app-navbar :links="$bakerLinks" />

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                <h5 class="card-title" style="color: #a0522d;">Notifiaciones</h5>
                <div class="mb-3">
                    <div class="input-group flex-grow-1 me-2">
                        <span class="input-group-text custom-search-icon-historial" style="background-color: #FFE2C4; border-color: #ff9800; color: #622D16;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control custom-search-input-historial" placeholder="Buscar" aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                    </div>
                </div>
                <div class="access-list-container flex-grow-1 overflow-auto" id="notificacionesListContainer">
                    @include('partials.notificacion_panadero_list', ['notifiaciones' => $notificaciones])
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-card-style, .custom-card-style-create {
            background-color: #F8F4F0; /* Color de fondo claro */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 20px !important; 
        }
        .insumo-card:hover {
            background-color: #ffe0b2 !important; /* Resaltar al pasar el mouse */
            transition: background-color 0.2s;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchTerm = $(this).val(); 
                $.ajax({
                    url: '{{ route('panadero.notificacionPanadero.buscar') }}', 
                    method: 'GET',
                    data: {
                        search: searchTerm
                    }, 
                    success: function(response) {
                        $('#notificacionesListContainer').html(response.html); 
                    },
                    error: function(error) {
                        console.error("Error en la búsqueda:", error);
                    }
                });
            });
        });
    </script>
</x-app-layout>


