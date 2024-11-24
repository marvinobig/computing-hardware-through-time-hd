<?php

if (isset($_FILES['image'])) {
    if ($_FILES['image']['error'] == 0) {
        $imageFileName = uniqid() . '_' . str_replace(' ', '_', $_FILES['image']['name']);
        $imageFileTmpName = $_FILES['image']['tmp_name'];
        $imageFileSize = $_FILES['image']['size'];
        $imageFileType = $_FILES['image']['type'];

        $imageTargetDir = __DIR__ . DIRECTORY_SEPARATOR . "hardware_image_uploads" . DIRECTORY_SEPARATOR;

        if (!is_dir($imageTargetDir)) {
            mkdir($imageTargetDir, 0777, true);
        }

        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($imageFileType, $allowedImageTypes)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        } else if ($imageFileSize > 5000000) {
            echo "Sorry, your file is too large.";
        } else {
            if (move_uploaded_file($imageFileTmpName, $imageTargetDir . basename($imageFileName))) {
                echo "The file " . basename($imageFileName) . " has been uploaded successfully.";
            } else {
                echo "Sorry, there was an error uploading your main image.";
            }

            $database->query('INSERT INTO hardware (image_url, name, type, manufacturer, summary, details, price_at_release, status, user_id, release_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
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
            ]);
        }
    }
} else {
    echo "No file was uploaded or there was an error.";
}