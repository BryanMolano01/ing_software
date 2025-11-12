@if(isset($proveedores) && count($proveedores) > 0)
    @foreach ($proveedores as $proveedor)
        <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
            style="cursor: pointer;" 
            onclick="window.location='{{ route('administrador.proveedores.edit', $proveedor->id_proveedor) }}'"> 
            <strong class="log-username">
                Nombre: 
                {{ $proveedor->nombre?? 'N/A' }} 
            </strong>
            <strong class="log-username">
                Telefono: 
                {{ $proveedor->telefono?? 'N/A' }} 
            </strong>
        </div>
    @endforeach
@else
    <p class="text-center text-muted mt-5">No hay registros que coincidan con la búsqueda.</p>
@endif