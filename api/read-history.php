<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$history = $database->query('SELECT * FROM user_activity');

Utilities::sendJson(200, ['history' => $history]);
