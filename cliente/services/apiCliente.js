import { API_URL } from "./api";

export async function getAllClientes() {
  const response = await fetch(API_URL + "/clientes");
  const data = await response.json();
  return data;
}

export async function getClienteById(id) {
  const response = await fetch(`${API_URL}/clientes/${id}`);
  const data = await response.json();
  return data;
}

export async function createCliente(cliente) {
  const response = await fetch(`${API_URL}/clientes`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(cliente),
  });
  const data = await response.json();
  return data;
}

export async function updateCliente(id, cliente) {
  const response = await fetch(`${API_URL}/clientes/${id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(cliente),
  });
  const data = await response.json();
  return data;
}

export async function deleteCliente(id) {
  const response = await fetch(`${API_URL}/clientes/${id}`, {
    method: "DELETE",
  });
  const data = await response.json();
  return data;
}

// export async function changeClienteState(id, state) {
//   const response = await fetch(`${API_URL}/clientes/${id}/state`, {
//     method: "PUT",
//     headers: {
//       "Content-Type": "application/json",
//     },
//   });
//   const data = await response.json();
//   return data;
// }
