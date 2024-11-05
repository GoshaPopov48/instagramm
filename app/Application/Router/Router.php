<?php

namespace App\Application\Router;

use App\Application\views\View;

class Router implements RouterInterface
{
    use RouterHelper;

    public function handle(array $routes): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $type = $requestMethod === 'POST' ? 'post' : 'page';

        $filterRoutes = self::filter($routes, $type);
        foreach ($filterRoutes as $route) {
            if ($route['uri'] === $uri) {
                if (!empty($route['middleweare'])) {
                    $middleweare = new $route['middleweare']();
                    $middleweare->handle();
                }
                self::controller($route);
                return;
            }

        }
        View::error(404);
    }

}