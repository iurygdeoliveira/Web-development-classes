<?php

// Deixando o PHP com Tipagem Forte
declare(strict_types=1);

// Autoload do Composer
// Ativando o gerenciador de dependencias do PHP
require_once __DIR__ . '/../vendor/autoload.php';

use League\Route\Router; #Carrega uma biblioteca que roteia as requisições
use src\core\Response;   #Carrega uma biblioteca que emite respostas para o cliente
#use Dotenv\Dotenv; # Carrega uma biblioteca que lê informações do arquivo .env

// Efetivamente lendo as informações do arquivo
// .env e trazendo para a aplicação
// $dotenv = Dotenv::createImmutable(CONF_DOTENV);
// $dotenv->load();

// Ativando um modo de depuração
if (CONF_DEV_MOD) {
    showErrors();
}

$request = getRequest(); // Obtendo as requisições vindas do usuario
$router = new Router(); // Inicia o roteador

// Carrega as rotas da aplicação
// As rotas são as paginas do site
// Nomeia as rotas
$routes = [
    '/../src/routes/dashboardRoutes.php',
];

// Adiciona as rotas na aplicação
foreach ($routes as $route) {
    require_once __DIR__ . $route;
}

// Devolve a requisição com a resposta para o usuário
(new Response($router, $request));