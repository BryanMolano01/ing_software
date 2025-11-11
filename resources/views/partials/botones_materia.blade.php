<div class="col-md-10">
    <div class="text-center">
        <h5 class="mb-3" style="color: #622D16;">Administrar</h5>
        
        <div class="d-flex justify-content-center state-icons-container">
            <div class="state-item mx-4 text-center">
                <a href="{{ route('administrador.tipoItem.index') }}" class="btn btn-manejar">
                    Tipos
                </a>
            </div>
            <div class="state-item mx-4 text-center">
                <a href="{{ route('administrador.ubicacion.index') }}" class="btn btn-manejar">
                    Ubicaciones
                </a>
            </div>
            <div class="state-item mx-5 text-center">
                <a href="{{ route('administrador.medida.index') }}" class="btn btn-manejar">
                    Medidas
                </a>
            </div>
            <div class="state-item mx-2 text-center">
                <a href="{{ route('administrador.recetas.admin') }}" class="btn btn-manejar">
                    Recetas
                </a>
            </div>
        </div>
    </div>