<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

if (isset($_FILES['image']) && isset($_POST)) {
    if ($_FILES['image']['error'] == 0) {
        $imageFileName = uniqid() . '_' . str_replace(' ', '_', $_FILES['image']['name']);
        $imageFileTmpName = $_FILES['image']['tmp_name'];
        $imageFileSize = $_FILES['image']['size'];
        $imageFileType = $_FILES['image']['type'];

        $imageTargetDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR. "hardware_image_uploads" . DIRECTORY_SEPARATOR;

        if (!is_dir($imageTargetDir)) {
            mkdir($imageTargetDir, 0777, true);
        }

        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($imageFileType, $allowedImageTypes)) {
            Utilities::sendJson(400, [
                'msg' => 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed for the hardware image'
            ]);
        } else if ($imageFileSize > 5000000) {
            Utilities::sendJson(400, [
                'msg' => 'The hardware image file is too large'
            ]);
        } else {
            $dbResponse = $database->query('INSERT INTO hardware (image_url, name, type, manufacturer, summary, details, price_at_release, status, user_id, release_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                str_replace(__DIR__, '', $imageTargetDir) . $imageFileName,
                $_POST['hardware_name'],
                $_POST['hardware_type'],
                $_POST['manufacturer'],
                $_POST['summary'],
                $_POST['details'],
                $_POST['price_at_release'],
                $_POST['status'],
                1,
                $_POST['release_date']
            ], 'json');

            if ($dbResponse) {
                if (move_uploaded_file($imageFileTmpName, $imageTargetDir . basename($imageFileName))) {
                    Utilities::sendJson(201, [
                        'msg' => 'The hardware and its image has successfully been listed'
                    ]);
                }
            } else {
                Utilities::sendJson(400, [
                    'msg' => 'The hardware and its image has failed to be listed',
                    'data' => [
                        $_FILES['image'],
                        $_POST,
                    ]
                ]);
            }
        }
    }
} else {
    Utilities::sendJson(400, [
        'msg' => 'There is an error with the form used to send the data'
    ]);
}