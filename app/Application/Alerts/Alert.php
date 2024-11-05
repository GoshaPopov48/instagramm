<?php

namespace App\Application\Alerts;
class Alert implements AlertInterface
{
    public const DANGER = 'danger';
    public const SUCCESS = 'success';

    public static function storeMessage(string $message, string $type = 'danger'): void
    {
        setcookie("message.$type", $message);
    }

    public static function success(bool $clear = false): ?string
    {
        $message = $_COOKIE['message_' . self::SUCCESS] ?? null;
        if ($clear) {
//            unset($_COOKIE['message_' . self::SUCCESS]);
            setcookie('message_' . self::SUCCESS, null);
        }

        return $message;
    }

    public static function danger(bool $clear = false): ?string
    {
        $message = $_COOKIE['message_' . self::DANGER] ?? null;
        if ($clear) {
//            unset($_COOKIE['message_danger']);
            setcookie('message_' . self::DANGER, null);
        }
        return $message;
    }
}