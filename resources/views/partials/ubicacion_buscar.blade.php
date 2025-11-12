@if(isset($ubicaciones) && count($ubicaciones) > 0)
    {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
    @foreach ($ubicaciones as $ubicacion)
        {{-- Tarjeta Individual del Acceso --}}
        <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
            style="cursor: pointer;" 
            onclick="window.location='{{ route('administrador.ubicacion.edit', $ubicacion -> id_ubicacion) }}'"> 
            <strong class="log-username text-muted">Ubicación: {{ $ubicacion -> ubicacion }}</strong>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
@endif