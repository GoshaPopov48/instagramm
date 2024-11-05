<?php
// создаем конфиг для подключения файлов путем классов
namespace App\Application\Config;
//подключаем класс композера который упрощает обращение к массивам
use Codin\Dot\Dot;

// создаем класс
class Config implements ConfigInterface
{
    //создаем метод для фильтрации массива дабы оставить только файлы
    public const IGNORE_FILES = ['..', '.'];

//создаем массив что бы упаковать в него папку config
    public static array $config;

    public static function get(string $key): mixed
    {
        // с помощью компосера соз
        $dot = new Dot(self::$config);
        return $dot->get($key);
    }

//создаем метот который будет читать этот массив конфиг
    public static function init(): void
    {
        // фильтруем файлы дабы убрать из массива данные типа ".."
        $path = __DIR__ . "/../../../config";
        $files = scandir($path);
        $files = array_filter($files, function ($file) {
            return !in_array($file, self::IGNORE_FILES);
        });
        foreach ($files as $file) {
            $data = include "$path/$file";
            //делаем проверку файлов что бы он содержал массив иначе помещаться в конфиг не будет
            if (is_array($data)) {
                self::$config[basename($file, '.php')] = $data;

            }

        }
    }
}
