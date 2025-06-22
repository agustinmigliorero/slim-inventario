# Esquema de Base de Datos

El archivo [`db.sql`](../db.sql) define todas las tablas utilizadas por el sistema. A continuación se presenta un resumen de cada una de ellas y sus relaciones principales.

## clientes

Registra la información básica de los clientes.

- **id** – Clave primaria autoincremental.
- **nombre** – Nombre completo o razón social.
- **tipo_persona** – `fisica` o `juridica`.
- **documento** – CUIT/CUIL.
- **email**, **telefono**, **direccion** – Datos de contacto.

## proveedores

Información de proveedores. Su estructura es similar a la tabla `clientes`.

## categorias

Listado de categorías de productos.

- **id** – Clave primaria.
- **nombre** – Nombre único de la categoría.

## productos

Inventario de productos disponibles.

- **id** – Clave primaria.
- **codigo** – Código único del producto.
- **nombre** – Descripción.
- **categoria_id** – Relacionado con `categorias.id`.
- **precio** – Precio unitario.
- **stock** – Cantidad disponible.

## ventas y venta_productos

- **ventas** almacena la información general de cada venta (cliente, método de pago, total, etc.).
- **venta_productos** relaciona productos con una venta específica, indicando cantidad y precio unitario. Está vinculada a `ventas` y `productos` mediante claves foráneas.

## compras y compra_productos

Estructura equivalente a las ventas pero aplicada a compras a proveedores.

## cobros

Registra los pagos pendientes y su estado asociado tanto a ventas como a compras.

Cada tabla incluye campos `created_at` y `updated_at` para auditoría automática.
