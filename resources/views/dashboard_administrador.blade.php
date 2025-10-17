<x-app-layout> 
    
    <x-slot name="header">
        {{-- Slot header vacío para eliminar el texto "Dashboard" no deseado --}}
    </x-slot>
    
    <?php
        $adminLinks = [];
    ?>
    <x-app-navbar :links="$adminLinks" />

    {{-- Contenedor principal de la vista --}}
    <div class="container mt-4">
        
        {{-- Título principal de la página --}}
        <h2 class="mb-4" style="color: #622D16;">Administración de Usuarios</h2> 
        
        {{-- FILA PRINCIPAL DE 3 COLUMNAS --}}
        <div class="row">
            <?php
                // ... (Tu array $simulatedUsers aquí) ...
                // SIMULACIÓN: Datos de acceso para la segunda columna
                $accessLogs = [
                    (object)['username' => 'Usuario002', 'role' => 'Cajero', 'timestamp' => '14/10/2025 22:40'],
                    (object)['username' => 'Usuario001', 'role' => 'Administrador', 'timestamp' => '15/10/2025 22:39'],
                    (object)['username' => 'Usuario002', 'role' => 'Cajero', 'timestamp' => '18/10/2025 22:40'],
                    (object)['username' => 'Usuario005', 'role' => 'Panadero', 'timestamp' => '24/10/2025 22:39'],
                    (object)['username' => 'Usuario004', 'role' => 'Cajero', 'timestamp' => '24/10/2025 22:40'],
                ];
            ?>
            {{-- Columna 1: USUARIOS (col-md-4) --}}
            {{-- En dashboard_administrador.blade.php (Columna 1: USUARIOS) --}}
            <div class="col-md-4 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Usuarios</h5>
                    
                    {{-- INICIO: CONTENEDOR DE LA LISTA DE USUARIOS CON SCROLL --}}
                    <div class="user-list-container flex-grow-1 overflow-auto mb-3">
                        
                        {{-- Inicia el Bucle para mostrar los usuarios usando la variable $usuarios --}}
                        @if(isset($usuarios) && count($usuarios) > 0)
                            @foreach ($usuarios as $usuario)
                            {{-- Tarjeta Individual del Usuario --}}
                            <div class="user-card d-flex justify-content-between align-items-center mb-2 p-3"
                                style="cursor: pointer;" 
                                onclick="window.location='{{ route('administrador.editar.usuario', $usuario->id_usuario) }}'"> 
                                
                                {{-- Información del Usuario --}}
                                <div>
                                    <strong class="user-name">{{ $usuario -> nombre }}</strong> 
                                    <div class="user-role small">Rol: {{ $usuario -> rol -> rol}}</div>
                                </div>
                                
                                {{-- Botones de Acción (Debe detener la propagación del clic) --}}
                                <div class="d-flex action-buttons-group" 
                                    data-user-id="{{ $usuario->id_usuario }}"
                                    onclick="event.stopPropagation();"> {{-- ESTO ES CRUCIAL --}}
                                    
                                    {{-- Aquí va toda la lógica de los botones de estado (Disponible, Inactivo, Despedido) --}}
                                    {{-- ... (Tu código existente para Botón 2, Botón 3 y Botón 4) ... --}}

                                    @php
                                        $currentStatus = $usuario->estadoUsuario->nombre; // Ej: 'Disponible', 'Inactivo', 'Despedido'
                                    @endphp

                                    {{-- Botón 2: Estado Disponible --}}
                                    @php
                                        $isDisponible = ($currentStatus == 'Disponible');
                                        $imgDisponible = $isDisponible ? 'Usuario Disponible AC.png' : 'Usuario Disponible DS.png';
                                    @endphp
                                    <button type="button" 
                                            class="btn-action status-button" 
                                            data-user-id="{{ $usuario->id_usuario }}" 
                                            data-status="Disponible"
                                            data-current-status="{{ $currentStatus }}">
                                        <img src="{{ asset('images/' . $imgDisponible) }}" alt="Disponible" class="action-icon status-icon">
                                    </button>

                                    {{-- Botón 3: Estado Inactivo --}}
                                    @php
                                        $isInactivo = ($currentStatus == 'Inactivo');
                                        $imgInactivo = $isInactivo ? 'Usuario Inactivo AC.png' : 'Usuario Inactivo DS.png';
                                    @endphp
                                    <button type="button" 
                                            class="btn-action status-button" 
                                            data-user-id="{{ $usuario->id_usuario }}" 
                                            data-status="Inactivo"
                                            data-current-status="{{ $currentStatus }}">
                                        <img src="{{ asset('images/' . $imgInactivo) }}" alt="Inactivo" class="action-icon status-icon">
                                    </button>

                                    {{-- Botón 4: Estado Despedido --}}
                                    @php
                                        $isDespedido = ($currentStatus == 'Despedido');
                                        $imgDespedido = $isDespedido ? 'Usuario Despedido AC.png' : 'Usuario Despedido DS.png';
                                    @endphp
                                    <button type="button" 
                                            class="btn-action status-button" 
                                            data-user-id="{{ $usuario->id_usuario }}" 
                                            data-status="Despedido"
                                            data-current-status="{{ $currentStatus }}">
                                        <img src="{{ asset('images/' . $imgDespedido) }}" alt="Despedido" class="action-icon status-icon">
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted mt-5">No hay usuarios registrados.</p>
                        @endif
                        
                    </div>
                    {{-- FIN: CONTENEDOR DE LA LISTA DE USUARIOS --}}
                    
                    {{-- Botón CREAR USUARIO --}}
                    <div class="d-grid gap-2 mt-auto"> 
                        <a href="{{ route('administrador.usuarios.create') }}" class="btn btn-modificar-perfil">
                            Crear Usuario
                        </a>
                    </div>
                </div>
            </div>

            {{-- Columna 2: REGISTRO DE ACCESOS (col-md-5) --}}
            <div class="col-md-5 mb-4 d-flex">
                <div class="card p-4 custom-card-style flex-grow-1 d-flex flex-column">
                    <h5 class="card-title" style="color: #a0522d;">Registro de Accesos</h5>

                    {{-- Contenedor de la lista de accesos con scroll --}}
                    <div class="access-list-container flex-grow-1 overflow-auto">
                        
                        @if(isset($accessLogs) && count($accessLogs) > 0)
                            @foreach ($accessLogs as $log)
                            {{-- Tarjeta Individual del Acceso --}}
                            <div class="access-card mb-2 p-3">
                                <strong class="log-username">{{ $log->username }}</strong>
                                <div class="log-details small">
                                    Acceso: {{ $log->timestamp }} 
                                    <span style="color: #622D16;">Rol: {{ $log->role }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted mt-5">No hay registros de acceso.</p>
                        @endif
                        
                    </div>
                    
                </div>
            </div>

            {{-- Columna 3: MI USUARIO (col-md-3) --}}
            <div class="col-md-3 mb-4">
                <div class="card p-4 custom-card-style d-flex flex-column align-items-center">
                    <h5 class="card-title w-100" style="color: #a0522d;">Mi Usuario</h5>
                    
                    {{-- 1. Icono de Perfil --}}
                    <div class="profile-picture-container mb-4" style="border: 2px solid #a0522d;">
                        <img src="{{ asset('images/Foto PerfilCU.png') }}" alt="Foto de Perfil" class="img-fluid profile-picture-placeholder">
                    </div>

                    {{-- 2. Información del Usuario Autenticado --}}
                    {{-- Usamos $usuario_autenticado o Auth::user() --}}
                    @php
                        // Se asume que el usuario autenticado está cargado en $usuario_autenticado o se usa Auth::user()
                        // Usaremos Auth::user() como la forma más estándar en Laravel
                        $userAuth = Auth::user(); 
                    @endphp

                    @if ($userAuth)
                        <div class="w-100 text-center mb-4">
                            <div class="d-flex justify-content-center align-items-baseline mb-2">
                                <strong style="color: #622D16;">Usuario:</strong>
                                {{-- Usa el campo correcto, probablemente 'nombre' --}}
                                <span class="ms-2">{{ $userAuth->nombre }}</span> 
                            </div>
                            <div class="d-flex justify-content-center align-items-baseline">
                                <strong style="color: #622D16;">Email:</strong>
                                <span class="ms-2">{{ $userAuth->email }}</span>
                            </div>
                            <div class="d-flex justify-content-center align-items-baseline">
                                <strong style="color: #622D16;">Rol:</strong>
                                {{-- Accede a la relación 'rol' para obtener el nombre --}}
                                <span class="ms-2">{{ $userAuth->rol->rol ?? 'N/A' }}</span>
                            </div>
                        </div>
                    @else
                        <p class="text-muted text-center">Datos de usuario no disponibles.</p>
                    @endif

                    {{-- 3. Botón Modificar Perfil --}}
                    <div class="d-grid mt-auto w-100">
                        <a href="{{ route('administrador.editar.usuario', Auth::user()->id_usuario) }}" class="btn btn-modificar-perfil">
                            Modificar Perfil
                        </a>
                    </div>
                </div>
</div>
        </div>
        
        {{-- FILA 2: ESTADOS DE USUARIO (Centrada y Abajo) --}}
        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-md-10">
                <div class="text-center">
                    <h5 class="mb-3" style="color: #622D16;">Estados de Usuario</h5>
                    
                    {{-- Contenedor de los iconos de estado --}}
                    <div class="d-flex justify-content-center state-icons-container">
                        
                        {{-- Estado 1: Despedido --}}
                        <div class="state-item mx-4 text-center">
                            <img src="{{ asset('images/Usuario Despedido DS.png') }}" alt="Despedido" class="state-icon mb-1">
                            <p class="small text-muted">Despedido</p>
                        </div>

                        {{-- Estado 2: Disponible --}}
                        <div class="state-item mx-4 text-center">
                            <img src="{{ asset('images/Usuario Disponible DS.png') }}" alt="Disponible" class="state-icon mb-1">
                            <p class="small text-muted">Disponible</p>
                        </div>

                        {{-- Estado 3: Inactivo --}}
                        <div class="state-item mx-4 text-center">
                            <img src="{{ asset('images/Usuario Inactivo DS.png') }}" alt="Inactivo" class="state-icon mb-1">
                            <p class="small text-muted">Inactivo</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>

</x-app-layout>