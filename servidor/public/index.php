<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

use App\middlewares\CorsMiddleware;

// Agregar el middleware (antes de las rutas)
$app->add(new CorsMiddleware());

require_once '../routes/routesClientes.php';
require_once '../routes/routesProductos.php';
require_once '../routes/routesCategorias.php';
require_once '../routes/routesVentas.php';
require_once '../routes/routesVentaProductos.php';

$app->run();