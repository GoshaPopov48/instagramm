<?php

namespace App\Application\Router;
//создаем хеадер в отдельном файле
class Redirect implements RedirectInterface
{
    public static function to(string $route): void
    {
        header("location: $route");
        die();
    }
}