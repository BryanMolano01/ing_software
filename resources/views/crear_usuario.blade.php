<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <?php
        $adminLinks = [
            ['name' => 'Administrar Usuarios', 'url' => route('administrador.dashboard')],
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

        <h2 class="mb-4 text-center" style="color: #622D16;">Creación de Usuario</h2> 
        
        <div class="card p-4 custom-card-style mx-auto" style="max-width: 800px;">
            
            {{-- 1. ACCIÓN DEL FORMULARIO CONFIGURADA --}}
            <form action="{{ route('administrador.usuarios.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    {{-- COLUMNA IZQUIERDA: CAMPOS DEL FORMULARIO --}}
                    <div class="col-md-7">
                        
                        {{-- Campo de Nombre (Coincide con 'nombre' del controlador) --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="nombre" class="form-label input-label">Nombre Completo:</label>
                            {{-- NAME CAMBIADO a 'nombre' --}}
                            <input id="nombre" class="form-control login-input transparent-input-bottom-border" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Cristhian David Fabra Lozano" required />
                            @error('nombre')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Email (Reemplaza 'username' y coincide con 'email' del controlador) --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="email" class="form-label input-label">Email / Usuario:</label>
                            {{-- NAME CAMBIADO a 'email' --}}
                            <input id="email" class="form-control login-input transparent-input-bottom-border" type="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required />
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Contraseña (Coincide con 'password' del controlador) --}}
                        <div class="mb-2 form-group-with-icon">
                            <label for="password" class="form-label input-label">Contraseña:</label>
                            <div class="input-group">
                                <img src="{{ asset('images/ContraseñaCU.png') }}" alt="Contraseña Icono" class="input-icon me-2">
                                <input id="password" class="form-control login-input transparent-input-bottom-border" type="password" name="password" required />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePassword">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Repetir Contraseña (Coincide con 'password_confirmation' del controlador) --}}
                        <p class="text-muted small mb-2 ms-4" style="color: #8c8c8c !important;">Vuelva a digitar la contraseña</p>
                        <div class="mb-4 form-group-with-icon">
                            <div class="input-group">
                                <img src="{{ asset('images/ContraseñaCU.png') }}" alt="Repetir Contraseña Icono" class="input-icon me-2">
                                {{-- NAME YA ESTABA CORRECTO --}}
                                <input id="password_confirmation" class="form-control login-input transparent-input-bottom-border" type="password" name="password_confirmation" required />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePasswordConfirmation">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                        </div>

                        {{-- En crear_usuario.blade.php, dentro de la columna izquierda --}}
                        {{-- Campo de Rol (Coincide con 'rol_id_rol' del controlador) --}}
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="rol_id_rol" class="form-label input-label me-2 mb-0">Rol:</label>
                            {{-- Asegúrate que el atributo 'name' sea 'rol_id_rol' --}}
                            <select id="rol_id_rol" name="rol_id_rol" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;" required>
                                
                                <option value="" disabled selected>Seleccione un Rol</option> {{-- Placeholder --}}
                                
                                {{-- Bucle para cargar los roles reales --}}
                                @isset($roles)
                                    @foreach ($roles as $rol)
                                        {{-- El 'value' debe ser el ID del rol (id_rol) --}}
                                        <option value="{{ $rol->id_rol }}" {{ old('rol_id_rol') == $rol->id_rol ? 'selected' : '' }}>
                                            {{ $rol->rol }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('rol_id_rol')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
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

    {{-- Script de toggle de contraseña (Se mantiene igual) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupPasswordToggle(toggleBtnId, passwordInputId) {
                // ... (código JavaScript aquí) ...
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