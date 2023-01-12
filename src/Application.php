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
            $matches = $this->getMatchesFromUri($route, $uri);

            if ($handlerMethod === $method && count($matches) > 0) {
                $arguments = array_filter($matches, fn ($key) => is_string($key), ARRAY_FILTER_USE_KEY);

                echo $handler($_GET, $arguments);
                return;
            }
        };
    }

    private function getMatchesFromUri(string $route, string $uri): array
    {
        $matches = [];
        preg_match("/^{$this->getPreparedRoute($route)}$/i", $uri, $matches);

        return $matches;
    }

    private function getPreparedRoute(string $route): string
    {
        return str_replace('/', '\/', $route);
    }
}
