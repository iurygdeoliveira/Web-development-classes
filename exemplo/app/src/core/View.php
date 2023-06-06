<?php

declare(strict_types=1);

namespace src\core;

use League\Plates\Engine;
use League\Plates\Extension\Asset;
use League\Plates\Extension\URI;
use SebastiaanLuca\PipeOperator\Pipe;

class View
{

    private Engine $engine;

    public function __construct(string $basePath, string $controllerName)
    {
        $path = $this->viewPath($basePath, $controllerName);
        $this->engine = new Engine($path);
        $this->engine->loadExtension(new Asset(CONF_VIEW_ASSETS), true);
        return $this;
    }

    // Montar o caminho dos diretorios para a view
    private function viewPath(string $basePath, string $controllerName): string
    {

        $name = PIPE::from($controllerName)
            ->explode('\\', PIPED_VALUE)
            ->end()
            ->get();

        return
            $basePath .
            DIRECTORY_SEPARATOR .
            '..' .
            DIRECTORY_SEPARATOR .
            'views' .
            DIRECTORY_SEPARATOR .
            CONF_VIEW_THEME .
            DIRECTORY_SEPARATOR .
            $name;
    }

    public function add(string $name, string $directory): View
    {
        $this->engine->addFolder($name, $directory, true);
        return $this;
    }

    public function addData(array $data, string $template): View
    {
        $this->engine->addData($data, $template);
        return $this;
    }

    public function make(string $templateName)
    {
        return $this->engine->make($templateName);
    }

    public function render(string $templateName, array $data): string
    {
        return $this->engine->render($templateName, $data);
    }

    public function engine(): Engine
    {
        return $this->engine;
    }
}