<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <body class="font-sans antialiased">
        
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
            
            {{-- Título personalizado: Pan@com Pa'Yo --}}
            <div class="mt-4 mb-4">
                <img src="{{ asset('images/Logo PanPaYo.png') }}" alt="Pan@com Pa'Yo Logo" style="max-width: 300px; height: auto;">
            </div>

            {{ $slot }}

        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.getElementById('togglePassword');
                const password = document.getElementById('password');

                if (togglePassword && password) {
                    togglePassword.addEventListener('click', function(e) {
                        // Previene que se envíe el formulario si está dentro de uno
                        e.preventDefault(); 
                        
                        // Cambia el tipo de input entre 'password' y 'text'
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);
                        
                        // Opcional: Podrías cambiar la imagen del ojo (abierto/cerrado) aquí si tuvieras dos archivos
                        // Ejemplo: this.querySelector('img').src = type === 'text' ? 'cerrado.png' : 'abierto.png';
                    });
                }
            });
        </script>
    </body>
</html>