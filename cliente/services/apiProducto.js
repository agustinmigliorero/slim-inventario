import { API_URL } from "./api";

export async function getAllProductos() {
  const response = await fetch(`${API_URL}/productos`);
  const data = await response.json();
  return data;
}

export async function getProductoById(id) {
  const response = await fetch(`${API_URL}/productos/${id}`);
  const data = await response.json();
  return data;
}

export async function createProducto(producto) {
  const response = await fetch(`${API_URL}/productos`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  });
}

export async function updateProducto(id, producto) {
  const response = await fetch(`${API_URL}/productos/${id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
  });
}

export async function deleteProducto(id) {
  const response = await fetch(`${API_URL}/productos/${id}`, {
    method: "DELETE",
  });
}
