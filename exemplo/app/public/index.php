<?php

declare(strict_types=1);

// Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

use League\Route\Router;
use src\core\Response;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(CONF_DOTENV);
$dotenv->load();


if (CONF_DEV_MOD) {
    showErrors();
}

$request = getRequest(); // Obter requisição
$router = new Router(); // Inicia o roteador

// Carregar rotas
$routes = [
    '/../src/routes/dashboardRoutes.php',
];

foreach ($routes as $route) {
    require_once __DIR__ . $route;
}

// Enviar Resposta
(new Response($router, $request));