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
            
            {{-- Columna 1: USUARIOS (col-md-4) --}}
            <div class="col-md-4 mb-4">
                <div class="card p-4 custom-card-style">
                    <h5 class="card-title" style="color: #a0522d;">Usuarios</h5>
                    
                    {{-- Contenido de Usuarios irá aquí --}}
                    <p class="text-muted">Lista de usuarios...</p>
                    
                    {{-- PASO CRUCIAL: Botón CREAR USUARIO --}}
                    {{-- Se usará d-grid para que ocupe el ancho completo --}}
                    <div class="d-grid gap-2 mt-auto"> 
                        <a href="{{ route('crear.usuario') }}" class="btn btn-create-user">
                            Crear Usuario
                        </a>
                    </div>
                </div>
            </div>

            {{-- Columna 2: REGISTRO DE ACCESOS (col-md-5) --}}
            <div class="col-md-5 mb-4">
                <div class="card p-4 custom-card-style">
                    <h5 class="card-title" style="color: #a0522d;">Registro de Accesos</h5>
                    {{-- Contenido de Registro de Accesos irá aquí --}}
                    <p class="text-muted">Historial de accesos...</p>
                </div>
            </div>

            {{-- Columna 3: MI USUARIO (col-md-3) --}}
            <div class="col-md-3 mb-4">
                <div class="card p-4 custom-card-style">
                    <h5 class="card-title" style="color: #a0522d;">Mi Usuario</h5>
                    {{-- Contenido de Mi Usuario irá aquí --}}
                    <p class="text-muted">Perfil de administrador...</p>
                </div>
            </div>
        </div>
        
        {{-- FILA 2: ESTADOS DE USUARIO (Centrada y Abajo) --}}
        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-md-10">
                <div class="text-center">
                    <h5 class="mb-3" style="color: #622D16;">Estados de Usuario</h5>
                    {{-- Contenido de Estados de Usuario irá aquí --}}
                    <p class="text-muted">Íconos de estado...</p>
                </div>
            </div>
        </div>
        
    </div>

</x-app-layout>