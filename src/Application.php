<?php

namespace App;

class Application
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $item) {
            [$route, $handler] = $item;
            $preparedRoute = preg_quote($route, '/');

            if (preg_match("/^{$preparedRoute}$/i", $uri)) {
                echo $handler();
                return;
            }
        };
    }
}
