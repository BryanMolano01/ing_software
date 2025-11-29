<x-app-layout> 
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/materia.css') }}">
    @endpush
    <x-slot name="header">
    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
        $bakerLinks = [
        ];
    ?>
    <x-app-navbar :links="$bakerLinks" />

    <div class="container mt-4">
        <h2 class="mb-4" style="color: #622D16;">Registro de Uso de Materia Prima</h2> 
        
        <div class="row justify-content-center">
            
            <div class="col-md-5 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Materia Prima Disponible</h5>
                    <div class="d-flex mb-3">
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text custom-search-icon-historial" style="background-color: #ff9800; border-color: #ff9800; color: #622D16;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInputInsumo" class="form-control custom-search-input-historial" placeholder="Buscar..." aria-label="Buscar" style="border-color: #ff9800; box-shadow: none;">
                        </div>
                    </div>
                    
                    <div class="access-list-container flex-grow-1 overflow-auto" id="insumosListContainer">
                        @include('partials.panadero_materia_list', ['items' => $items])
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-4">
                    <h5 class="card-title" style="color: #a0522d;">Registrar Uso</h5>
                    <div id="usoMateriaPrimaSection"> 
                        <p class="text-muted text-center mt-3">Selecciona un insumo de la lista izquierda para registrar su uso.</p>
                    </div>
                    <form id="usoForm" action="..." method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="item_id" id="itemIdInput">
                        <input type="hidden" name="_method" value="PUT">
                        <div id="insumoDetails" class="mb-3 p-3" style="background-color: white; border: 1px solid #ff9800; border-radius: 5%">
                            <h6 id="insumoNombre" style="color: #622D16;"></h6>
                            <p class="mb-0 small" style="color: #622D16;">Cantidad Actual: <strong id="insumoStock"></strong></p>
                            <p class="mb-0 small" style="color: #622D16;">Unidad de Medida: <strong id="insumoUnidad"></strong></p>
                            <p class="mb-0 small" style="color: #622D16;">Proveedor: <strong id="insumoProveedor"></strong></p>
                            <p class="mb-0 small" style="color: #622D16;">Ubicación: <strong id="insumoUbicacion"></strong></p>
                        </div>

                        <div class="mb-4 form-group-with-icon">
                            <label for="cantidad_usada" class="form-label input-label" style="color: #622D16;">Cantidad Usada:</label>
                            <div class="input-group">
                                <input id="cantidad_usada" class="form-control login-input transparent-input-bottom-border" type="number" step="0.01" min="0" name="cantidad_usada" placeholder="0.00" required />
                                <span class="input-group-text" id="cantidadUnidadText" style="background-color: #f0f0f0; color: #622D16;"></span>
                            </div>
                            @error('cantidad_usada')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 mt-auto"> 
                            <button type="submit" class="btn btn-modificar-perfil">
                                Aceptar Registro de Uso
                            </button>
                        </div>
                    </form>
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
        const updateItemRouteBase = '{{ route('panadero.itemPanadero.update', ['itemPanadero' => 'ITEM_ID_PLACEHOLDER']) }}';

        $(document).ready(function() {

            $('#searchInputInsumo').on('keyup', function() {
                var searchTerm = $(this).val(); 
                
                $.ajax({
                    url: '{{ route('panadero.item.buscar') }}', 
                    method: 'GET',
                    data: {
                        search: searchTerm
                    }, 
                    success: function(response) {
                        $('#insumosListContainer').html(response.html); 
                    },
                    error: function(error) {
                        console.error("Error en la búsqueda:", error);
                    }
                });
            });

            $('#insumosListContainer').on('click', '.insumo-card', function() {
                const id = $(this).data('id');
                const nombre = $(this).data('nombre');
                const stock = $(this).data('stock');
                const unidad = $(this).data('unidad'); 
                const proveedor = $(this).data('proveedor'); 
                const ubicacion = $(this).data('ubicacion');

                $('#usoMateriaPrimaSection').hide();
                $('#usoForm').show();

                const finalUpdateUrl = updateItemRouteBase.replace('ITEM_ID_PLACEHOLDER', id);
                $('#usoForm').attr('action', finalUpdateUrl);

                $('#itemIdInput').val(id);
                $('#insumoNombre').text(nombre);
                $('#insumoStock').text(stock + ' ' + unidad);
                $('#insumoUnidad').text(unidad);
                $('#cantidadUnidadText').text(unidad);
                $('#insumoProveedor').text(proveedor); 
                $('#insumoUbicacion').text(ubicacion);

                $('.insumo-card').css('background-color', '#F8F4F0');
                $(this).css('background-color', '#ffb266');
            });
            
            $('#usoForm').on('submit', function(e) {
                const form = $(this);
                const cantidadUsada = parseFloat($('#cantidad_usada').val());
                const stockActual = parseFloat($('#insumoStock').text().split(' ')[0]);
                
                if (isNaN(cantidadUsada) || cantidadUsada <= 0) {
                    e.preventDefault();
                    alert('¡Error! Debes ingresar una cantidad válida.');
                    return;
                }

                if (cantidadUsada > stockActual) {
                    e.preventDefault();
                    alert('¡Error! La cantidad usada (' + cantidadUsada + ') no puede ser mayor al stock actual (' + stockActual + ').');
                    return; 
                }
                
                const nuevoStock = stockActual - cantidadUsada;
                
                $('<input>').attr({
                    type: 'hidden',
                    name: 'cantidad',
                    value: nuevoStock
                }).appendTo(form);
        
            });
        });
    </script>
</x-app-layout>