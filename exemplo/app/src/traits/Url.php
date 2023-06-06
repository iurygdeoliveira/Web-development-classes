<?php

declare(strict_types=1);

namespace src\traits;

use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Str;

trait Url
{

    /**
     * Function que redireciona o usuário para a informada
     *
     * @param string $url destino do redirecionamento
     */
    public function redirect(string $url = null): void
    {
        $url = url($url);
        header("HTTP/1.1 302 Redirect");
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            header("Location: {$url}");
            exit;
        }
    }
}