<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$listingId = filter_var($_GET['id'], FILTER_VALIDATE_FLOAT);

if (!$listingId) {
    Utilities::redirect();
}

if (isset($_FILES['image'])) {
    if ($_FILES['image']['error'] == 0) {
        $imageFileName = uniqid() . '_' . str_replace(' ', '_', $_FILES['image']['name']);
        $imageFileTmpName = $_FILES['image']['tmp_name'];
        $imageFileSize = $_FILES['image']['size'];
        $imageFileType = $_FILES['image']['type'];

        $imageTargetDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "hardware_image_uploads" . DIRECTORY_SEPARATOR;

        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($imageFileType, $allowedImageTypes)) {
            Utilities::redirect();
        }

        if ($imageFileSize > 5000000) {
            Utilities::redirect();
        }

        $database->query('UPDATE hardware
            SET 
                image_url = ?,
                name = ?,
                hardware_type = ?,
                manufacturer = ?,
                summary = ?,
                details = ?,
                price_at_release = ?,
                status = ?,
                release_date = ?",
                image = ? 
            WHERE id = ?', [
            str_replace(__DIR__, '', $imageTargetDir) . $imageFileName,
            $_POST['hardware_name'],
            $_POST['hardware_type'],
            $_POST['manufacturer'],
            $_POST['summary'],
            $_POST['details'],
            $_POST['price_at_release'],
            $_POST['status'],
            2,
            $_POST['release_date'],
            $listingId
        ]);

        Utilities::redirect();
    }
} else {
    $database->query('UPDATE hardware
            SET 
                name = ?,
                hardware_type = ?,
                manufacturer = ?,
                summary = ?,
                details = ?,
                price_at_release = ?,
                status = ?,
                release_date = ?",
                image = ? 
            WHERE id = ?', [
        $_POST['hardware_name'],
        $_POST['hardware_type'],
        $_POST['manufacturer'],
        $_POST['summary'],
        $_POST['details'],
        $_POST['price_at_release'],
        $_POST['status'],
        2,
        $_POST['release_date'],
        $listingId
    ]);

    Utilities::redirect();
}

