📘 Bibliotheca Alexxblaro // System.Catalog
⚡ Sobre el Proyecto
Este repositorio ha sido desarrollado para la asignatura de Back-End I (UDIT). Consiste en un sistema CRUD (Create, Read, Update, Delete) robusto para la gestión de una biblioteca digital. El enfoque principal se ha centrado en la estética Dark Terminal / Minimalista, ofreciendo una experiencia de usuario técnica y elegante.

🚀 Características Principales
Identidad Visual: Branding exclusivo "Bibliotheca Alexxblaro" con logotipo vectorial integrado en la interfaz.

Gestión Inteligente de Datos: Arquitectura basada en Modelos, Migraciones, Seeders y Factories para un control total del esquema de datos.

Búsqueda Dinámica: Sistema de filtrado por categorías en tiempo real mediante consultas a la base de datos.

Portadas Automáticas (API Sync): Integración avanzada mediante JavaScript con las APIs de OpenLibrary y Google Books para mostrar la carátula real de los libros sin necesidad de almacenamiento local.

Infraestructura Dockerizada: Entorno de desarrollo aislado y reproducible mediante Docker Compose (contenedores para PHP-FPM, Nginx y MySQL).

🛠️ Stack Tecnológico
Framework: Laravel 11 (PHP 8.3)

Base de Datos: MySQL 8.0

Estilos: Tailwind CSS (Custom Dark Theme)

Frontend: Blade Templating Engine & Vanilla JS

Contenedores: Docker Desktop

📥 Instalación y Despliegue Local
Para poner en marcha el sistema en tu entorno local, sigue estos pasos desde tu terminal:

Clonar el repositorio:

Bash
git clone https://github.com/alexxblaro16/Bibliotheca.Alexxblaro-System.Catalog.git
cd Bibliotheca.Alexxblaro-System.Catalog
Levantar la infraestructura (Docker):

Bash
docker-compose up -d
Configurar dependencias y entorno:

Bash
docker exec -it mi-app-docker-laravel.test-1 composer install
docker exec -it mi-app-docker-laravel.test-1 cp .env.example .env
docker exec -it mi-app-docker-laravel.test-1 php artisan key:generate
Migraciones y Generación de Datos (Factories):

Bash
docker exec -it mi-app-docker-laravel.test-1 php artisan migrate --seed
Acceso al sistema:
Abre tu navegador en: http://localhost:8080/books

📂 Estructura del Proyecto
app/Models/Book.php: Definición del modelo de datos.

database/factories/BookFactory.php: Lógica de generación de datos falsos mediante Faker.

resources/views/books/: Plantillas Blade con el diseño Dark Terminal.

public/Imagen_Logo.png: Recurso gráfico de identidad visual.

Desarrollado con ❤️ por: alexxblaro16

Grado en Desarrollo de Software - UDIT