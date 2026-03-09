# 📘 Bibliotheca Alexxblaro // System.Catalog

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

### ⚡ Sobre el Proyecto
Este repositorio ha sido desarrollado para la asignatura de **Back-End I (UDIT)**. Consiste en un sistema **CRUD** (Create, Read, Update, Delete) completo para la gestión de una biblioteca digital. El proyecto destaca por una interfaz de usuario **Dark Terminal / Minimalista**, integrando herramientas modernas de automatización de datos y consumo de APIs externas.

### 🚀 Características Principales
* **Identidad Visual:** Branding personalizado "Bibliotheca Alexxblaro" con logotipo integrado en la cabecera.
* **Portadas en Tiempo Real:** Integración mediante JavaScript con las APIs de **OpenLibrary** y **Google Books** para mostrar la carátula real de los libros dinámicamente.
* **Arquitectura Profesional:** Uso de **Modelos, Factories y Seeders** para la gestión y generación masiva de registros de prueba.
* **Búsqueda y Filtros:** Sistema de filtrado por categorías directamente sobre la base de datos MySQL.
* **Infraestructura Dockerizada:** Entorno completo basado en contenedores para asegurar la portabilidad del sistema.

### 🛠️ Stack Tecnológico
* **Framework:** Laravel 11.
* **Base de Datos:** MySQL 8.4.
* **Frontend:** Tailwind CSS (Custom Dark Mode).
* **Servidor Web:** Nginx 1.27.
* **Contenedores:** Docker Desktop.

### 📥 Instalación y Despliegue Local

Para levantar el proyecto en tu máquina, sigue estos pasos:

1.  **Levantar los contenedores:**
    ```bash
    docker-compose up -d
    ```
2.  **Instalar dependencias de PHP:**
    ```bash
    docker exec -it udit_laravel_app composer install
    ```
3.  **Configurar base de datos y generar datos (Seeders):**
    ```bash
    docker exec -it udit_laravel_app php artisan migrate --seed
    ```
4.  **Acceso al sistema:**
    Abre en tu navegador: **[http://localhost/books](http://localhost/books)**.
    *(Nota: Según el mapeo de puertos de Nginx en el archivo compose, el acceso directo es por el puerto estándar 80).*

---
**Desarrollado por:** [alexxblaro16](https://github.com/alexxblaro16)  
*Grado en Desarrollo de Software - UDIT*