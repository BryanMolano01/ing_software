@if(isset($unidades) && count($unidades) > 0)
    {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
    @foreach ($unidades as $unidad)
        {{-- Tarjeta Individual del Acceso --}}
        <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
            style="cursor: pointer;" 
            onclick="window.location='{{ route('administrador.medida.edit',$unidad -> id_unidad_materia_prima ) }}'"> 
            <strong class="log-username text-muted">Unidad: {{ $unidad -> unidad}}</strong>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
@endif