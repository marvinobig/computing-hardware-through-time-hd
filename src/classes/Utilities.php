<?php

class Utilities
{
    public static function loadPartial(string $file): void
    {
        try {
            $sep = DIRECTORY_SEPARATOR;

            $filePath = __DIR__ . $sep . '..' . $sep . 'partials' . $sep . "$file.partial.php";

            if (!file_exists($filePath)) {
                throw new RuntimeException("Partial File Not Found: $filePath");
            }

            require_once $filePath;
        } catch (Exception $err) {
            echo "Partial File Error: {$err->getMessage()}";
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