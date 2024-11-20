<?php

class Utilities {
    public static function partial(string $file, string $searchFrom = 'root'):  string|null {
        try {
            $sep = DIRECTORY_SEPARATOR;

            switch ($searchFrom) {
                case "root":
                    return require_once __DIR__ . $sep . '..' . $sep . 'partials' . $sep . "$file.partial.php";
                    
                case "admin":
                    return require_once __DIR__ . $sep . '..' . $sep . '..' . $sep . 'partials' . $sep . 'nav.partial.php';
                default:
                    return "Directory to search from doesn't exist";     
            }
        } catch (Exception $err) {
            return "File Error: {$err->getMessage()}";
        }
    }
}