<?php

namespace App\Application;

use App\Application\Auth\Auth;
use App\Application\Config\Config;
use App\Application\Router\Route;
use App\Application\Router\Router;
use App\Application\views\View;
use App\Exceptions\ComponentNotFoundException;
use App\Exceptions\ViewNotFoundException;

class App
{
    public function run(): void
    {
        try {
            $this->handle();
        } catch (ViewNotFoundException|ComponentNotFoundException|\PDOException $e) {
            if (Config::get('app.debug')) {
                View::exception($e);
            } else {
                View::error(500);
            }
        }

    }

    private function handle(): void
    {
        Config::init();
        require_once __DIR__ . "/../../Route/pages.php";
        require_once __DIR__ . "/../../Route/actions.php";
// создается роутер который обрабатывает весь этот список
        $router = new Router();
        Auth::init();
        $router->handle(Route::lits());
    }
}
