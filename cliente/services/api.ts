const API_URL = "http://localhost:8000"; // RUTA DEL BACKEND

// Tipos de datos
interface Cliente {
  id?: number;
  nombre: string;
  tipo_persona: "fisica" | "juridica";
  documento: string;
  email: string;
  telefono: string;
  direccion: string;
}

interface Producto {
  id?: number;
  codigo: string;
  nombre: string;
  categoria_id: number;
  precio: number;
  stock: number;
}

interface VentaProducto {
  producto_id: number;
  cantidad: number;
  precio_unitario: number;
}

interface Venta {
  id?: number;
  cliente_id: number;
  metodo_pago: string;
  notas?: string;
  mano_obra?: number;
  productos?: VentaProducto[];
}

// Configuración común para fetch
const fetchConfig = {
  headers: {
    "Content-Type": "application/json",
  },
};

// Función helper para manejar errores
const handleResponse = async (response: Response) => {
  if (!response.ok) {
    const error = await response.json();
    throw new Error(error.message || "Error en la petición");
  }
  return response.json();
};

export const api = {
  // Clientes
  clientes: {
    listar: async (): Promise<Cliente[]> => {
      const response = await fetch(`${API_URL}/clientes`);
      return handleResponse(response);
    },

    obtener: async (id: number): Promise<Cliente> => {
      const response = await fetch(`${API_URL}/clientes/${id}`);
      return handleResponse(response);
    },

    crear: async (cliente: Cliente): Promise<Cliente> => {
      const response = await fetch(`${API_URL}/clientes`, {
        method: "POST",
        ...fetchConfig,
        body: JSON.stringify(cliente),
      });
      return handleResponse(response);
    },

    actualizar: async (id: number, cliente: Cliente): Promise<Cliente> => {
      const response = await fetch(`${API_URL}/clientes/${id}`, {
        method: "PUT",
        ...fetchConfig,
        body: JSON.stringify(cliente),
      });
      return handleResponse(response);
    },

    eliminar: async (id: number): Promise<void> => {
      const response = await fetch(`${API_URL}/clientes/${id}`, {
        method: "DELETE",
      });
      return handleResponse(response);
    },
  },

  // Productos
  productos: {
    listar: async (): Promise<Producto[]> => {
      const response = await fetch(`${API_URL}/productos`);
      return handleResponse(response);
    },

    obtener: async (id: number): Promise<Producto> => {
      const response = await fetch(`${API_URL}/productos/${id}`);
      return handleResponse(response);
    },

    crear: async (producto: Producto): Promise<Producto> => {
      const response = await fetch(`${API_URL}/productos`, {
        method: "POST",
        ...fetchConfig,
        body: JSON.stringify(producto),
      });
      return handleResponse(response);
    },

    actualizar: async (id: number, producto: Producto): Promise<Producto> => {
      const response = await fetch(`${API_URL}/productos/${id}`, {
        method: "PUT",
        ...fetchConfig,
        body: JSON.stringify(producto),
      });
      return handleResponse(response);
    },

    eliminar: async (id: number): Promise<void> => {
      const response = await fetch(`${API_URL}/productos/${id}`, {
        method: "DELETE",
      });
      return handleResponse(response);
    },
  },

  // Ventas
  ventas: {
    listar: async (): Promise<Venta[]> => {
      const response = await fetch(`${API_URL}/ventas`);
      return handleResponse(response);
    },

    obtener: async (id: number): Promise<Venta> => {
      const response = await fetch(`${API_URL}/ventas/${id}`);
      return handleResponse(response);
    },

    crear: async (venta: Venta): Promise<Venta> => {
      const response = await fetch(`${API_URL}/ventas`, {
        method: "POST",
        ...fetchConfig,
        body: JSON.stringify(venta),
      });
      return handleResponse(response);
    },

    actualizar: async (id: number, venta: Venta): Promise<Venta> => {
      const response = await fetch(`${API_URL}/ventas/${id}`, {
        method: "PUT",
        ...fetchConfig,
        body: JSON.stringify(venta),
      });
      return handleResponse(response);
    },

    eliminar: async (id: number): Promise<void> => {
      const response = await fetch(`${API_URL}/ventas/${id}`, {
        method: "DELETE",
      });
      return handleResponse(response);
    },

    // Productos de una venta
    obtenerProductos: async (ventaId: number): Promise<VentaProducto[]> => {
      const response = await fetch(`${API_URL}/ventas/${ventaId}/productos`);
      return handleResponse(response);
    },

    agregarProductos: async (
      ventaId: number,
      productos: VentaProducto[]
    ): Promise<void> => {
      const response = await fetch(`${API_URL}/ventas/${ventaId}/productos`, {
        method: "POST",
        ...fetchConfig,
        body: JSON.stringify({ productos }),
      });
      return handleResponse(response);
    },

    obtenerTotal: async (ventaId: number): Promise<{ total: number }> => {
      const response = await fetch(`${API_URL}/ventas/${ventaId}/total`);
      return handleResponse(response);
    },
  },
};
