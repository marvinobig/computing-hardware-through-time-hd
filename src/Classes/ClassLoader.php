<?php

namespace CTT\Classes;

final class ClassLoader {
    private string $baseClassDir;

    public function __construct(string $baseDir, string $classDir)
    {
        $this->baseClassDir = __DIR__ . DIRECTORY_SEPARATOR . $baseDir. DIRECTORY_SEPARATOR . $classDir . DIRECTORY_SEPARATOR;
    }
    
    public function register(): void
    {
        spl_autoload_register(function ($className) : void {
            $class = str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";

            echo $class . "<br>";

            $file = $this->baseClassDir . $class;

            echo $file;

            if (file_exists($file)) {
                require_once $file;
            }
        });
        
    }
}