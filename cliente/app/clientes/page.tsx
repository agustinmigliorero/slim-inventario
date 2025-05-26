"use client";

import { useEffect, useState } from "react";
import { Download, MoreHorizontal, UserPlus } from "lucide-react";

import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import {
  getAllClientes,
  createCliente,
  updateCliente,
  deleteCliente,
} from "@/services/apiCliente";

interface Cliente {
  id: number;
  nombre: string;
  tipo_persona: "fisica" | "juridica";
  documento: string;
  email: string;
  telefono: string;
  direccion: string;
  activo: boolean;
}

export default function ClientesPage() {
  const [isDialogOpen, setIsDialogOpen] = useState(false);
  const [isEditing, setIsEditing] = useState(false);
  const [clientes, setClientes] = useState<Cliente[]>([]);
  const [formData, setFormData] = useState({
    id: 0,
    nombre: "",
    tipo_persona: "fisica" as "fisica" | "juridica",
    documento: "",
    email: "",
    telefono: "",
    direccion: "",
    activo: true,
  });
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    getAllClientes().then(setClientes);
  }, []);

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { id, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [id]: value,
    }));
  };

  const handleSelectChange = (value: "fisica" | "juridica") => {
    setFormData((prev) => ({
      ...prev,
      tipo_persona: value,
    }));
  };

  const resetForm = () => {
    setFormData({
      id: 0,
      nombre: "",
      tipo_persona: "fisica",
      documento: "",
      email: "",
      telefono: "",
      direccion: "",
      activo: true,
    });
    setIsEditing(false);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);
    try {
      if (isEditing) {
        await updateCliente(formData.id, formData);
      } else {
        await createCliente(formData);
      }
      const clientesActualizados = await getAllClientes();
      setClientes(clientesActualizados);
      setIsDialogOpen(false);
      resetForm();
    } catch (error) {
      console.error("Error al guardar cliente:", error);
    } finally {
      setIsLoading(false);
    }
  };

  const handleVerDetalles = (id: number) => {
    // TODO: Implementar vista de detalles
    console.log("Ver detalles del cliente:", id);
  };

  const handleEditarCliente = (cliente: Cliente) => {
    setFormData(cliente);
    setIsEditing(true);
    setIsDialogOpen(true);
  };

  const handleVerHistorial = (id: number) => {
    // TODO: Implementar vista de historial
    console.log("Ver historial del cliente:", id);
  };

  const handleToggleEstado = async (id: number, nuevoEstado: boolean) => {
    try {
      // TODO: Implementar actualización de estado
      console.log("Cambiar estado del cliente:", id, nuevoEstado);
      // Actualizar el estado local después de la actualización exitosa
      setClientes(
        clientes.map((cliente) =>
          cliente.id === id ? { ...cliente, activo: nuevoEstado } : cliente
        )
      );
    } catch (error) {
      console.error("Error al cambiar estado del cliente:", error);
    }
  };

  const handleNuevoCliente = () => {
    resetForm();
    setIsDialogOpen(true);
  };

  const handleCloseDialog = () => {
    setIsDialogOpen(false);
    resetForm();
  };

  return (
    <div className="flex-1 space-y-4 p-4 md:p-8 pt-6">
      <div className="flex items-center justify-between space-y-2">
        <h2 className="text-3xl font-bold tracking-tight">Clientes</h2>
        <div className="flex items-center space-x-2">
          <Button
            className="bg-green-600 hover:bg-green-700"
            onClick={handleNuevoCliente}
          >
            <UserPlus className="mr-2 h-4 w-4" />
            Nuevo Cliente
          </Button>
          <Button variant="outline">
            <Download className="mr-2 h-4 w-4" />
            Exportar
          </Button>
        </div>
      </div>
      <div className="flex items-center justify-between">
        <div className="flex flex-1 items-center space-x-2">
          <Input
            placeholder="Buscar clientes..."
            className="h-9 w-[150px] lg:w-[250px]"
          />
        </div>
      </div>
      <Card>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Nombre</TableHead>
                <TableHead>Tipo</TableHead>
                <TableHead>CUIT/CUIL</TableHead>
                <TableHead>Teléfono</TableHead>
                <TableHead>Email</TableHead>
                {/* <TableHead className="text-right">Estado</TableHead> */}
                <TableHead className="text-right">Acciones</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {clientes.map((cliente) => (
                <TableRow key={cliente.id}>
                  <TableCell className="font-medium">
                    {cliente.nombre}
                  </TableCell>
                  <TableCell>
                    {cliente.tipo_persona === "fisica"
                      ? "Persona Física"
                      : "Empresa"}
                  </TableCell>
                  <TableCell>{cliente.documento}</TableCell>
                  <TableCell>{cliente.telefono}</TableCell>
                  <TableCell>{cliente.email}</TableCell>

                  {/* Estado */}

                  {/* <TableCell className="text-right">
                    <Badge
                      className={
                        cliente.activo
                          ? "bg-green-500"
                          : "text-yellow-600 border-yellow-600"
                      }
                    >
                      {cliente.activo ? "Activo" : "Inactivo"}
                    </Badge>
                  </TableCell> */}

                  {/* Estado */}

                  <TableCell className="text-right">
                    <DropdownMenu>
                      <DropdownMenuTrigger asChild>
                        <Button variant="ghost" className="h-8 w-8 p-0">
                          <span className="sr-only">Abrir menú</span>
                          <MoreHorizontal className="h-4 w-4" />
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Acciones</DropdownMenuLabel>
                        <DropdownMenuItem
                          onClick={() => handleVerDetalles(cliente.id)}
                        >
                          Ver detalles
                        </DropdownMenuItem>
                        <DropdownMenuItem
                          onClick={() => handleEditarCliente(cliente)}
                        >
                          Editar cliente
                        </DropdownMenuItem>
                        <DropdownMenuItem
                          onClick={() => handleVerHistorial(cliente.id)}
                        >
                          Historial de compras
                        </DropdownMenuItem>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem
                          className={
                            cliente.activo ? "text-red-600" : "text-green-600"
                          }
                          onClick={() =>
                            handleToggleEstado(cliente.id, !cliente.activo)
                          }
                        >
                          {cliente.activo
                            ? "Desactivar cliente"
                            : "Activar cliente"}
                        </DropdownMenuItem>
                      </DropdownMenuContent>
                    </DropdownMenu>
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <Dialog open={isDialogOpen} onOpenChange={handleCloseDialog}>
        <DialogContent className="sm:max-w-[425px]">
          <DialogHeader>
            <DialogTitle>
              {isEditing ? "Editar Cliente" : "Agregar Nuevo Cliente"}
            </DialogTitle>
            <DialogDescription>
              {isEditing
                ? "Modifique los datos del cliente según sea necesario."
                : "Complete los datos del cliente para agregarlo al sistema."}
            </DialogDescription>
          </DialogHeader>
          <form onSubmit={handleSubmit}>
            <div className="grid gap-4 py-4">
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="nombre" className="text-right">
                  Nombre
                </Label>
                <Input
                  id="nombre"
                  className="col-span-3"
                  value={formData.nombre}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="tipo" className="text-right">
                  Tipo
                </Label>
                <Select
                  value={formData.tipo_persona}
                  onValueChange={handleSelectChange}
                >
                  <SelectTrigger className="col-span-3">
                    <SelectValue placeholder="Seleccionar" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="fisica">Persona Física</SelectItem>
                    <SelectItem value="juridica">Empresa</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="documento" className="text-right">
                  CUIT/CUIL
                </Label>
                <Input
                  id="documento"
                  className="col-span-3"
                  value={formData.documento}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="telefono" className="text-right">
                  Teléfono
                </Label>
                <Input
                  id="telefono"
                  className="col-span-3"
                  value={formData.telefono}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="email" className="text-right">
                  Email
                </Label>
                <Input
                  id="email"
                  type="email"
                  className="col-span-3"
                  value={formData.email}
                  onChange={handleInputChange}
                  required
                />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="direccion" className="text-right">
                  Dirección
                </Label>
                <Input
                  id="direccion"
                  className="col-span-3"
                  value={formData.direccion}
                  onChange={handleInputChange}
                  required
                />
              </div>
            </div>
            <DialogFooter>
              <Button
                type="button"
                variant="outline"
                onClick={handleCloseDialog}
                disabled={isLoading}
              >
                Cancelar
              </Button>
              <Button
                type="submit"
                className="bg-green-600 hover:bg-green-700"
                disabled={isLoading}
              >
                {isLoading
                  ? "Guardando..."
                  : isEditing
                  ? "Actualizar"
                  : "Guardar"}
              </Button>
            </DialogFooter>
          </form>
        </DialogContent>
      </Dialog>
    </div>
  );
}
