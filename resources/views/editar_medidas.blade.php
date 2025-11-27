<x-app-layout>
    <x-slot name="header"></x-slot>

    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'administrador.dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.items.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Unidad de Medida</h2>

        <div class="card p-4 custom-card-style-create mx-auto" style="max-width: 500px;">
            {{-- action="{{ route('administrador.proveedores.update') }}" --}}
            <form id="editUserForm" action="{{ route('administrador.medida.update', $medida->id_unidad_item) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row justify-content-center">
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        <div class="mb-4 form-group-with-icon">
                            <label for="unidad" class="form-label input-label">Unidad: </label>
                            <input id="unidad" class="form-control login-input transparent-input-bottom-border" type="text"
                                name="unidad" value="{{ old('unidad', $medida->unidad) }}" required />
                            @error('unidad')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-auto">
                            <button type="submit" class="btn btn-modificar-perfil">
                                Guardar Cambios
                            </button>
                        </div>
                        <div class="col-12 d-flex justify-content-start">
                            <a href="{{ route('administrador.medida.index') }}" class="btn btn-modificar-perfil-abajo">
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
