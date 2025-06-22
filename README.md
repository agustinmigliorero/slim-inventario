# Slim Inventario

Este proyecto implementa un sistema de inventario y ventas pensado para agronomías u otros pequeños negocios. 
La aplicación se divide en dos partes principales:

- **cliente/** – Frontend construido con [Next.js](https://nextjs.org/) y Tailwind CSS.
- **servidor/** – API desarrollada en [Slim PHP](https://www.slimframework.com/).

También se incluye el script `db.sql` con la estructura de la base de datos MySQL.

## Requisitos generales

- Node.js 18 o superior y [pnpm](https://pnpm.io/) para el cliente.
- PHP 8 y [Composer](https://getcomposer.org/) para el servidor.
- MySQL para la base de datos.

## Puesta en marcha rápida

1. Clonar este repositorio y preparar la base de datos ejecutando el contenido de `db.sql` en tu servidor MySQL.
2. Revisar `servidor/Database/DB.php` y actualizar las credenciales de conexión si es necesario.
3. Seguir las instrucciones específicas de cada parte consultando los archivos:
   - [`cliente/README.md`](cliente/README.md)
   - [`servidor/README.md`](servidor/README.md)

Con ambos servicios en ejecución podrás acceder a la aplicación web en `http://localhost:3000` (puerto por defecto de Next.js) y la API en `http://localhost:8080`.

## Estructura del repositorio

```
slim-inventario/
├── cliente/        # Aplicación web en Next.js
├── servidor/       # API en Slim PHP
├── db.sql          # Script para crear la base de datos
└── docs/           # Documentación adicional
```

En la carpeta `docs/` encontrarás más detalles sobre la base de datos y otros aspectos del proyecto.
