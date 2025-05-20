<?php

require_once '../Database/DB.php';

class VentaProductos {
    private $db;

    public function __construct() {
        $this->db = DB::connect();
    }

    public function getProductosByVentaId($venta_id) {
        $query = "SELECT venta_productos.*, productos.nombre as producto_nombre, productos.codigo as producto_codigo 
                 FROM venta_productos 
                 JOIN productos ON venta_productos.producto_id = productos.id 
                 WHERE venta_productos.venta_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$venta_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Agregar multiple productos a una venta
    public function agregarProductosAVenta($venta_id, $productos) {
        $values = [];
        $params = [];
        
        foreach ($productos as $producto) {
            $values[] = "(?, ?, ?, ?)";
            $params[] = $venta_id;
            $params[] = $producto['producto_id'];
            $params[] = $producto['cantidad'];
            $params[] = $producto['precio_unitario'];
        }
        
        $query = "INSERT INTO venta_productos (venta_id, producto_id, cantidad, precio_unitario) 
                 VALUES " . implode(', ', $values);
                 
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function eliminarProductoDeVenta($venta_id, $producto_id) {
        $query = "DELETE FROM venta_productos WHERE venta_id = ? AND producto_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$venta_id, $producto_id]);
    }

    public function actualizarProductoEnVenta($venta_id, $producto_id, $cantidad, $precio_unitario) {
        $query = "UPDATE venta_productos SET cantidad = ?, precio_unitario = ? WHERE venta_id = ? AND producto_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$cantidad, $precio_unitario, $venta_id, $producto_id]);
    }

        // Obtener un producto específico de una venta
        public function getProductoVentaById($id) {
            $query = "SELECT vp.*, p.nombre as producto_nombre, p.codigo as producto_codigo 
                     FROM venta_productos vp 
                     JOIN productos p ON vp.producto_id = p.id 
                     WHERE vp.id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        // Obtener el total de una venta
        public function getTotalVenta($venta_id) {
            $query = "SELECT SUM(cantidad * precio_unitario) as total 
                     FROM venta_productos 
                     WHERE venta_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$venta_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        }
    
        // Verificar si un producto ya existe en una venta
        public function productoExisteEnVenta($venta_id, $producto_id) {
            $query = "SELECT COUNT(*) as count 
                     FROM venta_productos 
                     WHERE venta_id = ? AND producto_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$venta_id, $producto_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        }
    
        // Actualizar cantidad si el producto ya existe en la venta
        public function actualizarCantidadProductoExistente($venta_id, $producto_id, $cantidad) {
            $query = "UPDATE venta_productos 
                     SET cantidad = cantidad + ? 
                     WHERE venta_id = ? AND producto_id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$cantidad, $venta_id, $producto_id]);
        }

}
