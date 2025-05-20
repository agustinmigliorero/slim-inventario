<?php

require_once '../Database/DB.php';

class Venta {
    private $db;

    public function __construct() {
        $this->db = DB::connect();
    }
    
    public function getAll() {
        $sql = "SELECT * FROM ventas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM ventas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($cliente_id, $metodo_pago, $notas, $mano_obra) {
        $sql = "INSERT INTO ventas (cliente_id, metodo_pago, notas, mano_obra) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cliente_id, $metodo_pago, $notas, $mano_obra]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $cliente_id, $metodo_pago, $notas, $mano_obra) {
        $sql = "UPDATE ventas SET cliente_id = ?, metodo_pago = ?, notas = ?, mano_obra = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cliente_id, $metodo_pago, $notas, $mano_obra, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM ventas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEstado($id, $estado) {
        $sql = "UPDATE ventas SET estado = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$estado, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalValor($id) {
        $sql = "SELECT SUM(precio_unitario * cantidad) + mano_obra FROM venta_productos WHERE venta_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}