<?php

namespace App\Controllers;

use App\Application\Config\Config;
use App\Application\views\View;


class PsgesController
{

    public function index(): void
    {
        View::show('pages/index', [
            'title' => 'Главная - ' . Config::get('app.name'),
        ]);
    }

    public function login(): void
    {
        View::show('pages/login', [
            'title' => 'Вход - ' . Config::get('app.name'),
        ]);
    }

    public function registr(): void
    {
        View::show('pages/registr', [
            'title' => 'Регистрация - ' . Config::get('app.name'),
        ]);
    }

    public function profile(): void
    {
        View::show('pages/profile', [
            'title' => 'Профиль - ' . Config::get('app.name'),
            'pageTitle' => 'Профиль'
        ]);
    }
}