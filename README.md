# Aplicativo de Notas

Este proyecto se enfoca en la parte de la gestión administrativa de una institución educativa y cuenta con los modulos: registro de estudiantes, docentes, asignaturas y notas.

## Funcionalidades

-  Gestión de estudiantes
-  Gestión de docentes
-  Gestión de asignaturas
-  Gestión de Notas
-  Reporte básico de algunos datos como: total de usuarios y asignaturas registradas, 
   total de estudiantes aprobados y no aprobados, asignatura con alto y bajo promedio.

## Tecnologías utilizadas

- Laravel 9.5
- Vue 3.5
- Bootstrap 
- MySQL
- Axios, Vue Router.

## Instalación Local

1. Clona el repositorio 
2. Ejecuta `composer install`
3. Copia `.env.example` a `.env` para configurar la base de datos
4. Ejecutar `php artisan migrate`
5. Ejecutar `npm install && npm run dev`
6. Iniciar el servidor `php artisan serve`

## Estructura del proyecto

El proyecto está dividido en dos partes el Backend en Laravel y Front en Vue

### Backend (Laravel)

-	`app/Models/` -> Encuentra los modelos como: Docente, Estudiante, Materia, Nota y User
-	`app/Http/Controllers/Api` -> Encuentra los controladores, responsables de cada lógica y solicitud HTTP
-	`routes/api.php` -> Encuentra las rutas API utilizadas para realizar las peticiones HTTP.
-	`database/migrations/` -> Se definen la estructura de cada entidad o tabla para realizar las migraciones.
-	`resources/views/` ->Encuentra la vista principal de carga de la App principal de Vue.

### Fronend (Vuejs)

- `resources/js/app.js` → Entrada principal del frontend.
- `resources/js/components/` → Componentes Vue como formularios, tablas y cominicación con Axios.
- `resources/js/router/` → Rutas definidas con Vue Router.

### Otros 

- `.env` → Variables de entorno del proyecto, configuración de la DB.
### Disponible en: 

- https://notas.approyectos.site/
