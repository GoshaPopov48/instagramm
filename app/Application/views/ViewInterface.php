<?php

namespace App\Application\views;

interface ViewInterface
{
    public static function show(string $view, array $params =[]): void;

    public static function exception(\Exception $e): void;
    public static function component(string $component): void;
    public static function error(string $code): void;

}