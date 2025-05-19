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

    public function create($cliente_id, $metodo_pago, $notas) {
        $sql = "INSERT INTO ventas (cliente_id, metodo_pago, notas) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cliente_id, $metodo_pago, $notas]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $cliente_id, $metodo_pago, $notas) {
        $sql = "UPDATE ventas SET cliente_id = ?, metodo_pago = ?, notas = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cliente_id, $metodo_pago, $notas, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM ventas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}