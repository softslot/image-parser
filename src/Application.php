<?php

namespace App;

class Application
{
    private array $routes = [];

    public function get(string $route, callable $handler): void
    {
        $this->append('GET', $route, $handler);
    }

    public function post(string $route, callable $handler): void
    {
        $this->append('POST', $route, $handler);
    }

    public function append(string $method, string $route, callable $handler): void
    {
        $this->routes[] = [$method, $route, $handler];
    }

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $item) {
            [$handlerMethod, $route, $handler] = $item;

            if ($handlerMethod === $method && $this->isUriEqualRoute($route, $uri)) {
                echo $handler();
                return;
            }
        };
    }

    private function isUriEqualRoute(string $route, string $uri): bool
    {
        $preparedRoute = preg_quote($route, '/');

        return preg_match("/^{$preparedRoute}$/i", $uri);
    }
}
