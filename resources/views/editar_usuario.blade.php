<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <?php
        $adminLinks = [
            ['name' => 'Administrar Usuarios', 'url' => route('administrador.dashboard')],
        ];
    ?>
    <x-app-navbar :links="$adminLinks" />

    <div class="container mt-4">
        {{-- Mensaje de éxito si existe (se asume que se redirige a esta vista después de un error, o al dashboard después del éxito) --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        
        {{-- Asegúrate que $usuario esté disponible --}}
        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Usuario: {{ $usuario->nombre }}</h2> 
        
        <div class="card p-4 custom-card-style mx-auto" style="max-width: 800px;"> 
            
            {{-- FORMULARIO: Apunta a la ruta 'update' con el ID del usuario --}}
            <form action="{{ route('administrador.usuarios.update', $usuario->id_usuario) }}" method="POST"> 
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
                                {{-- Quitamos el icono para evitar problemas visuales si no lo necesitas --}}
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
                                        {{-- Selecciona el rol actual del usuario --}}
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
                        
                        <button type="submit" class="btn btn-login btn-create-user-form">
                            Guardar Cambios
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
    
    {{-- Script JavaScript (Asegúrate de que este script esté después de los elementos del formulario) --}}
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