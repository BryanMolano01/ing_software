@props(['links' => []])
<nav class="navbar navbar-expand-lg" style="background-color: #f7f1e7; border-bottom: 2px solid #f5a85a; padding: 0.5rem 1rem;">
    <div class="container-fluid">
        
        <a href="{{ route('dashboard') }}" class="btn-menu-link">
            <img src="{{ asset('images/Menu.png') }}" alt="Dashboard Menú" class="nav-icon">
        </a>

        <img src="{{ asset('images/logo PanPaYo.png') }}" alt="Pan@com Pa'Yo Logo" style="
            height: 40px; 
            width: auto;
            position: absolute; 
            left: 50%; 
            transform: translateX(-50%);
        ">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


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