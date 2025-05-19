<?php

require_once '../controllers/controllersVentas.php';

$app->group('/ventas', function ($app) {
    $app->get('', "getAllVentas");
    $app->get('/{id}', "getVentaById");
    $app->post('', "createVenta");
    $app->put('/{id}', "updateVenta");
    $app->delete('/{id}', "deleteVenta");
});

