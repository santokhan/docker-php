<?php

class Router
{
    private array $routes = [];
    private string $prefix = '';

    public function group(string $prefix, callable $callback): void
    {
        $previousPrefix = $this->prefix;
        $this->prefix .= rtrim($prefix, '/');

        $callback($this);

        $this->prefix = $previousPrefix;
    }

    public function get(string $route, callable $handler): void
    {
        $this->addRoute('GET', $route, $handler);
    }

    private function addRoute(string $method, string $route, callable $handler): void
    {
        $route = $this->prefix . $route;

        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'handler' => $handler
        ];
    }

    public function dispatch(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestUri = rtrim($requestUri, '/') ?: '/';

        foreach ($this->routes as $route) {

            $pattern = $this->convertRouteToRegex($route['route']);

            if (preg_match($pattern, $requestUri, $matches)) {

                array_shift($matches); // remove full match

                call_user_func_array($route['handler'], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function convertRouteToRegex(string $route): string
    {
        // convert /blogs/:slug → regex
        $route = preg_replace('#:([\w]+)#', '([a-zA-Z0-9\-]+)', $route);

        return '#^' . $route . '$#';
    }
}