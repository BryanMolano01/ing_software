<x-app-layout> 

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
                            <li><a class="dropdown-item" href="#">Grande</a></li>
                            <li><a class="dropdown-item" href="#">Mediano</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown me-2">
                        <button class="btn btn-select-venta dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categoría
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pan de Dulce</a></li>
                            <li><a class="dropdown-item" href="#">Pan Salado</a></li>
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
        

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4">
            @for ($i = 1; $i <= 12; $i++)
                <div class="col">
                    <div class="product-item text-center">
                        <div class="product-image-circle mx-auto mb-2">
                            <img src="{{ asset('ruta/a/tu/imagen-pan.jpg') }}" alt="Pan {{$i}}" class="img-fluid" />
                        </div>
                        
                        <div class="product-info">
                            <p class="mb-0"><strong>Producto:</strong> Pan {{$i}}</p>
                            <p class="mb-2"><strong>Cantidad:</strong> 50</p>
                            
                            <div class="input-group input-counter mx-auto">
                                <button class="btn btn-counter-minus" type="button">-</button>
                                <input type="number" class="form-control text-center counter-input" value="0" min="0">
                                <button class="btn btn-counter-plus" type="button">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            </div>
    </div>
</x-app-layout>