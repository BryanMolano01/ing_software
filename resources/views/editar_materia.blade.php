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
        
        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Insumo </h2> 
        
        <div class="card p-4 custom-card-style mx-auto" style="max-width: 800px;"> 
            
            <form id="editUserForm" action="{{ route('administrador.items.update', $item->id_item) }}" method="POST"> 
                @csrf
                @method('PATCH')
                
                <div class="row align-items-start">
                    

                    <div class="col-md-7">
                        <div class="mb-4 form-group-with-icon">
                            <label for="cantidad" class="form-label input-label">Cantidad:</label>
                            <input id="cantidad" class="form-control login-input transparent-input-bottom-border" type="text" 
                                name="cantidad" value="{{ old('cantidad', $item->cantidad) }}" required />
                            @error('cantidad') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="unidad_materia_prima_id_unidad_materia_prima" class="form-label input-label me-2 mb-0">Medida:</label>
                            <select id="unidad_materia_prima_id_unidad_materia_prima" name="unidad_materia_prima_id_unidad_materia_prima" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id_unidad_materia_prima }}" 
                                        @if (old('id_unidad_materia_prima', $item->unidad_materia_prima_id_unidad_materia_prima) == $medida->id_unidad_materia_prima) selected @endif>
                                        {{ $medida-> unidad }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unidad_materia_prima_id_unidad_materia_prima') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="proveedor_id_proveedor" class="form-label input-label me-2 mb-0">Proveedor:</label>
                            <select id="proveedor_id_proveedor" name="proveedor_id_proveedor" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id_proveedor }}" 
                                        @if (old('id_proveedor', $item->proveedor_id_proveedor) == $proveedor->id_proveedor) selected @endif>
                                        {{ $proveedor -> nombre}}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_proveedor') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="tipo_item_id_tipo_item" class="form-label input-label me-2 mb-0">Tipo:</label>
                            <select id="tipo_item_id_tipo_item" name="tipo_item_id_tipo_item" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($tipo_items as $tipo)
                                    <option value="{{ $tipo->id_tipo_item }}" 
                                        @if (old('id_tipo_producto', $item->tipo_item_id_tipo_item) == $tipo->id_tipo_item) selected @endif>
                                        {{ $tipo -> tipo}}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_item_id_tipo_item') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="ubicacion_id_ubicacion" class="form-label input-label me-2 mb-0">Ubicación:</label>
                            <select id="ubicacion_id_ubicacion" name="ubicacion_id_ubicacion" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id_ubicacion }}" 
                                        @if (old('id_tipo_producto', $item->ubicacion_id_ubicacion) == $ubicacion->id_ubicacion) selected @endif>
                                        {{ $ubicacion -> ubicacion}}
                                    </option>
                                @endforeach
                            </select>
                            @error('ubicacion_id_ubicacion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                    </div> {{-- Fin Columna Izquierda --}}

                    {{-- COLUMNA DERECHA: FOTO DE PERFIL Y BOTÓN --}}
                    <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                        <div class="profile-picture-container mb-4" style="width: 150px; height: 150px; border: 2px solid #622D16 !important;">
                            <img src="{{ asset('images/Foto PerfilCU.png') }}" alt="Foto de Perfil" class="img-fluid profile-picture-placeholder">
                        </div>
                        
                        {{-- 2. CAMBIAR TIPO DE BOTÓN para que abra el modal --}}
                        <button type="button" class="btn btn-modificar-perfil-create" id="openConfirmationModal">
                            Guardar Cambios
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom1-card-style">
            <div class="modal-body text-center p-4">
                <img src="{{ asset('images/Alerta Triangulo.png') }}" alt="Advertencia" class="mb-2" style="width: 55px;">
                <h5 class="mb-3 fw-semibold" style="color: #622D16;">
                ¿Está seguro que quiere guardar los cambios de este insumo?
                </h5>
                <div class="d-flex justify-content-center gap-3 mt-3 mb-2">
                <button type="button" class="btn btn-custom-action" id="confirmEditUser">Guardar Cambios</button>
                <button type="button" class="btn btn-custom-cancel" data-bs-dismiss="modal">Volver</button>
                </div>
            </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupPasswordToggle(toggleBtnId, passwordInputId) {
                const toggleBtn = document.getElementById(toggleBtnId);
                const passwordInput = document.getElementById(passwordInputId);

                if (toggleBtn && passwordInput) {
                    toggleBtn.addEventListener('click', function(e) {
                        e.preventDefault(); 
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                    });
                }
            }
            setupPasswordToggle('togglePassword', 'password');
            setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation');

            const openConfirmationModalBtn = document.getElementById('openConfirmationModal');
            const confirmEditUserBtn = document.getElementById('confirmEditUser'); // ID del botón dentro del modal
            const editUserForm = document.getElementById('editUserForm'); // ID del formulario principal

            if (openConfirmationModalBtn && confirmEditUserBtn && editUserForm) {
                // Al hacer clic en el botón principal, se abre el modal
                openConfirmationModalBtn.addEventListener('click', function() {
                    // Solo abrir si los campos requeridos están llenos (opcional, el backend validará)
                    var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    myModal.show();
                });

                // Al hacer clic en el botón de confirmación del modal
                confirmEditUserBtn.addEventListener('click', function() {
                    // Oculta el modal (opcional)
                    var myModal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
                    if (myModal) {
                        myModal.hide();
                    }
                    // Envía el formulario principal
                    editUserForm.submit();
                });
            }
        });
    </script>
    
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