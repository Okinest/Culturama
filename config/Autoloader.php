<?php

final readonly class Autoloader
{
    public static function register(){
        spl_autoload_register(function ($class) {
            $path = str_replace('\\', '/', $class) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
        });
    }
}
Autoloader::register();