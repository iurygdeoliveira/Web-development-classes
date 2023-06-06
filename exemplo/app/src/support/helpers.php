<?php

declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Illuminate\Support\Str;


function url(string $path = null): string
{

    if (Str::contains($_SERVER['HTTP_HOST'], '10.113.70.230')) {
        if ($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return CONF_URL_TEST;
    }

    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE;
}

function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());
}

/**
 * It returns the path to the asset folder, and if you pass a path, it will return the path to the
 * asset folder + the path you passed
 * 
 * @param string path The path to the file you want to access.
 * @param string asset The name of the asset folder.
 * 
 * @return string the path of the asset.
 */
function path(string $path = null, string $asset): string
{
    if (Str::contains($_SERVER['HTTP_HOST'], '10.113.70.230')) {
        if ($path) {
            return "/assets/$asset/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return "/assets/$asset/";
    }

    if ($path) {
        return "/assets/$asset/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return "/assets/$asset/";
}

function img(string $path = null): string
{
    return path($path, "img");
}

function css(string $path = null): string
{
    return path($path, "css");
}

function js(string $path = null): string
{
    return path($path, "js");
}


/**
 * Cria um objeto de solicitação PSR-7 a partir das variáveis ​​globais
 */
function getRequest()
{
    $request = ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );
    return $request;
}

/**
 * Ele cria um novo manipulador de erros Whoops, registra-o, cria um novo DebugBar e cria um novo
 * DebugBarRenderer
 */
function showErrors()
{

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}
