<?php

namespace App\Application\Router;

interface RouteInterface
{
    public static function page(string $uri, string $controller, string $method, string|array $middleweare =[]): void;

    public static function post(string $uri, string $controller, string $method): void;
    public static function lits(): array;

}