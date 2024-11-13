<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . "/";
    $class = str_replace('\\', '/', $class);
    $file = $baseDir . $class . '.php';

    // Include the file if it exists
    if (file_exists($file)) {
        require_once $file;
    }
});