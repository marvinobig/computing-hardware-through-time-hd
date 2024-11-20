<?php

class Utilities
{
    public static function partial(string $file, string $searchFrom = 'root'): string|null
    {
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

    public static function sendJson(int $responseCode, array $response): void
    {
        try {
            $json = json_encode($response);

            if ($json === false) {
                throw new Exception("Error sending JSON response: " . json_last_error_msg());
            }

            header('Content-Type: application/json');
            http_response_code($responseCode);
            echo $json;

            exit;
        } catch (Exception $err) {
            header('Content-Type: application/json');
            http_response_code($responseCode);
            echo json_encode([
                'error' => $err->getMessage(),
            ]);

            exit;
        }
    }
}