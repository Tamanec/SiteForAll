<?php

namespace Den;

/**
 * Автозагрузчик классов
 *
 * @package Den
 */
class Autoloader {

    /**
     * @var string Путь до папки с классами
     */
    public $paths = "";

    /**
     * Регистрирует метод загрузки
     *
     * @param array $paths Пути до папок с классами
     */
    public function __construct($paths) {
        $this->paths = $paths;
        spl_autoload_register(array($this, 'load'));
    }

    /**
     * Загружает классы в соответствии с PSR-0
     *
     * @param $className Полное имя класса
     */
    public function load($className) {
        foreach ($this->paths as $path) {
            $fullFileName = $path . DIRECTORY_SEPARATOR . str_replace('\\', '/', $className) . '.php';
            if (file_exists($fullFileName)) {
                require $fullFileName;
                break;
            }
        }
    }

}