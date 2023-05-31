<?php

/**
 * Parâmetros de Configuração do Sistema
 */

declare(strict_types=1);

define("CONF_DEV_MOD", true);
define("CONF_PROD_MOD", false);

// ###  PROJECT URLs ###
define("CONF_URL_SCHEME", "http");
define("CONF_URL_BASE", "https://7871-189-89-12-94.ngrok.io");
define("CONF_URL_TEST", "http://localhost");

// ### DATES ###
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

// ### VIEW ###
define("CONF_VIEW_THEME", "hyper");
define("CONF_VIEW_ASSETS", __DIR__ . "/../../public/assets");

// ### DESCRIPTION ###
define("CONF_SITE_LANG", "pt-BR");
define("CONF_SITE_DESCRIPTION", "pt-BR");
define("CONF_SITE_AUTHOR", "Iury Gomes de Oliveira");

// ### LOGS ###
define("CONF_ERROR_LOG", __DIR__ . "/../storage/errors/");


// ### DOTENV ###
define("CONF_DOTENV", "/var/www/html/");
