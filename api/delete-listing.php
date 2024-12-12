<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

if (!Utilities::guard()) {
    Utilities::sendJson(403, [
        'msg' => 'You are not authorized to access this endpoint'
    ]);
}

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
$userId = $_SESSION['user']['user_id'];

if (!$id) {
    Utilities::sendJson(400);
}

$imageToDelete = $database->query("SELECT image_url FROM hardware WHERE id = ?", [$id])[0]['image_url'];

if (file_exists(__DIR__ . $imageToDelete)) {
    unlink(__DIR__ . $imageToDelete);
}

$response = $database->query('DELETE FROM hardware WHERE id = ? AND user_id = ?', [$id, $userId]);

if ($response < 1) {
    Utilities::sendJson(400);
} else {
    Utilities::sendJson(204);
}
