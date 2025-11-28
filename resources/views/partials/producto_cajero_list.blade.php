@if(isset($productos) && count($productos) > 0)
    @foreach ($productos as $producto)
        {{-- Contenedor del producto (columna) --}}
        <div class="col producto-item-col" 
             data-tamano-id="{{ $producto->tamano_producto_id_tamano_producto }}"
             data-tipo-id="{{ $producto->tipo_producto_id_tipo_producto }}">
            <div class="product-item text-center">
                
                {{-- Contenido del Producto --}}
                <div class="product-image-circle mx-auto mb-3">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid">
                </div>
                
                <div class="product-info">
                    <p class="h6 text-muted">Producto: {{ $producto->nombre }}</p>
                    <p class="h6 text-muted">Cantidad: {{ $producto->cantidad }}</p>
                </div>
                
                {{-- Contador (Asegúrate de que esta lógica esté en tu código original) --}}
                <div class="input-group input-counter mx-auto mt-2">
                    <button class="btn btn-counter-minus" type="button" data-id="{{ $producto->id_producto }}">-</button>
                    <input type="number" class="form-control text-center counter-input" value="0" min="0" data-price="{{ $producto->precio }}" data-id="{{ $producto->id_producto }}" readonly>
                    <button class="btn btn-counter-plus" type="button" data-id="{{ $producto->id_producto }}">+</button>
                </div>
                
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <p class="text-center text-muted mt-5">No hay productos que coincidan con la búsqueda.</p>
    </div>
@endif