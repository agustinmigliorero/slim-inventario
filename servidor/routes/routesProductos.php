<?php

require_once '../controllers/controllersProductos.php';

$app->group('/productos', function ($app) {
    $app->get('', "getAllProductos");
    $app->get('/{id}', "getProductoById");
    $app->post('', "createProducto");
    $app->put('/{id}', "updateProducto");
    $app->delete('/{id}', "deleteProducto");
});