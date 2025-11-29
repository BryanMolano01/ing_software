<x-app-layout> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
        $adminLinks = [];
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
                    
                    <button class="btn btn-pedidos ms-2" type="button" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasPedidos" 
                            aria-controls="offcanvasPedidos">
                        Pedidos
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasPedidos" aria-labelledby="offcanvasPedidosLabel">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" style="padding: 0.5rem 1rem; font-size: 0.9rem;"aria-label="Close"></button>
                        <div class="offcanvas-header" style="background-color: #f7f7f7; justify-content: space-between;">
                            <div class="text-center w-100">
                                <button 
                                    type="button" 
                                    class="btn btn-register-pedido-lg" 
                                    style="padding: 0.5rem 1rem; font-size: 0.9rem;" 
                                    onclick="window.location='{{ route('cajero.pedido.index') }}'">
                                    Nuevo Pedido
                                </button>
                            </div>
                        </div>
                        
                        <div class="offcanvas-body" id="pedidos-lista" style="background-color: #f7f7f7;">
                            <p>Cargando pedidos...</p>
                        </div>
                    </div>
                    
                </div>
                
                <div class="mt-2"> 
                    <button type="button" class="btn btn-register-venta-lg">
                        Registrar Venta
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4" id="productListContainer">
            @include('partials.producto_cajero_list', ['productos' => $productos])
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const searchRoute = '{{ route('cajero.venta.buscar') }}';

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

            let pedidosActuales = {!! json_encode($pedidos) !!};

            let pedidosMapeados = pedidosActuales.map(pedido => ({
                id: pedido.id_venta,
                cliente: 'Cliente Desconocido', 
                total: pedido.total,
                fechaEntrega: new Date(pedido.fecha_hora_entrega).toLocaleDateString('es-CO'),
            }));

            function renderizarPedido(pedido) {
                const abonoCalculado = pedido.total / 2;
                
                const formatter = new Intl.NumberFormat('es-CO', {
                    style: 'currency',
                    currency: 'COP',
                    minimumFractionDigits: 0
                });

                return `
                    <div class="pedido-item" id="pedido-${pedido.id}" style="border-radius: 0.5rem; padding: 1rem; border: 1px solid #FFB266; margin-bottom: 1rem;">
                        
                        <h6 style="color: #622D16;">Pedido #${pedido.id}</h6>
                        
                        <p class="mb-1" style="color: #622D16;"><strong>Fecha de entrega:</strong> ${pedido.fechaEntrega}</p>
                        <p class="mb-1" style="color: #622D16;"><strong>Abono:</strong> ${formatter.format(abonoCalculado)}</p>
                        <p class="mb-3" style="color: #622D16;"><strong>Total:</strong> ${formatter.format(pedido.total)}</p>
                        
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="btn btn-sm btn-completar-pedido" data-id="${pedido.id}" style="background-color: #ffe0b2; color: #622D16; border: 1px solid #FFB266;">
                                Completado
                            </button>
                        </div>
                    </div>
                `;
            }

            function cargarPedidos() {
                const $lista = $('#pedidos-lista');
                $lista.empty();

                if (pedidosMapeados.length === 0) {
                    $lista.html('<p class="text-center text-muted">No hay pedidos pendientes actualmente.</p>');
                    return;
                }

                let htmlPedidos = '';
                pedidosMapeados.forEach(pedido => {
                    htmlPedidos += renderizarPedido(pedido);
                });
                
                $lista.html(htmlPedidos);
            }
            
            $('#offcanvasPedidos').on('show.bs.offcanvas', function () {
                cargarPedidos();
            });

            $(document).on('click', '.btn-completar-pedido', function() {
                const pedidoId = parseInt($(this).data('id'));
                if (isNaN(pedidoId) || pedidoId <= 0) {
                    alert("Error: ID de pedido no válido. No se puede completar.");
                    return; 
                }
                const updateRouteBase = '{{ route('cajero.venta.update', ['ventum' => 'PLACEHIT']) }}'; 
                const finalUrl = updateRouteBase.replace('PLACEHIT', pedidoId);
                $.ajax({
                    url: finalUrl,
                    method: 'POST', 
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                    },
                    success: function(response) {
                        pedidosMapeados = pedidosMapeados.filter(pedido => pedido.id !== pedidoId);

                        $(`#pedido-${pedidoId}`).fadeOut(300, function() {
                            cargarPedidos();
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Error al completar el pedido');
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
                    alert('¡Límite de stock alcanzado! Solo hay ' + stockDisponible + ' unidades disponibles.');
                }

            });

            $(document).on('click', '.btn-counter-minus', function() {
                const $input = $(this).closest('.input-group').find('.counter-input');
                let valorActual = parseInt($input.val()) || 0;
                
                if (valorActual > 0) {
                    $input.val(valorActual - 1);
                }
            });

            $(document).on('change keyup', '.counter-input', function() {
                const $input = $(this);
                const $inputGroup = $input.closest('.input-group');
                
                const stockDisponible = parseInt($inputGroup.data('stock')) || 0;
                let valorIngresado = parseInt($input.val());

                if (isNaN(valorIngresado) || valorIngresado < 0) {
                    $input.val(0);
                    return;
                }

                if (valorIngresado > stockDisponible) {
                    
                    $input.val(stockDisponible);

                    alert('¡Advertencia! El stock máximo permitido es ' + stockDisponible + ' unidades.');
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
                    alert('Por favor, selecciona al menos un producto para registrar la venta.');
                    return;
                }

                console.log('Datos listos para enviar:', itemsVenta);

                $.ajax({
                    url: '{{ route('cajero.venta.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productos: itemsVenta
                    },
                    success: function(response) {
                        alert('Venta registrada con éxito');
                    },
                    error: function(xhr, status, error) {
                        alert('Error al registrar la venta. Revisa la consola para más detalles.');
                        console.error("Error al enviar la venta:", xhr.responseText);
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
