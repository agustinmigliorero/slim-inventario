<?php

require_once '../controllers/controllersClientes.php';

$app->group('/clientes', function ($app) {
    $app->get('', "getAllClientes");
    $app->get('/{id}', "getClienteById");
    $app->post('', "createCliente");
    $app->put('/{id}', "updateCliente");
    $app->delete('/{id}', "deleteCliente");
});