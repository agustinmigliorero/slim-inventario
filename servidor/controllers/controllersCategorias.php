<?php
require_once '../models/categoria.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function getAllCategorias($req, $res, $args) {
    $categoria = new Categoria();
    $categorias = $categoria->getAll();
    $res->getBody()->write(json_encode($categorias));
    return $res->withHeader('Content-Type', 'application/json');
}

function getCategoriaById($req, $res, $args) {
    $categoria = new Categoria();
    $id = $args['id'];
    $categoria = $categoria->getById($id);
    $res->getBody()->write(json_encode($categoria));
    return $res->withHeader('Content-Type', 'application/json');
}

function createCategoria($req, $res, $args) {
    $categoria = new Categoria();
    $data = $req->getParsedBody();
    $categoria = $categoria->create($data['nombre']);
    $res->getBody()->write(json_encode($categoria));
    return $res->withHeader('Content-Type', 'application/json');
}

function updateCategoria($req, $res, $args) {
    $categoria = new Categoria();
    $data = $req->getParsedBody();
    $categoria = $categoria->update($data['id'], $data['nombre']);
    $res->getBody()->write(json_encode($categoria));
    return $res->withHeader('Content-Type', 'application/json');
}

function deleteCategoria($req, $res, $args) {
    $categoria = new Categoria();
    $id = $args['id'];
    $categoria = $categoria->delete($id);
    $res->getBody()->write(json_encode($categoria));
    return $res->withHeader('Content-Type', 'application/json');
}
