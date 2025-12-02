<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'administrador.dashboard'],
            ['title' => 'Insumos', 'route' => 'administrador.items.index'],
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

        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de proveedor</h2> 
        
        <div class="card p-4 custom-card-style-create mx-auto" style="max-width: 800px;">
            <form id="editUserForm" action="{{ route('administrador.proveedores.update', $proveedore->id_proveedor) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        <div class="mb-4 form-group-with-icon">
                            <label for="nombre" class="form-label input-label">Nombre:</label>
                            <input id="nombre" class="form-control login-input transparent-input-bottom-border" name="nombre" value="{{ old('nombre', $proveedore->nombre) }}" placeholder="" required />
                            @error('nombre')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon">
                            <label for="telefono" class="form-label input-label">Telefono:</label>
                            <input id="telefono" class="form-control login-input transparent-input-bottom-border" name="telefono" value="{{ old('telefono', $proveedore->telefono) }}" placeholder="" required />
                            @error('telefono')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                        <div class="profile-picture-container mb-4">
                            <img src="{{ asset('images/Foto PerfilCU.png') }}" alt="Foto de Perfil" class="img-fluid profile-picture-placeholder">
                        </div>
                        <button type="submit" class="btn btn-modificar-perfil">
                            Guardar Cambios
                        </button>
                    </div> 
                    <div class="col-12 d-flex justify-content-start">
                        <a href="{{ route('administrador.items.index') }}" class="btn btn-modificar-perfil-abajo">
                            Volver
                        </a>
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