<?php

declare(strict_types=1);

namespace src\core;

class Controller
{
    protected function dataTheme(string $page = ''): array
    {

        return [
            'title' => "$page | Exemplo"
        ];
    }

}