<?php

namespace App\Application\Auth;

use App\Application\Config\Config;
use App\Application\Database\Model;

class Auth implements AuthInterface
{
    protected static $model;
    protected static $user;
    protected static ?string $token;
    protected static string $tokenColumn;

// метод инициализации пользователя
    public static function init(): void
    {
        $model = Config::get('auth.model');
        self::$tokenColumn = Config::get('auth.token_column');
        self::$model = new $model();
        self::$token = $_COOKIE[self::$tokenColumn] ?? NULL;
    }

    //метод проверяет Авторизирован пользователь  или нет
    public static function check(): bool
    {
        self::$user = self::$model->find(self::$tokenColumn, self::$token);
        return (bool)self::$user;
    }

// метод который будет возвращать инфу о пользователе, если он авторизирован
    public static function user(): Model
    {
        return self::$user ?? self::$model->find(self::$tokenColumn, self::$token);
    }

//  гетер токена
    public static function getTokenColumn(): string
    {
        return self::$tokenColumn;
    }

    public static function id(): ?int
    {
        self::check();
        return self::$user->id();
    }
}