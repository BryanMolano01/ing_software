<x-app-layout> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
        $adminLinks = [
            ['title' => 'Productos', 'route' => 'panadero.productoPanadero.index'],
            ['title' => 'Notificaciones', 'route' => 'panadero.notificacion.index'],
            ['title' => 'Registrar Uso Insumos', 'route' => 'panadero.itemPanadero.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />
    <div class="container-fluid py-4">
        
        <div class="row mb-4 header-venta align-items-center justify-content-center">
            <div class="col-12 d-flex flex-column align-items-center"> 
                
                <div class="d-flex align-items-center mb-3"> 
                    
                    <div class="dropdown me-2">
                        <button id="btn-tamano" class="btn btn-select-venta dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tamaño
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item filtro-tamano" href="#" data-id="all">Mostrar Todos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach ($tamanosProducto as $tamano)
                                <li><a class="dropdown-item filtro-tamano" href="#" data-id="{{ $tamano->id_tamano_producto }}">{{ $tamano->tamano }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="dropdown me-2">
                        <button id="btn-tipo" class="btn btn-select-venta dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tipo
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item filtro-tipo" href="#" data-id="all">Mostrar Todos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach ($tiposProducto as $tipo)
                                <li><a class="dropdown-item filtro-tipo" href="#" data-id="{{ $tipo->id_tipo_producto }}">{{ $tipo->tipo }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="input-group input-group-venta flex-grow-1" style="width: 600px;">
                        <span class="input-group-text search-icon" id="search-addon">
                            <i class="fas fa-search"></i> 
                        </span>
                        <input type="search" id="searchInputProducto" class="form-control input-search-venta" placeholder="Buscar..." aria-label="Search" aria-describedby="search-addon" />
                    </div>
                </div>
                
                <div class="mt-2"> 
                    <button type="button" class="btn btn-register-venta-lg">
                        Registrar Producto
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4" id="productListContainer">
            @include('partials.producto_pedido_list', ['productos' => $productos])
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const searchRoute = '{{ route('panadero.productoPanadero.buscar') }}';

            $('#searchInputProducto').on('keyup', function() {
                var searchTerm = $(this).val(); 
                
                filtroTamanoActual = 'all';
                filtroTipoActual = 'all';
                $('#btn-tamano').text('Tamaño');
                $('#btn-tipo').text('Tipo');

                
                $.ajax({
                    url: searchRoute, 
                    method: 'GET',
                    data: {
                        search: searchTerm
                    },
                    success: function(response) {
                        $('#productListContainer').html(response.html); 
                    },
                    error: function(error) {
                        console.error("Error en la búsqueda:", error);
                    }
                });
            });

            $(document).on('click', '.btn-counter-plus', function() {
                const $inputGroup = $(this).closest('.input-group');
                const $input = $inputGroup.find('.counter-input');
                
                let valorActual = parseInt($input.val()) || 0; 
                
                const stockDisponible = parseInt($inputGroup.data('stock')) || 0; 
                
                if (valorActual < stockDisponible) {
                    $input.val(valorActual + 1);
                } else {
                    $input.val(valorActual + 1);
                }

            });

            $(document).on('click', '.btn-counter-minus', function() {
                const $input = $(this).closest('.input-group').find('.counter-input');
                let valorActual = parseInt($input.val()) || 0;
                
                if (valorActual > 0) {
                    $input.val(valorActual - 1);
                }
            });
                    
            function obtenerProductosSeleccionados() {
                let productosVenta = [];

                $('.input-counter').each(function() {
                    const $container = $(this);
                    const productoId = $container.data('producto-id');
                    const cantidad = parseInt($container.find('.counter-input').val()) || 0; 
                    
                    if (cantidad > 0) {
                        productosVenta.push({
                            id: productoId,
                            cantidad: cantidad
                        });
                    }
                });

                return productosVenta;
            }

            $('.btn-register-venta-lg').on('click', function(e) {
                e.preventDefault();

                const itemsVenta = obtenerProductosSeleccionados();

                if (itemsVenta.length === 0) {
                    alert('Por favor, selecciona al menos un producto para registrar el pedido.');
                    return;
                }

                console.log('Datos listos para enviar:', itemsVenta);

                $.ajax({
                    url: '{{ route('panadero.productoPanadero.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productos: itemsVenta
                    },
                    success: function(response) {
                        alert('Producto Registrado con exito');
                    },
                    error: function(xhr, status, error) {
                        alert('Error al registrar el producto. Revisa la consola para más detalles.');
                        console.error("Error al enviar el producto:", xhr.responseText);
                    }
                });
            });

            let filtroTamanoActual = 'all';
            let filtroTipoActual = 'all';

            function aplicarFiltros() {
                
                $('.producto-item-col').hide();
                
                $('.producto-item-col').each(function() {
                    const $producto = $(this);
                    const productoTamanoId = $producto.data('tamano-id').toString();
                    const productoTipoId = $producto.data('tipo-id').toString();
                    
                    let coincideTamano = (filtroTamanoActual === 'all' || filtroTamanoActual === productoTamanoId);
                    let coincideTipo = (filtroTipoActual === 'all' || filtroTipoActual === productoTipoId);
                    
                    if (coincideTamano && coincideTipo) {
                        $producto.show();
                    }
                });
            }

            $(document).on('click', '.filtro-tamano', function(e) {
                e.preventDefault();
                const idSeleccionado = $(this).data('id').toString();
                const textoSeleccionado = $(this).text();
                
                filtroTamanoActual = idSeleccionado;
                
                $('#btn-tamano').text('Tamaño: ' + textoSeleccionado);
                
                aplicarFiltros();
            });

            $(document).on('click', '.filtro-tipo', function(e) {
                e.preventDefault();
                const idSeleccionado = $(this).data('id').toString();
                const textoSeleccionado = $(this).text();
                
                filtroTipoActual = idSeleccionado;

                $('#btn-tipo').text('Tipo: ' + textoSeleccionado);

                aplicarFiltros();
            });

            aplicarFiltros();

        });
    </script>
</x-app-layout>
