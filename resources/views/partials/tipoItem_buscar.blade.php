@if(isset($tipos) && count($tipos) > 0)
    {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
    @foreach ($tipos as $tipo)
        {{-- Tarjeta Individual del Acceso --}}
        <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
            style="cursor: pointer;" 
            onclick="window.location='{{ route('administrador.tipoItem.edit', $tipo -> id_tipo_item) }}'"> 
            <strong class="log-username text-muted">Tipo: {{ $tipo -> tipo }}</strong>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
@endif