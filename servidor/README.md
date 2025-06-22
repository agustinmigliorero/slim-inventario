# Servidor (Slim PHP)

En esta carpeta se implementa la API REST del sistema utilizando [Slim Framework 4](https://www.slimframework.com/). La API expone recursos para manejar clientes, productos, categorías, ventas y los productos asociados a cada venta.

## Requisitos

- PHP 8 o superior
- [Composer](https://getcomposer.org/)
- Servidor MySQL accesible

## Instalación y ejecución

```bash
cd servidor
composer install      # Instala las dependencias PHP

# Configurar la conexión en Database/DB.php si es necesario

php -S localhost:8080 -t public
```

El último comando levanta el servidor embebido de PHP sirviendo el `public/index.php`, donde se registran todas las rutas.

## Estructura de carpetas

- `public/` – Punto de entrada de la aplicación (`index.php`).
- `controllers/` – Funciones que gestionan las peticiones.
- `models/` – Acceso a base de datos mediante PDO.
- `routes/` – Definición de los endpoints agrupados por recurso.
- `middlewares/` – Middlewares disponibles, por ejemplo para CORS.
- `Database/` – Clase de conexión a MySQL.

## Endpoints principales

Los archivos en `routes/` crean los siguientes grupos de rutas:

- **/clientes** – CRUD de clientes.
- **/productos** – CRUD de productos.
- **/categorias** – CRUD de categorías.
- **/ventas** – Gestión de ventas.
- **/venta-productos** – Operaciones sobre los productos de cada venta.

Cada grupo soporta normalmente las operaciones `GET`, `POST`, `PUT` y `DELETE` según corresponda. Consulta los archivos de rutas para más detalle.

## Base de datos

La estructura de tablas se encuentra en el archivo [`../db.sql`](../db.sql). Debes importarlo en tu servidor MySQL antes de arrancar la aplicación.
