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
        
        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Usuario: {{ $usuario->nombre }}</h2> 
        
        <div class="card p-4 custom-card-style mx-auto" style="max-width: 800px;"> 
            
            {{-- 1. ASIGNAR ID AL FORMULARIO --}}
            <form id="editUserForm" action="{{ route('administrador.usuarios.update', $usuario->id_usuario) }}" method="POST"> 
                @csrf
                @method('PATCH')
                
                <div class="row align-items-start">
                    
                    {{-- COLUMNA IZQUIERDA: CAMPOS DEL FORMULARIO --}}
                    <div class="col-md-7">
                        
                        {{-- Campo de Nombre --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="nombre" class="form-label input-label">Nombre Completo:</label>
                            <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" 
                                name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required />
                            @error('nombre') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Campo de Email --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="email" class="form-label input-label">Email:</label>
                            <input id="email" class="form-control login-input transparent-input-bottom-border" type="email" 
                                name="email" value="{{ old('email', $usuario->email) }}" required />
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- SECCIÓN CONTRASEÑA (SOLO REEMPLAZO) --}}
                        <div class="mb-2 form-group-with-icon">
                            <label for="password" class="form-label input-label">Nueva Contraseña:</label>
                            <div class="input-group">
                                <input id="password" class="form-control login-input transparent-input-bottom-border" type="password" 
                                    name="password" placeholder="Dejar vacío para no cambiar" />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePassword">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            <p class="text-muted small mt-1 ms-4" style="color: #8c8c8c !important;">Solo llene si desea cambiar la contraseña.</p>
                        </div>
                        
                        {{-- Campo de Repetir Nueva Contraseña --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="password_confirmation" class="form-label input-label">Confirmar Contraseña:</label>
                            <div class="input-group">
                                <input id="password_confirmation" class="form-control login-input transparent-input-bottom-border" type="password" 
                                    name="password_confirmation" placeholder="Repita la nueva contraseña" />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePasswordConfirmation">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                        </div>
                        
                        {{-- Campo de Rol (usa $roles) --}}
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="rol_id_rol" class="form-label input-label me-2 mb-0">Rol:</label>
                            <select id="rol_id_rol" name="rol_id_rol" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id_rol }}" 
                                        @if (old('rol_id_rol', $usuario->rol_id_rol) == $rol->id_rol) selected @endif>
                                        {{ $rol-> rol }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rol_id_rol') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
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
                    <div class="col-12 d-flex justify-content-start">
                        <a href="{{ route('administrador.usuarios.index') }}" class="btn btn-modificar-perfil-abajo">
                            Volver
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    {{---}}

    ## Modal de Confirmación

    {{-- 3. AÑADIR EL MODAL DE CONFIRMACIÓN --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom1-card-style">
            <div class="modal-body text-center p-4">
                <img src="{{ asset('images/Alerta Triangulo.png') }}" alt="Advertencia" class="mb-2" style="width: 55px;">
                <h5 class="mb-3 fw-semibold" style="color: #622D16;">
                ¿Está seguro que quiere guardar los cambios de este usuario?
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
            // Lógica de toggle de contraseña (se mantiene igual)
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

            // 4. LÓGICA DEL MODAL DE EDICIÓN
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