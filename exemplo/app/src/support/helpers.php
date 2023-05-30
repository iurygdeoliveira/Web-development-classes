<?php

declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Illuminate\Support\Str;
use src\core\Session;
use MemCachier\MemcacheSASL as Cache;
use Decimal\Decimal;

function url(string $path = null): string
{

    if (Str::contains($_SERVER['HTTP_HOST'], 'localhost')) {
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
    if (Str::contains($_SERVER['HTTP_HOST'], 'localhost')) {
        if ($path) {
            return CONF_URL_TEST . "/assets/$asset/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return CONF_URL_TEST . "/assets/$asset/";
    }

    if ($path) {
        return CONF_URL_BASE . "/assets/$asset/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE . "/assets/$asset/";
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
 * Se houver uma mensagem flash, faça eco e retorne null
 * 
 * @return ?string null
 */
function flash(): ?string
{
    $session = new Session();
    $flash = $session->flash();
    if ($flash) {
        echo $flash;
    }
    return null;
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

function dpexit($var)
{
    ini_set("xdebug.var_display_max_children", -1);
    ini_set("xdebug.var_display_max_data", -1);
    ini_set("xdebug.var_display_max_depth", -1);

    var_dump(
        $var
    );
    exit;
}

function dp($var)
{
    ini_set("xdebug.var_display_max_children", -1);
    ini_set("xdebug.var_display_max_data", -1);
    ini_set("xdebug.var_display_max_depth", -1);

    var_dump(
        $var
    );
}

/**
 * É uma função que recebe um objeto de cache e retorna uma barra de depuração com as estatísticas do cache
 * @param Cache de cache O objeto de cache.
 */
function cacheStats(Cache $cache)
{

    $status = $cache->getStats('');

    $limit = new Decimal($status['limit_maxbytes']);
    $size = new Decimal($status['bytes']);
    $hits = new Decimal($status['get_hits']);
    $misses = new Decimal($status['get_misses']);
    $itens = new Decimal($status['curr_items']);

    $kilobyte = new Decimal('1024');
    $megabyte = $kilobyte->pow('2')->__toString();
    $gigabyte = $kilobyte->pow('3')->__toString();


    if ($limit->div($gigabyte)->compareTo(1) == -1) {
        dump([
            'Tamanho (MB)' => $limit->div($megabyte)->__toString(),
            'Utilizado (MB)' => $size->div($megabyte)->__toString(),
            'hits' => $hits->__toString(),
            'misses' => $misses->__toString(),
            'itens' => $itens->__toString(),
        ]);
    } else {
        dump([
            'Tamanho (GB)' => $limit->div($gigabyte)->__toString(),
            'Utilizado (GB)' => $size->div($gigabyte)->__toString(),
            'hits' => $hits->__toString(),
            'misses' => $misses->__toString(),
            'itens' => $itens->__toString(),
        ]);
    }
}

/**
 *Gera um token aleatório, armazena-o na sessão e retorna um hash do token
 *
 *@return string|false hash de um token aleatório.
 */
function csrf()
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    return hash('sha256', $token);
}

/**
 *Se o token for válido, desmarque-o e retorne true, caso contrário, retorne false
 *
 *@param string token O token a ser validado.
 *
 *@return bool Um valor booleano.
 */
function validateCsrf(string $token)
{
    if (isset($_SESSION['csrf_token']) && hash('sha256', $_SESSION['csrf_token']) === $token) {
        unset($_SESSION['csrf_token']);
        return true;
    }
    return false;
}