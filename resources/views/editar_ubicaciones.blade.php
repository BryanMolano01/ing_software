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

        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Ubicacion</h2> 
        
        <div class="card p-4 custom-card-style-create mx-auto" style="max-width: 800px;">
            {{-- action="{{ route('administrador.proveedores.update') }}" --}}
            <form id="editProvForm"  method="POST">
                @csrf
                @method('PATCH')
                <div class="row justify-content-center">
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        <div class="mb-4 form-group-with-icon">
                            <label for="nombre" class="form-label input-label">Ubicacion:</label>
                            <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="" required />
                            @error('nombre')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-auto"> 
                            <button type="button" class="btn btn-modificar-perfil" id="openConfirmationModal">
                                Editar
                            </button>
                        </div>
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
                ¿Está seguro que quiere guardar los cambios de esta ubicacion?
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