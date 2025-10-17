<x-app-layout> 
    <x-slot name="header"></x-slot>
    
    <x-app-navbar :links="[]" /> {{-- La navbar solo necesita los links básicos --}}

    <div class="container mt-4">
        <h2 class="mb-4 text-center" style="color: #622D16;">Edición de Usuario</h2> 
        
        <div class="card p-4 custom-card-style mx-auto" style="max-width: 800px; min-height: 400px;"> 
            
            <form action="#" method="POST"> 
                @csrf
                
                <div class="row align-items-start">
                    
                    {{-- COLUMNA IZQUIERDA: CAMPOS DEL FORMULARIO --}}
                    <div class="col-md-7">
                        
                        {{-- Campo de Usuario --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="username" class="form-label input-label">Usuario:</label>
                            <input id="username" class="form-control login-input transparent-input-bottom-border" type="text" name="username" value="Cristhian David Fabra Lozano" required />
                        </div>

                        {{-- Campo de Contraseña --}}
                        <div class="mb-4 form-group-with-icon">
                            <label for="password" class="form-label input-label">Contraseña:</label>
                            <div class="input-group">
                                {{-- Quitamos el icono de candado, solo dejamos el input y el ojo --}}
                                <input id="password" class="form-control login-input transparent-input-bottom-border" type="password" name="password" value="********" required />
                                <button class="btn btn-sm btn-eye" type="button" id="togglePassword">
                                    <img src="{{ asset('images/OjoCU.png') }}" alt="Ver Contraseña" class="eye-icon">
                                </button>
                            </div>
                        </div>

                        {{-- Campo de Rol --}}
                        <div class="mb-4 form-group-with-icon d-flex align-items-center">
                            <label for="role" class="form-label input-label me-2 mb-0">Rol:</label>
                            <select id="role" name="role" class="form-select login-input transparent-input-bottom-border" style="flex-grow: 1;">
                                <option value="administrador" selected>Administrador</option>
                                <option value="panadero">Panadero</option>
                                <option value="cajero">Cajero</option>
                            </select>
                        </div>

                    </div> {{-- Fin Columna Izquierda --}}

                    {{-- COLUMNA DERECHA: FOTO DE PERFIL Y BOTÓN --}}
                    <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                        <div class="profile-picture-container mb-4" style="width: 150px; height: 150px; border: 2px solid #622D16 !important;">
                            <img src="{{ asset('images/Foto PerfilCU.png') }}" alt="Foto de Perfil" class="img-fluid profile-picture-placeholder">
                        </div>
                        
                        {{-- Botón Guardar Cambios --}}
                        <button type="submit" class="btn btn-save-changes">
                            Guardar Cambios
                        </button>
                    </div> {{-- Fin Columna Derecha --}}
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript para la funcionalidad del ojo (reutilizando el mismo código) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault(); 
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                });
            }
        });
    </script>
</x-app-layout>