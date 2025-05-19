<?php

require_once '../Database/DB.php';

/*
    Tabla: clientes
    Campos:
    - id
    - nombre (nombre completo de la persona o nombre de la empresa)
    - tipo_persona (fisica o juridica)
    - documento (CUIT/CUIL)
    - email
    - telefono
    - direccion
*/

class Cliente {
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $tipo_persona, $documento, $email, $telefono, $direccion)
    {
        $sql = "INSERT INTO clientes (nombre, tipo_persona, documento, email, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre, $tipo_persona, $documento, $email, $telefono, $direccion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nombre, $tipo_persona, $documento, $email, $telefono, $direccion)
    {
        $sql = "UPDATE clientes SET nombre = ?, tipo_persona = ?, documento = ?, email = ?, telefono = ?, direccion = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre, $tipo_persona, $documento, $email, $telefono, $direccion, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}