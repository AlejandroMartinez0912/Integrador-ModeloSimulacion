<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" xintegrity="sha512-Fo3rlroqQ7G5TzU/61N+Vw4+31Fw+8z0B+P00YgM+C/A2n+Cj2n+R7S+Yk8q9u/h5X/X8z9Z2n+7z+G/2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> --}}
</head>

<body>
    <style>
        /* Estilos personalizados para navbar*/
        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
            /* Fondo oscuro con opacidad */
        }

        .navbar-brand,
        .nav-link {
            color: beige !important;
            /* Color de texto beige */
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #f8f9fa !important;
            /* Color de texto claro al pasar el mouse */
        }

        /*Agregar margen al nav*/
        .navbar-nav {
            margin-left: auto;
            /* Alinear los elementos a la derecha */
        }


        /*Estilos para el body*/
        body {
            background-color: hsla(117.00000000000004, 40%, 15%, 1);
            background-image: radial-gradient(circle at 3% 92%, hsla(161, 100%, 50%, 1) 0%, transparent 67%), radial-gradient(circle at 46% 94%, hsla(227.6470588235294, 100%, 50%, 1) 0%, transparent 81%), radial-gradient(circle at 93% 95%, hsla(230.2941176470588, 100%, 23%, 1) 0%, transparent 66%), radial-gradient(circle at 89% 8%, hsla(243.52941176470586, 100%, 9%, 1) 0%, transparent 150%);
            background-blend-mode: normal, normal, normal, normal;

            color: beige;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875em;
        }

        /*Agregar margenes al body de m-4*/

        .success-message {
            color: #28a745;
            font-size: 0.875em;
        }

        .custom-error {
            color: #dc3545;
        }

        .custom-footer {
            background-color: transparent;
            color: rgb(168, 168, 119);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Agregar estilos para hacer que el contenido se adapte */
        #conten {
            min-height: 100vh;
            /* Ocupa todo el alto de la pantalla */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container {
            padding: 20px;
            border-radius: 5px;
            background-color: rgba(65, 62, 62, 0.2);
            /* Fondo blanco semi-transparente */
            backdrop-filter: blur(8px);
            /* Aplica el desenfoque detrás del elemento */
            -webkit-backdrop-filter: blur(8px);
            /* Prefijo para compatibilidad con navegadores WebKit (ej. Safari) */
        }

        /*Estilos para las tablas*/
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: rgba(161, 154, 154, 0.3);
            backdrop-filter: blur(4px);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
        }

        .modern-table thead {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modern-table th {
            color: #ffffff;
            padding: 1rem;
            text-align: center;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .modern-table td {
            color: #e0e0e0;
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background-color 0.2s ease;
        }

        .modern-table tbody tr:last-child td {
            border-bottom: none;
        }

        .modern-table tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            border: none;
            border-radius: 0.5rem;
            margin: 0 0.25rem; /* Ajuste para un espaciado más consistente */
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            flex-wrap: wrap; /* Permite que los botones se envuelvan en pantallas pequeñas */
        }

        .action-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .action-btn i {
            margin-right: 0.5rem;
        }

        /* Estilo para botones deshabilitados visualmente */
        .action-btn.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            pointer-events: none; /* Asegura que no sea clickable */
        }
    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Integrador Modelo y Simulación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/simulacion">Simulación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('semillas.index') }}">Números Aleatorios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Espacio que divide el nav del body-->
    <div style="height: 60px;"></div>

    <!-- Contenido principal -->
    {{-- Eliminamos el <body> duplicado aquí --}}
    <div id="conten" class="container-fluid d-flex flex-column">
        <div class="container"> {{-- Este container envuelve todo el contenido del yield --}}
            @yield('content')
        </div>

        <footer class="text-center py-3 mt-auto custom-footer">
            <p class="mb-0">&copy; 2025 Integrador Modelo y Simulación | Grupo 3 | Lic. en Sistemas</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para mostrar SweetAlerts basado en sesiones flash de Laravel -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revisa si existe un mensaje de éxito en la sesión
            @if(Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 3000 // El mensaje desaparecerá después de 3 segundos
                });
            @endif

            // Revisa si existe un mensaje de error en la sesión
            @if(Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ Session::get('error') }}',
                    showConfirmButton: false,
                    timer: 3000 // El mensaje desaparecerá después de 3 segundos
                });
            @endif

            // Revisa si existe un mensaje de advertencia (warning) en la sesión
            @if(Session::has('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: '¡Advertencia!',
                    text: '{{ Session::get('warning') }}',
                    showConfirmButton: false,
                    timer: 3000 // El mensaje desaparecerá después de 3 segundos
                });
            @endif

            // Revisa si existe un mensaje de información (info) en la sesión
            @if(Session::has('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Información',
                    text: '{{ Session::get('info') }}',
                    showConfirmButton: false,
                    timer: 3000 // El mensaje desaparecerá después de 3 segundos
                    });
                @endif
            });
        </script>
    </body>

</html>