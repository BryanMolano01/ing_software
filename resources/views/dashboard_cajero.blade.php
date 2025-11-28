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
                        <button class="btn btn-select-venta dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tamaño
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($tamanosProducto as $tamano)
                                <li><a class="dropdown-item" href="#">{{ $tamano->tamano }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="dropdown me-2">
                        <button class="btn btn-select-venta dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categoría
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($tiposProducto as $tipo)
                                <li><a class="dropdown-item" href="#">{{ $tipo->tipo }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="input-group input-group-venta flex-grow-1" style="width: 600px;">
                        <span class="input-group-text search-icon" id="search-addon">
                            <i class="fas fa-search"></i> 
                        </span>
                        <input type="search" class="form-control input-search-venta" placeholder="Buscar..." aria-label="Search" aria-describedby="search-addon" />
                    </div>
                    
                    <button type="button" class="btn btn-pedidos ms-2">
                        Pedidos
                    </button>
                    
                </div>
                
                <div class="mt-2"> 
                    <button type="button" class="btn btn-register-venta-lg">
                        Registrar Venta
                    </button>
                </div>
                
            </div>
        </div>
        
        <hr/>
        
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4">
            
            @foreach ($productos as $producto)
                <div class="col">
                    <div class="product-item text-center">
                        <div class="product-image-circle mx-auto mb-2">
                            <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="img-fluid" />
                        </div>
                        
                        <div class="product-info">
                            <p class="mb-0"><strong>Producto:</strong> {{ $producto->nombre }}</p>
                            <p class="mb-2"><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
        
                            <div class="input-group input-counter mx-auto" 
                                data-producto-id="{{ $producto->id_producto }}" 
                                data-stock="{{ $producto->cantidad }}"> 
                                
                                <button class="btn btn-counter-minus" type="button">-</button>
                                <input type="number" class="form-control text-center counter-input" value="0" min="0" readonly>
                                <button class="btn btn-counter-plus" type="button">+</button>
                            </div>
                            <small class="text-muted">${{ number_format($producto->precio, 2) }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
    <script>
        $(document).ready(function() {

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
                    url: '/venta.store', // aqui pones la url de donde lo vayas a mandar
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productos: itemsVenta
                    },
                    success: function(response) {
                        alert('Venta registrada con éxito: ' + response.mensaje);
                    },
                    error: function(xhr, status, error) {
                        alert('Error al registrar la venta. Revisa la consola para más detalles.');
                        console.error("Error al enviar la venta:", xhr.responseText);
                    }
                });
            });

        });
        </script>
</x-app-layout>
