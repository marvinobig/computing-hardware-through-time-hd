<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$hardwareListings = $database->query('SELECT * FROM hardware');

Utilities::sendJson(200, ['listings' => $hardwareListings]);
