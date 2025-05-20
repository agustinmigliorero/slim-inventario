<?php

require_once '../controllers/controllersVentaProductos.php';

$app->group('/venta-productos', function ($app) {
    $app->get('/venta/{id}', "getProductosByVentaId");
    $app->get('/{id}', "getProductoVentaById");
    $app->post('/venta/{id}', "agregarProductosAVenta");
    $app->delete('/venta/{id}/producto/{producto_id}', "eliminarProductoDeVenta");
    $app->put('/venta/{id}/producto/{producto_id}', "actualizarProductoEnVenta");
    $app->get('/venta/{id}/total', "getTotalVenta");
    $app->get('/venta/{id}/producto/{producto_id}/existe', "productoExisteEnVenta");
    $app->put('/venta/{id}/producto/{producto_id}/cantidad', "actualizarCantidadProductoExistente");
});