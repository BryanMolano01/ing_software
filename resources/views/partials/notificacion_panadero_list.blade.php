@if(isset($notificaciones) && count($notificaciones) > 0)
    @foreach ($notificaciones as $notificacion)
        <div class="access-card mb-2 p-3" style="border-left: 5px solid #ff9800;">
            
            <strong class="log-username" style="color: #a0522d;">
                {{ $notificacion->notificacion }}
            </strong>
            
            <div class="log-details small mt-1">
                
                <p class="mb-0 small" style="color: #622D16;">
                    Fecha y Hora: 
                    <strong>
                        {{ $notificacion->fecha_hora_notificacion->format('d/m/Y H:i') ?? 'N/A' }}
                    </strong>
                </p>

                @if ($notificacion->producto)
                    <p class="mb-0 small" style="color: #008080;">
                        Producto afectado: 
                        <strong>
                            {{ $notificacion->producto->nombre }}
                        </strong> 
                        (Stock Actual: {{ $notificacion->producto->cantidad }})
                    </p>
                @endif
                @if ($notificacion->venta)
                    <p class="mb-0 small" style="color: #622D16;">
                        Pedido Relacionado: 
                        <strong style="color: #ff9800;">
                            #{{ $notificacion->venta->id_venta }}
                        </strong> 
                        - Total: ${{ number_format($notificacion->venta->total, 2) }}
                    </p>
                @endif
                
            </div>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">Notificacion no encontrada.</p>
@endif