<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

if (!$id) {
    Utilities::sendJson(400,['msg' => 'Listing could not be found']);
}

$response = $database->query('DELETE FROM hardware WHERE id = ?', [$id]);

if ($response < 1) {
    Utilities::sendJson(400,['msg'=> 'Listing has not been deleted']);
} else {
    Utilities::sendJson(204, ['msg' => 'Listing has been deleted']);
}
