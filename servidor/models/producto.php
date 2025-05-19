<?php

require_once '../Database/DB.php';

/*
    Tabla: productos
    Campos:
    - id
    - codigo (tambien es unico)
    - nombre
    - categoria (id de la categoria)
    - precio
    - stock
*/

class Producto {
    private $db;

    public function __construct() {
        $this->db = DB::connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($codigo, $nombre, $categoria_id, $precio, $stock) {
        $sql = "INSERT INTO productos (codigo, nombre, categoria_id, precio, stock) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$codigo, $nombre, $categoria_id, $precio, $stock]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $codigo, $nombre, $categoria_id, $precio, $stock) {
        $sql = "UPDATE productos SET codigo = ?, nombre = ?, categoria_id = ?, precio = ?, stock = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$codigo, $nombre, $categoria_id, $precio, $stock, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}