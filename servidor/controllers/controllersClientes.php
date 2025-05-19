<?php
require_once '../models/cliente.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


function getAllClientes($req, $res, $args) {
    $cliente = new Cliente();
    $clientes = $cliente->getAll();
    $res->getBody()->write(json_encode($clientes));
    return $res->withHeader('Content-Type', 'application/json');
}

function getClienteById($req, $res, $args) {
    $cliente = new Cliente();
    $id = $args['id'];
    $cliente = $cliente->getById($id);
    $res->getBody()->write(json_encode($cliente));
    return $res->withHeader('Content-Type', 'application/json');
}

function createCliente($req, $res, $args) {
    $cliente = new Cliente();
    $data = $req->getParsedBody();
    $cliente = $cliente->create($data['nombre'], $data['tipo_persona'], $data['documento'], $data['email'], $data['telefono'], $data['direccion']);
    $res->getBody()->write(json_encode($cliente));
    return $res->withHeader('Content-Type', 'application/json');
}

function updateCliente($req, $res, $args) {
    $cliente = new Cliente();
    $data = $req->getParsedBody();
    $cliente = $cliente->update($data['id'], $data['nombre'], $data['tipo_persona'], $data['documento'], $data['email'], $data['telefono'], $data['direccion']);
    $res->getBody()->write(json_encode($cliente));
    return $res->withHeader('Content-Type', 'application/json');
}

function deleteCliente($req, $res, $args) {
    $cliente = new Cliente();
    $id = $args['id'];
    $cliente = $cliente->delete($id);
    $res->getBody()->write(json_encode($cliente));
    return $res->withHeader('Content-Type', 'application/json');
}

