<?php
require_once '../controllers/controllersCategorias.php';

$app->group('/categorias', function ($app) {
    $app->get('', "getAllCategorias");
    $app->get('/{id}', "getCategoriaById");
    $app->post('', "createCategoria");
    $app->put('/{id}', "updateCategoria");
    $app->delete('/{id}', "deleteCategoria");
});
