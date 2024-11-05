<?php

namespace App\Application\views;

use App\Application\Config\Config;
use App\Exceptions\ComponentNotFoundException;
use App\Exceptions\ViewNotFoundException;

class View implements ViewInterface
{

    /**
     * @throws ViewNotFoundException
     */
    public static function show(string $view, array $params = []): void
    {
        extract($params);
        // создали медот, который принимает в значение адрес страницы
        $path = __DIR__ . "/../../../views/$view.view.php";
        if (!file_exists($path)) {
           throw new ViewNotFoundException("View ($view) not found");
        }
        include $path;
    }
// создаем метод для вывода красивой ошибки
    public static function exception(\Exception $e): void
    {
        extract([
            'message' => $e->getMessage(),
            'trace'=> $e->getTraceAsString()
        ]);
        $path = __DIR__ . "/../../../views/" . Config::get('app.exception_view') . ".view.php";

        // если файл эксептионн не существует, то пишем условия с выводом обычной ошибкой
        if (!file_exists($path)) {
            echo $e->getMessage() . "<br><hr>";
            echo "<pre>{$e->getTraceAsString()}</pre>";
            return;
        }
        include $path;
    }

    public static function component(string $component): void
    {
        $path = __DIR__ . "/../../../views/component/$component.component.php";
        if (!file_exists($path)) {
            throw new ComponentNotFoundException("Component ($component) not found");
        }
        include $path;
    }

    public static function error(string $code): void
    {
        $path = __DIR__ . "/../../../views/app/errors/$code.view.php";

        include $path;
    }
}