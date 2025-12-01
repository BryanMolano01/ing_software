<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'administrador.dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.items.index'],
            ['title' => 'Ventas', 'route' => 'administrador.ventasAdmin.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Producto</h2> 
        
        <div class="card p-4 custom-card-style-create mx-auto" style="max-width: 800px;">
            {{-- action="{{ route('administrador.proveedores.update') }}" --}}
            <form id="editUserForm" action="{{ route('administrador.producto.update', $producto->id_producto) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row justify-content-center">
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        <div class="mb-4 form-group-with-icon">
                            <label for="nombre" class="form-label input-label">Nombre:</label>
                            <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" placeholder="" required />
                            @error('nombre')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon">
                            <label for="descripcion" class="form-label input-label">Descripción:</label>
                            <textarea id="descripcion" class="form-control login-input transparent-input-bottom-border" type="text" name="descripcion"  placeholder="" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon">
                            <label for="precio" class="form-label input-label">Precio:</label>
                            <input id="precio" class="form-control login-input transparent-input-bottom-border" type="number" name="precio" value="{{ old('precio', $producto->precio) }}" placeholder="" required />
                            @error('precio')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="tipo_producto_id_tipo_producto" class="form-label input-label me-2 mb-0">Tipo:</label>
                            <select id="tipo_producto_id_tipo_producto" name="tipo_producto_id_tipo_producto" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_producto }}" 
                                        @if (old('tipo_producto_id_tipo_producto', $producto->tipo_producto_id_tipo_producto) == $tipo->id_tipo_producto) selected @endif>
                                        {{ $tipo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_producto_id_tipo_producto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="tamano_producto_id_tamano_producto" class="form-label input-label me-2 mb-0">Tamaño:</label>
                            <select id="tamano_producto_id_tamano_producto" name="tamano_producto_id_tamano_producto" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($tamanos as $tamano)
                                    <option value="{{ $tamano->id_tamano_producto }}" 
                                        @if (old('tamano_producto_id_tamano_producto', $producto->tamano_producto_id_tamano_producto) == $tamano->id_tamano_producto) selected @endif>
                                        {{ $tamano->tamano }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tamano_producto_id_tamano_producto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="estado_producto_id_estado_producto" class="form-label input-label me-2 mb-0">Estado:</label>
                            <select id="estado_producto_id_estado_producto" name="estado_producto_id_estado_producto" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id_estado_producto }}" 
                                        @if (old('estado_producto_id_estado_producto', $producto->estado_producto_id_estado_producto) == $estado->id_estado_producto) selected @endif>
                                        {{ $estado->estado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estado_producto_id_estado_producto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-auto"> 
                            <button type="submit" class="btn btn-modificar-perfil">
                                Guardar Cambios
                            </button>
                        </div>
                        <div class="col-12 d-flex justify-content-start">
                            <a href="{{ route('administrador.producto.index') }}" class="btn btn-modificar-perfil-abajo">
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <style>
        .custom1-card-style {
        background-color: #FFF6EB; /* un tono más suave */
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        max-width: 420px;
        margin: auto;
        }

        /* Reducimos espacio interno del modal */
        .modal-body {
        padding: 1.5rem 1rem !important;
        }

        /* Botón de acción */
        .btn-custom-action {
        background-color: #FB9F40;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 22px;
        font-weight: 600;
        transition: all 0.3s ease;
        }
        .btn-custom-action:hover {
        background-color: #e58d35;
        }

        /* Botón cancelar */
        .btn-custom-cancel {
        background-color: #f0f0f0;
        color: #622D16;
        border: 1px solid #d0d0d0;
        border-radius: 20px;
        padding: 8px 22px;
        font-weight: 600;
        transition: all 0.3s ease;
        }
        .btn-custom-cancel:hover {
        background-color: #e0e0e0;
        }
    </style>
</x-app-layout>