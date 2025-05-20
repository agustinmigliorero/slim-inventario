<?php

require_once __DIR__ . '/../models/venta_productos.php';

function getProductosByVentaId($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $productos = $ventaProductos->getProductosByVentaId($args['id']);
    $res->getBody()->write(json_encode($productos));
}

function agregarProductosAVenta($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $data = $req->getParsedBody();
    
    if (!isset($data['productos'])) {
        $productos = [[
            'producto_id' => $data['producto_id'],
            'cantidad' => $data['cantidad'],
            'precio_unitario' => $data['precio_unitario']
        ]];
    } else {
        $productos = $data['productos'];
    }
    
    $ventaProductos->agregarProductosAVenta($args['id'], $productos);
    $res->getBody()->write(json_encode(['message' => 'Producto(s) agregado(s) a la venta']));
}

function eliminarProductoDeVenta($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $ventaProductos->eliminarProductoDeVenta($args['id'], $args['producto_id']);
    $res->getBody()->write(json_encode(['message' => 'Producto eliminado de la venta']));
}

function actualizarProductoEnVenta($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $data = $req->getParsedBody();
    $ventaProductos->actualizarProductoEnVenta($args['id'], $args['producto_id'], $data['cantidad'], $data['precio_unitario']);
    $res->getBody()->write(json_encode(['message' => 'Producto actualizado en la venta']));
}

function getProductoVentaById($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $producto = $ventaProductos->getProductoVentaById($args['id']);
    $res->getBody()->write(json_encode($producto));
}

function getTotalVenta($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $total = $ventaProductos->getTotalVenta($args['id']);
    $res->getBody()->write(json_encode(['total' => $total]));
}

function productoExisteEnVenta($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $existe = $ventaProductos->productoExisteEnVenta($args['id'], $args['producto_id']);
    $res->getBody()->write(json_encode(['existe' => $existe]));
}

function actualizarCantidadProductoExistente($req, $res, $args) {
    $ventaProductos = new VentaProductos();
    $data = $req->getParsedBody();
    $ventaProductos->actualizarCantidadProductoExistente($args['id'], $args['producto_id'], $data['cantidad']);
    $res->getBody()->write(json_encode(['message' => 'Cantidad actualizada en la venta']));
}

