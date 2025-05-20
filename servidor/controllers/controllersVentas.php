<?php

require_once '../models/venta.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function getAllVentas($req, $res, $args) {
    $venta = new Venta();
    $ventas = $venta->getAll();
    $res->getBody()->write(json_encode($ventas));
}

function getVentaById($req, $res, $args) {
    $venta = new Venta();
    $id = $args['id'];
    $venta = $venta->getById($id);
    $res->getBody()->write(json_encode($venta));
}

function createVenta($req, $res, $args) {
    $venta = new Venta();
    $data = $req->getParsedBody();
    $venta = $venta->create($data['cliente_id'], $data['metodo_pago'], $data['mano_obra'], $data['notas'], $data['estado']);
    $res->getBody()->write(json_encode($venta));
}

function updateVenta($req, $res, $args) {
    $venta = new Venta();
    $data = $req->getParsedBody();
    $venta = $venta->update($data['id'], $data['cliente_id'], $data['metodo_pago'], $data['mano_obra'], $data['notas'], $data['estado']);
    $res->getBody()->write(json_encode($venta));
}

function deleteVenta($req, $res, $args) {
    $venta = new Venta();
    $id = $args['id'];
    $venta = $venta->delete($id);
    $res->getBody()->write(json_encode($venta));
}

function updateEstadoVenta($req, $res, $args) {
    $venta = new Venta();
    $data = $req->getParsedBody();
    $venta = $venta->updateEstado($data['id'], $data['estado']);
    $res->getBody()->write(json_encode($venta));
}

function getTotalValorVenta($req, $res, $args) {
    $venta = new Venta();
    $id = $args['id'];
    $total = $venta->getTotalValor($id);
    $res->getBody()->write(json_encode($total));
}