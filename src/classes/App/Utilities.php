<?php

namespace App;

use RuntimeException;
use Exception;

class Utilities
{
    public static function loadPartial(string $file, array $variables = []): void
    {
        try {
            $sep = DIRECTORY_SEPARATOR;

            $filePath = __DIR__ . $sep . '..' . $sep . '..' . $sep . 'partials' . $sep . "$file.partial.php";

            if (!file_exists($filePath)) {
                throw new RuntimeException("Partial File Not Found: $filePath" . '<br>');
            }

            extract($variables);

            require_once $filePath;
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    public static function sendJson(int $responseCode, array $response = []): void
    {
        try {
            $json = json_encode($response);

            if ($json === false) {
                throw new Exception("Error sending JSON response: " . json_last_error_msg());
            }

            header('Content-Type: application/json');
            http_response_code($responseCode);

            if ($response) {
                echo $json;
            }

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

    public static function redirect(string $path, int $statusCode = 400): void {
        header('Location: /' . $path, true, $statusCode);
        exit;
    }

    public static function guard() : bool {
        session_set_cookie_params(1800);
        session_start();

        if ($_SESSION['user']) {
            return true;
        }

        return false;
    }
}