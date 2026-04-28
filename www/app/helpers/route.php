<?php

function request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return rtrim($path, '/') ?: '/';
}

function route_match(string $pattern, string $path, array &$matches = []): bool
{
    return (bool) preg_match($pattern, $path, $matches);
}

function abort(int $code = 404, string $message = 'Not Found'): void
{
    http_response_code($code);
    echo $message;
    exit;
}