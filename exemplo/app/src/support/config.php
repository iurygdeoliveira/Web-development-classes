<?php

/**
 * Parâmetros de Configuração do Sistema
 */

declare(strict_types=1);

define("CONF_DEV_MOD", true);
define("CONF_PROD_MOD", false);

// ###  PROJECT URLs ###
define("CONF_URL_SCHEME", "http");
define("CONF_URL_BASE", "10.113.70.230");
define("CONF_URL_TEST", "10.113.70.230");

// ### DATES ###
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

// ### VIEW ###
define("CONF_VIEW_THEME", "hyper");
define("CONF_VIEW_ASSETS", __DIR__ . "/../../public/assets");

// ### DESCRIPTION ###
define("CONF_SITE_LANG", "pt-BR");
define("CONF_SITE_DESCRIPTION", "Esse é um site de exemplo");
define("CONF_SITE_AUTHOR", "Iury Gomes de Oliveira");

// ### LOGS ###
define("CONF_ERROR_LOG", __DIR__ . "/../storage/errors/");


// ### DOTENV ###
define("CONF_DOTENV", "/var/www/html/");
