Proyecto Integrador: Modelo y Simulación de Inventarios
🚀 ¡Bienvenido al Proyecto modelo-simulacion!
Este repositorio contiene la implementación del caso integrador de Modelos y Simulación, desarrollado en Laravel 11, PHP 8.2+ y MariaDB/MySQL. El objetivo es simular la evolución de un sistema de inventario a lo largo de un año, permitiendo el análisis de diversas métricas clave como la demanda, ventas, stock, pedidos y costos.

📚 Descripción del Caso
El proyecto simula la gestión de existencias de un almacén. La lógica central se basa en:

Punto de Pedido: Se realiza un nuevo pedido cuando las existencias caen por debajo de 300 unidades.
Cantidad a Pedir: Se solicita la demanda de los últimos 5 días.
Demanda Diaria: Fluctuante, sigue una distribución normal con media de 150 unidades y desviación típica de 25.
Tiempo de Reaprovisionamiento (Lead Time): Aleatorio, con las siguientes probabilidades de demora:
1 día: 40%
2 días: 50%
3 días: 10%
Existencia Inicial: El almacén comienza con 2000 unidades.
Duración de la Simulación: 365 días (un año).
✨ Características Principales
Simulación Diaria: Registro detallado de la existencia inicial, demanda, venta, demanda insatisfecha y existencia final por cada día.
Registro de Eventos: Notificación de cada vez que se realiza un pedido o se recibe una reposición.
Métricas Clave: Recuento total de días con demanda insatisfecha al finalizar la simulación.
Tecnologías Robustas: Desarrollado con Laravel 11 para un backend estructurado y MariaDB/MySQL para la persistencia de datos.
🛠️ Requisitos del Sistema
Asegúrate de tener instalado lo siguiente para correr el proyecto:

PHP: Versión 8.2 o superior.
Composer: Última versión.
Node.js y NPM: Para la compilación de assets frontend (Vite).
MariaDB / MySQL Server: Para la base de datos.
Git: (Recomendado para clonar el repositorio).
Recomendación: Para Windows, Laragon o XAMPP simplifican la configuración de PHP, Composer, Node.js y el servidor de base de datos.

⚙️ Configuración y Ejecución del Proyecto
Sigue estos pasos para poner en marcha el proyecto en tu máquina local:

1. Clonar el Repositorio
Si aún no lo tienes, clona el proyecto desde tu sistema de control de versiones (por ejemplo, Git):

Bash

git clone <URL_DEL_REPOSITORIO> modelo-simulacion
cd modelo-simulacion
2. Instalar Dependencias de PHP
Usa Composer para instalar todas las dependencias de Laravel:

Bash

composer install
3. Configurar el Archivo .env
Copia el archivo de ejemplo .env.example para crear tu archivo de configuración:

Bash

cp .env.example .env
# En Windows, puedes usar: copy .env.example .env
Luego, abre el archivo .env con tu editor de código y configura las credenciales de tu base de datos:

Fragmento de código

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=integrador_ms # ¡Asegúrate de que este sea el nombre correcto de tu DB!
DB_USERNAME=root         # Tu usuario de MariaDB/MySQL
DB_PASSWORD=             # Tu contraseña de MariaDB/MySQL (vacío si no tienes)
4. Generar la Clave de Aplicación
Laravel necesita una clave de aplicación única para la seguridad:

Bash

php artisan key:generate
5. Crear la Base de Datos
Asegúrate de haber creado la base de datos integrador_ms en tu servidor MariaDB/MySQL. Puedes hacerlo desde una herramienta como phpMyAdmin, DBeaver, o la terminal:

SQL

# Si estás en la terminal de MariaDB/MySQL (conectado con mysql -u root -p)
CREATE DATABASE integrador_ms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
6. Ejecutar las Migraciones de Base de Datos
Esto creará las tablas necesarias en tu base de datos:

Bash

php artisan migrate
7. Instalar Dependencias de Frontend
Para compilar los assets de frontend (Vite), instala las dependencias de Node.js:

Bash

npm install
8. Iniciar el Servidor de Desarrollo
Finalmente, inicia el servidor de desarrollo de Laravel:

Bash

php artisan serve
Ahora puedes acceder a la aplicación en tu navegador, usualmente en http://127.0.0.1:8000 o http://localhost:8000.