<x-guest-layout>
    
    <div class="login-card"> 
        
        <form method="POST" action="{{ route('login') }}" class="w-100">
            @csrf

            <div class="mb-4 d-flex align-items-center login-input-group">
                
                {{-- Imagen del Logo de Usuario --}}
                <img src="{{ asset('images/Usuario Logo.png') }}" alt="Usuario Icono" class="input-icon">
                
                <div class="w-100">
                    <label for="email" class="form-label input-label">Usuario</label>
                    <input id="email" class="form-control login-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
            </div>

            <div class="mb-4 d-flex align-items-center login-input-group">
                
                {{-- Imagen del Logo de Contraseña --}}
                <img src="{{ asset('images/Constraseña Logo.png') }}" alt="Contraseña Icono" class="input-icon">
                
                <div class="w-100">
                    <label for="password" class="form-label input-label">Contraseña</label>
                    
                    {{-- Contenedor del Input y el Ojo --}}
                    <div class="input-group">
                        <input id="password" class="form-control login-input" type="password" name="password" required autocomplete="current-password" />
                        
                        {{-- Botón/Icono del Ojo --}}
                        <button class="btn btn-sm btn-eye" type="button" id="togglePassword">
                            <img src="{{ asset('images/Ver Constraseña.png') }}" alt="Ver Contraseña" class="eye-icon">
                        </button>
                    </div>
                </div>
            </div>
            
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            
            <div class="d-grid mt-5">
                <button type="submit" class="btn btn-login">
                    Iniciar Sesión
                </button>
            </div>
            
        </form>
    </div>
</x-guest-layout>