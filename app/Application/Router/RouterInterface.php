<?php

namespace App\Application\Router;
//создали классы в интерфейсе
interface RouterInterface
{
 public function handle(array $routes): void;
}