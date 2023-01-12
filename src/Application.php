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
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $item) {
            [$handlerMethod, $route, $handler] = $item;
            $preparedRoute = str_replace('/', '\/', $route);
            $matches = [];

            if ($handlerMethod === $method && preg_match("/^{$preparedRoute}$/i", $uri, $matches)) {
                $arguments = array_filter($matches, function ($key) {
                    return is_string($key);
                }, ARRAY_FILTER_USE_KEY);
                
                echo $handler($_GET, $arguments);
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
