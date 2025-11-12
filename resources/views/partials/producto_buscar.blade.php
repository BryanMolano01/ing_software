@if(isset($productos) && count($productos) > 0)
    {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
    @foreach ($productos as $producto)
        {{-- Tarjeta Individual del Acceso --}}
        <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
            style="cursor: pointer;" 
            onclick="window.location='{{ route('administrador.producto.edit', $producto -> id_producto) }}'"> 
            <strong class="log-username text-muted">Receta: {{ $producto -> nombre }}</strong>
            <strong class="log-username text-muted">Precio: {{ $producto -> precio }}</strong>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
@endif