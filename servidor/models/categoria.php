<?php

require_once '../Database/DB.php';

/*
    Tabla: categorias
    Campos:
    - id
    - nombre
*/

class Categoria {
    private $db;

    public function __construct() {
        $this->db = DB::connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM categorias WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre) {
        $sql = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nombre) {
        $sql = "UPDATE categorias SET nombre = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM categorias WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
