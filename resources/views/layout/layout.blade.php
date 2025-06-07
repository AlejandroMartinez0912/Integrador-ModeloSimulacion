<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
</head>
<body>
<style>
    body {    
        background-color: hsla(117.00000000000004, 40%, 15%, 1);
        background-image: radial-gradient(circle at 3% 92%, hsla(161, 100%, 50%, 1) 0%, transparent 67%), radial-gradient(circle at 46% 94%, hsla(227.6470588235294, 100%, 50%, 1) 0%, transparent 81%), radial-gradient(circle at 93% 95%, hsla(230.2941176470588, 100%, 23%, 1) 0%, transparent 66%), radial-gradient(circle at 89% 8%, hsla(243.52941176470586, 100%, 9%, 1) 0%, transparent 150%);
        background-blend-mode: normal, normal, normal, normal;
        
        color: beige;
    }

    .error-message { color: #dc3545; font-size: 0.875em; }

    .success-message { color: #28a745; font-size: 0.875em; }

    .custom-error { color: #dc3545; }

    .custom-footer {
        background-color: transparent;
        color: beige;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Agregar estilos para hacer que el contenido se adapte */
    #conten {
        min-height: 100vh; /* Ocupa todo el alto de la pantalla */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
        .container {
        padding: 20px;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.2); /* Fondo blanco semi-transparente */
        backdrop-filter: blur(8px); /* Aplica el desenfoque detrás del elemento */
        -webkit-backdrop-filter: blur(8px); /* Prefijo para compatibilidad con navegadores WebKit (ej. Safari) */
    }

   
</style>

<body>
    <div id="conten" class="container-fluid d-flex flex-column">
        <div class="container">
            @yield('content')
        </div>
        
        
        <footer class="text-center py-3 mt-auto custom-footer">
            <p class="mb-0">&copy; 2025 Integrador Modelo y Simulación | Grupo 3 | Lic. en Sistemas</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>