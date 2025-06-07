<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Integrador: Modelo y Simulación de Inventarios</title>
</head>
<body>
    <h1>Proyecto Integrador: Modelo y Simulación de Inventarios</h1>
    <h2><span class="section-icon">🚀</span> ¡Bienvenido al Proyecto <code>modelo-simulacion</code>!</h2>
    <p>
        Este repositorio contiene la implementación del caso integrador de <strong>Modelos y Simulación</strong>, desarrollado en <strong>Laravel 11</strong>, <strong>PHP 8.2+</strong> y <strong>MariaDB/MySQL</strong>. El objetivo es simular la evolución de un sistema de inventario a lo largo de un año, permitiendo el análisis de diversas métricas clave como la demanda, ventas, stock, pedidos y costos.
    </p>
    <h2><span class="section-icon">📚</span> Descripción del Caso</h2>
    <p>El proyecto simula la gestión de existencias de un almacén. La lógica central se basa en:</p>
    <ul>
        <li><strong>Punto de Pedido:</strong> Se realiza un nuevo pedido cuando las existencias caen por debajo de <strong>300 unidades</strong>.</li>
        <li><strong>Cantidad a Pedir:</strong> Se solicita la <strong>demanda de los últimos 5 días</strong>.</li>
        <li><strong>Demanda Diaria:</strong> Fluctuante, sigue una distribución normal con media de <strong>150 unidades</strong> y desviación típica de <strong>25</strong>.</li>
        <li><strong>Tiempo de Reaprovisionamiento (Lead Time):</strong> Aleatorio, con las siguientes probabilidades de demora:
            <ul>
                <li>1 día: 40%</li>
                <li>2 días: 50%</li>
                <li>3 días: 10%</li>
            </ul>
        </li>
        <li><strong>Existencia Inicial:</strong> El almacén comienza con <strong>2000 unidades</strong>.</li>
        <li><strong>Duración de la Simulación:</strong> <strong>365 días (un año)</strong>.</li>
    </ul>
    <h2><span class="section-icon">✨</span> Características Principales</h2>
    <ul>
        <li><strong>Simulación Diaria:</strong> Registro detallado de la existencia inicial, demanda, venta, demanda insatisfecha y existencia final por cada día.</li>
        <li><strong>Registro de Eventos:</strong> Notificación de cada vez que se realiza un pedido o se recibe una reposición.</li>
        <li><strong>Métricas Clave:</strong> Recuento total de días con demanda insatisfecha al finalizar la simulación.</li>
        <li><strong>Tecnologías Robustas:</strong> Desarrollado con Laravel 11 para un backend estructurado y MariaDB/MySQL para la persistencia de datos.</li>
    </ul>
    <h2><span class="section-icon">🛠️</span> Requisitos del Sistema</h2>
    <p>Asegúrate de tener instalado lo siguiente para correr el proyecto:</p>
    <ul>
        <li><strong>PHP:</strong> Versión <code>8.2</code> o superior.</li>
        <li><strong>Composer:</strong> Última versión.</li>
        <li><strong>Node.js y NPM:</strong> Para la compilación de assets frontend (Vite).</li>
        <li><strong>MariaDB / MySQL Server:</strong> Para la base de datos.</li>
        <li><strong>Git:</strong> (Recomendado para clonar el repositorio).</li>
    </ul>
    <div class="highlight note">
        <strong>Recomendación:</strong> Para Windows, <strong>Laragon</strong> o <strong>XAMPP</strong> simplifican la configuración de PHP, Composer, Node.js y el servidor de base de datos.
    </div>
    <h2><span class="section-icon">⚙️</span> Configuración y Ejecución del Proyecto</h2>
    <p>Sigue estos pasos para poner en marcha el proyecto en tu máquina local:</p>
    <h3>1. Clonar el Repositorio</h3>
    <p>Si aún no lo tienes, clona el proyecto desde tu sistema de control de versiones (por ejemplo, Git):</p>
    <pre><code>git clone &lt;URL_DEL_REPOSITORIO&gt; modelo-simulacion
cd modelo-simulacion</code></pre>
    <h3>2. Instalar Dependencias de PHP</h3>
    <p>Usa Composer para instalar todas las dependencias de Laravel:</p>
    <pre><code>composer install</code></pre>
    <h3>3. Configurar el Archivo <code>.env</code></h3>
    <p>Copia el archivo de ejemplo <code>.env.example</code> para crear tu archivo de configuración:</p>
    <pre><code>cp .env.example .env
    <h3>4. Generar la Clave de Aplicación</h3>
    <p>Laravel necesita una clave de aplicación única para la seguridad:</p>
    <pre><code>php artisan key:generate</code></pre>
    <h3>5. Crear la Base de Datos</h3>
    <p>Asegúrate de haber creado la base de datos <code>integrador_ms</code> en tu servidor MariaDB/MySQL. Puedes hacerlo desde una herramienta como phpMyAdmin, DBeaver, o la terminal:</p>
    <pre><code># Si estás en la terminal de MariaDB/MySQL (conectado con mysql -u root -p)
CREATE DATABASE integrador_ms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</code></pre>
    <h3>6. Ejecutar las Migraciones de Base de Datos</h3>
    <p>Esto creará las tablas necesarias en tu base de datos:</p>
    <pre><code>php artisan migrate</code></pre>
    <h3>7. Instalar Dependencias de Frontend</h3>
    <p>Para compilar los assets de frontend (Vite), instala las dependencias de Node.js:</p>
    <pre><code>npm install</code></pre>
    <h3>8. Iniciar el Servidor de Desarrollo</h3>
    <p>Finalmente, inicia el servidor de desarrollo de Laravel:</p>
    <pre><code>php artisan serve</code></pre>
    <p>Ahora puedes acceder a la aplicación en tu navegador, usualmente en <a href="http://127.0.0.1:8000"><code>http://127.0.0.1:8000</code></a> o <a href="http://localhost:8000"><code>http://localhost:8000</code></a>.</p>

</body>
</html>
