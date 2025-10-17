<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <?php
        $adminLinks = [
            ['name' => 'Administrar Usuarios', 'url' => route('administrador.dashboard')],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    <div class="container mt-4">
        <h2 class="mb-4 text-center" style="color: #622D16;">Creación de Usuario</h2> 
        
        <div class="card p-4 custom-card-style mx-auto" style="max-width: 800px;"> {{-- Centramos la tarjeta --}}
            
            <form action="#" method="POST"> {{-- action="#" es temporal, el backend lo definirá --}}
                @csrf
                
                <div class="row">
                    {{-- COLUMNA IZQUIERDA: CAMPOS DEL FORMULARIO --}}
                    <div class="col-md-7">
                        
                        {{-- Campo de Usuario --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="username" class="form-label input-label">Usuario:</label>
                            <input id="username" class="form-control login-input transparent-input-bottom-border" type="text" name="username" placeholder="Cristhian David Fabra Lozano" required />
                        </div>

                        {{-- Campo de Contraseña --}}
                        <div class="mb-2 form-group-with-icon">
                            <label for="password" class="form-label input-label">Contraseña:</label>
                            <div class="input-group">
                                <img src="{{ asset('images/ContraseñaCU.png') }}" alt="Contraseña Icono" class="input-icon me-2">
                                <input id="password" class="form-control login-input transparent-input-bottom-border" type="password" name="password" value="********" required />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePassword">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                        </div>

                        {{-- Campo de Repetir Contraseña --}}
                        <p class="text-muted small mb-2 ms-4" style="color: #8c8c8c !important;">Vuelva a digitar la contraseña</p>
                        <div class="mb-4 form-group-with-icon">
                            <div class="input-group">
                                <img src="{{ asset('images/ContraseñaCU.png') }}" alt="Repetir Contraseña Icono" class="input-icon me-2">
                                <input id="password_confirmation" class="form-control login-input transparent-input-bottom-border" type="password" name="password_confirmation" value="********" required />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePasswordConfirmation">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                        </div>

                        {{-- Campo de Rol --}}
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="role" class="form-label input-label me-2 mb-0">Rol:</label>
                            <select id="role" name="role" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;">
                                <option value="administrador">Administrador</option>
                                <option value="panadero">Panadero</option>
                                <option value="cajero">Cajero</option>
                            </select>
                        </div>

                    </div> {{-- Fin Columna Izquierda --}}

                    {{-- COLUMNA DERECHA: FOTO DE PERFIL Y BOTÓN --}}
                    <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                        <div class="profile-picture-container mb-4">
                            <img src="{{ asset('images/Foto PerfilCU.png') }}" alt="Foto de Perfil" class="img-fluid profile-picture-placeholder">
                        </div>
                        <button type="submit" class="btn btn-login btn-create-user-form">
                            Crear Usuario
                        </button>
                    </div> 
                </div>
            </form>
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
        });
    </script>
</x-app-layout>