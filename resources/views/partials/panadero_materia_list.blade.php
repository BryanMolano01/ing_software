@if(isset($items) && $items->count() > 0)
    @foreach ($items as $insumo)
        <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3 insumo-card"
            style="cursor: pointer;"
            data-id="{{ $insumo->id_item }}"
            data-nombre="{{ $insumo->tipoItem->tipo }}"
            data-stock="{{ $insumo->cantidad }}"
            data-unidad="{{ $insumo->unidad_item?->unidad }}"
            data-proveedor="{{ $insumo->proveedor?->nombre }}" 
            data-ubicacion="{{ $insumo->ubicacion?->ubicacion }}">
            
            <strong class="log-username">{{ $insumo->tipoItem->tipo }}</strong>
            <div class="log-details small">
                <span style="color: #622D16;">
                    Cantidad: {{ $insumo->cantidad }} {{ $insumo->unidad_item?->unidad }}
                </span>
            </div>
        </div>
    @endforeach
@else
    <p class="text-muted">No hay materia prima disponible.</p>
@endif