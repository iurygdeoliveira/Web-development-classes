<?php

declare(strict_types=1);

namespace src\core;

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Router;
use Exception;
use src\traits\Url;

class Response
{
    use Url;

    public function __construct(Router $router, ServerRequestInterface $request)
    {
        $response = $router->dispatch($request);
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }
}