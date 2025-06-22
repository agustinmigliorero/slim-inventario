# Cliente (Next.js)

Esta carpeta contiene la interfaz web desarrollada en Next.js 15 y TypeScript. Se utilizan Tailwind CSS y los componentes de Radix UI para el diseño.

## Requisitos

- Node.js 18 o superior
- [pnpm](https://pnpm.io/) para la gestión de dependencias

## Puesta en marcha

```bash
cd cliente
pnpm install          # Instala las dependencias
pnpm dev              # Ejecuta el servidor de desarrollo en http://localhost:3000
```

Otros comandos útiles:

```bash
pnpm build            # Compila el proyecto para producción
pnpm start            # Sirve la versión compilada
pnpm lint             # Ejecuta ESLint
```

## Estructura del proyecto

- `app/` – Páginas y rutas de la aplicación usando el sistema de routing de Next.js.
- `components/` – Componentes reutilizables de la interfaz.
- `services/` – Pequeños clientes HTTP para consumir la API del servidor.
- `styles/` – Hojas de estilo globales y configuración de Tailwind.

La URL de la API se define en `services/api.js` mediante la constante `API_URL`. Ajusta este valor si el backend se ejecuta en otra dirección o puerto.

## Descripción general

La interfaz ofrece pantallas para administrar clientes, productos, inventario y ventas. Muchas de las vistas contienen ejemplos de datos de prueba que pueden sustituirse por información obtenida desde la API.
