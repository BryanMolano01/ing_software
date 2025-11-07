<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <?php
        $adminLinks = [
            ['title' => 'Usuarios', 'route' => 'dashboard'],
            ['title' => 'Materia Prima', 'route' => 'administrador.materia_prima.index'],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    <div class="container mt-4">
        {{-- Mensaje de éxito si existe (después de la redirección) --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4 text-center" style="color: #622D16;">Registro de proveedor</h2> 
        
        <div class="card p-4 custom-card-style-create mx-auto" style="max-width: 800px;">
            
            {{-- 1. ACCIÓN DEL FORMULARIO CONFIGURADA --}}
            <form id="createUserForm" action="{{ route('administrador.usuarios.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    {{-- COLUMNA IZQUIERDA: CENTRADA VERTICALMENTE --}}
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        
                        {{-- Campo de Nombre (Coincide con 'nombre' del controlador) --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="nombre" class="form-label input-label">Nombre:</label>
                            <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="" required />
                            @error('nombre')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Aquí irían otros campos del formulario (ej. email, contraseña, etc.) --}}
                        
                    </div>
                    
                    {{-- COLUMNA DERECHA: Imagen de Perfil y Botón --}}
                    <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                        <div class="profile-picture-container mb-4">
                            <img src="{{ asset('images/Foto PerfilCU.png') }}" alt="Foto de Perfil" class="img-fluid profile-picture-placeholder">
                        </div>
                        <button type="button" class="btn btn-login btn-create-user-form" id="openConfirmationModal">
                            Registrar proveedor
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom1-card-style p-4">
                <div class="modal-body text-center">
                    <img src="{{ asset('images/Alerta Triangulo.png') }}" alt="Advertencia" class="mb-3" style="width: 60px;">
                    <h5 class="mb-4" style="color: #622D16;">¿Está seguro que quiere registrar este proveedor?</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-custom-action" id="confirmCreateUser">Registrar proveedor</button>
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

            // 🌟 NUEVO CÓDIGO JAVASCRIPT PARA EL MODAL 🌟
            const openConfirmationModalBtn = document.getElementById('openConfirmationModal');
            const confirmCreateUserBtn = document.getElementById('confirmCreateUser');
            const createUserForm = document.getElementById('createUserForm');

            if (openConfirmationModalBtn && confirmCreateUserBtn && createUserForm) {
                openConfirmationModalBtn.addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    myModal.show();
                });

                confirmCreateUserBtn.addEventListener('click', function() {
                    var myModal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
                    if (myModal) {
                        myModal.hide();
                    }
                    createUserForm.submit();
                });
            }
        });
    </script>

    <style>
        .custom1-card-style {
            background-color: #F8F4F0; /* Color de fondo claro */
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
            border: none;

            padding: 30px 20px !important;
        }

        .btn-custom-action {
            background-color: #FB9F40; /* Naranja para crear usuario */
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-custom-action:hover {
            background-color: #e58d35; /* Naranja más oscuro al pasar el mouse */
            color: white;
        }

        .btn-custom-cancel {
            background-color: #f0f0f0; /* Gris claro para volver */
            color: #622D16;
            border: 1px solid #d0d0d0;
            border-radius: 20px;
            padding: 10px 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-custom-cancel:hover {
            background-color: #e0e0e0; /* Gris más oscuro al pasar el mouse */
            color: #622D16;
        }
    </style>
</x-app-layout>