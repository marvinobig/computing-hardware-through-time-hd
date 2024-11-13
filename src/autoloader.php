<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = $baseDir . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});