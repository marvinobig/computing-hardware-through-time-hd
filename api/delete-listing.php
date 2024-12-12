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
$username = $_SESSION['user']['username'];

if (!$id) {
    Utilities::sendJson(400);
}

$imageToDelete = $database->query("SELECT * FROM hardware WHERE id = ?", [$id])[0];

if (file_exists(__DIR__ . $imageToDelete['image_url'])) {
    unlink(__DIR__ . $imageToDelete['image_url']);
}

$response = $database->query('DELETE FROM hardware WHERE id = ? AND user_id = ?', [$id, $userId]);

if ($response < 1) {
    Utilities::sendJson(400);
} else {
    $database->query('INSERT INTO user_activity (admin_username, action_type, hardware_name) VALUES (?, ?, ?)', [$username, 'delete', $imageToDelete['name']]);

    Utilities::sendJson(204);
}
