# 📘 Bibliotheca Alexxblaro // System.Catalog

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

### ⚡ Descripción del Proyecto
Este sistema es un **CRUD profesional** desarrollado para la asignatura de **Back-End I (UDIT)**. Permite la gestión integral de una biblioteca digital mediante una interfaz **Dark Terminal / Minimalista**. 

El proyecto destaca por su robustez en el manejo de datos, evitando duplicados visuales en el catálogo y ofreciendo una experiencia visual premium con identidad visual propia.



---

### 🚀 Características Principales

* **Identidad Visual:** Branding personalizado "Bibliotheca Alexxblaro" con logotipo dorado integrado.
* **Algoritmo Anti-Duplicados:** Controlador optimizado para mostrar ejemplares únicos basados en el título (`Unique Titles`).
* **Portadas Dinámicas (API Sync):** Consumo de las APIs de **OpenLibrary** y **Google Books** mediante JavaScript para cargar carátulas reales en tiempo real.
* **Filtrado Inteligente:** Sistema de búsqueda por categorías dinámico integrado en el Header.
* **Infraestructura Dockerizada:** Entorno aislado con contenedores para PHP-FPM, Nginx, MySQL y Redis.

---

### 🛠️ Stack Tecnológico

* **Framework:** Laravel 11 (PHP 8.3)
* **Database:** MySQL 8.4
* **Estilos:** Tailwind CSS (Custom Dark Mode)
* **Frontend:** Blade Engine + Vanilla JS
* **Entorno:** Docker Desktop

---

### 📥 Instalación y Despliegue Local

Sigue estos pasos para ejecutar el proyecto en tu máquina:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/alexxblaro16/Bibliotheca.Alexxblaro-System.Catalog.git](https://github.com/alexxblaro16/Bibliotheca.Alexxblaro-System.Catalog.git)
Entrar en la carpeta del proyecto:

Bash
cd mi-app-docker
Levantar contenedores:

Bash
docker-compose up -d
Configurar el sistema y generar datos:

Bash
docker exec -it udit_laravel_app composer install
docker exec -it udit_laravel_app php artisan migrate:fresh --seed
Acceso: Navega a http://localhost/books

📂 Estructura del Código
app/Http/Controllers/BookController.php: Lógica de negocio y limpieza de colecciones.

database/factories/BookFactory.php: Generación de datos masivos con Faker.

resources/views/books/index.blade.php: Listado principal con diseño Cyberpunk.

public/Imagen_Logo.png: Identidad visual del proyecto.

Desarrollado por: alexxblaro16

Grado en Desarrollo de Software - UDIT


---

### 📤 Para subirlo a GitHub ahora:
Ejecuta estos 3 comandos en tu terminal de VS Code:

1. `git add README.md`
2. `git commit -m "README final con instrucciones de despliegue"`
3. `git push`
