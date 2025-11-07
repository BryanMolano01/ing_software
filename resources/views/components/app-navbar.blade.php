@props(['links' => []])
<nav class="navbar navbar-expand-lg" style="background-color: white; border-bottom: 2px solid #f5a85a; padding: 0.5rem 1rem;">
    <div class="container-fluid">
        
        {{-- 1. Botón de Menú que regresa al Dashboard --}}
        {{-- Quitamos el data-bs-toggle y lo volvemos un enlace directo --}}
        <a href="{{ route('dashboard') }}" class="btn-menu-link p-0 border-0 bg-transparent">
            <img src="{{ asset('images/Menu.png') }}" alt="Dashboard" class="nav-icon">
        </a>

        {{-- 2. Contenedor de Enlaces: A la izquierda del logo --}}
        {{-- Usamos el prop 'links' para generar los enlaces de administración --}}
        <div class="d-flex align-items-center me-auto ms-3"> 
            @foreach ($links as $link)
                <a class="nav-link px-3" href="{{ route($link['route']) }}" 
                   style="color: #622D16; font-weight: 500;">
                    {{ $link['title'] }}
                </a>
            @endforeach
        </div>

        {{-- 3. Logo Central --}}
        <img src="{{ asset('images/logo PanPaYo.png') }}" alt="Pan@com Pa'Yo Logo" style="
            height: 40px; 
            width: auto;
            position: absolute; 
            left: 50%; 
            transform: translateX(-50%);
        ">

        {{-- Botón para colapsar en móviles (necesario si usas justify-content-end) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        {{-- 4. Botón de Cerrar Sesión (Derecha) --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item logout-btn-container">
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn-logout-img">
                            <img src="{{ asset('images/Cerrar Sesión.png') }}" alt="Cerrar Sesión" class="nav-icon">
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>