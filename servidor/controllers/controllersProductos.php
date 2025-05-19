<?php

require_once '../models/producto.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function getAllProductos($req, $res, $args) {
    $producto = new Producto();
    $productos = $producto->getAll();
    $res->getBody()->write(json_encode($productos));
    return $res->withHeader('Content-Type', 'application/json');
}

function getProductoById($req, $res, $args) {
    $producto = new Producto();
    $id = $args['id'];
    $producto = $producto->getById($id);
    $res->getBody()->write(json_encode($producto));
    return $res->withHeader('Content-Type', 'application/json');
}

function createProducto($req, $res, $args) {
    $producto = new Producto();
    $data = $req->getParsedBody();
    $producto = $producto->create($data['codigo'], $data['nombre'], $data['categoria'], $data['precio'], $data['stock']);
    $res->getBody()->write(json_encode($producto));
    return $res->withHeader('Content-Type', 'application/json');
}

function updateProducto($req, $res, $args) {
    $producto = new Producto();
    $data = $req->getParsedBody();
    $producto = $producto->update($data['id'], $data['codigo'], $data['nombre'], $data['categoria'], $data['precio'], $data['stock']);
    $res->getBody()->write(json_encode($producto));
    return $res->withHeader('Content-Type', 'application/json');
}

function deleteProducto($req, $res, $args) {
    $producto = new Producto();
    $id = $args['id'];
    $producto = $producto->delete($id);
    $res->getBody()->write(json_encode($producto));
    return $res->withHeader('Content-Type', 'application/json');
}
