@if(isset($registros) && count($registros) > 0)
    {{-- Itera sobre la colección de registros filtrados (la variable ahora es $registros) --}}
    @foreach ($registros as $registro)
        {{-- Tarjeta Individual del Acceso --}}
        <div class="access-card mb-2 p-3">
            
            {{-- Accede a la información del usuario a través de la relación 'usuario' --}}
            <strong class="log-username">{{ $registro->usuario->nombre }}</strong>
            
            <div class="log-details small">
                
                {{-- Muestra la fecha/hora del registro de acceso --}}
                Acceso: 
                {{ $registro -> fecha_hora_registro->format('d/m/Y H:i') ?? 'N/A' }} 
                
                <span style="color: #622D16;">Rol: {{ $registro->usuario->rol-> rol ?? 'N/A' }}</span>
                
            </div>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
@endif