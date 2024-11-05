<?php

namespace App\Application\Router;
//описываем интерфейс
class Route implements RouteInterface
{
    private static array $routes = [];

//создали метод, который принимает значения в массив
    public static function page(string $uri, string $controller, string $method, string|array $middleweare = []): void
    {
        self::$routes[] = [
            'uri' => $uri,
            'type' => 'page',
            'controller' => $controller,
            'method' => $method,
            'middleweare' => $middleweare
        ];
    }

    public static function post(string $uri, string $controller, string $method): void
    {
        self::$routes[] = [
            'uri' => $uri,
            'type' => 'post',
            'controller' => $controller,
            'method' => $method
        ];
    }

// создаем метод для сохранения списков Роутсов
    public static function lits(): array
    {
        return self::$routes;
    }

}