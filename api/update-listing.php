<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$listingId = filter_var($_GET['id'], FILTER_VALIDATE_FLOAT);

if (!$listingId) {
    Utilities::redirect('admin/update-listing.php?id=' . $listingId, 302);
}

try {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageFileName = uniqid() . '_' . str_replace(' ', '_', $_FILES['image']['name']);
        $imageFileTmpName = $_FILES['image']['tmp_name'];
        $imageFileSize = $_FILES['image']['size'];
        $imageFileType = $_FILES['image']['type'];

        $imageTargetDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "hardware_image_uploads" . DIRECTORY_SEPARATOR;
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($imageFileType, $allowedImageTypes)) {
            Utilities::redirect('admin/update-listing.php?id=' . $listingId, 302);
        }

        if ($imageFileSize > 5000000) {
            Utilities::redirect('admin/update-listing.php?id=' . $listingId, 302);
        }

        if (!move_uploaded_file($imageFileTmpName, $imageTargetDir . basename($imageFileName))) {
            throw new Exception("Failed to upload image.");
        }

        $imageToDelete = $database->query('SELECT image_url FROM hardware WHERE id = ?', [$listingId])[0]['image_url'];

        if (file_exists(__DIR__ . $imageToDelete)) {
            unlink(__DIR__ . $imageToDelete);
        }

        $dbResponse = $database->query(
            'UPDATE hardware
             SET 
                 image_url = ?,
                 name = ?,
                 type = ?,
                 manufacturer = ?,
                 summary = ?,
                 details = ?,
                 price_at_release = ?,
                 status = ?,
                 user_id = ?,
                 release_date = ?
             WHERE id = ?',
            [
                str_replace(__DIR__, '', $imageTargetDir) . $imageFileName,
                $_POST['hardware_name'],
                $_POST['hardware_type'],
                $_POST['manufacturer'],
                $_POST['summary'],
                $_POST['details'],
                $_POST['price_at_release'],
                $_POST['status'],
                2, // Replace this with the actual user ID
                $_POST['release_date'],
                $listingId,
            ]
        );

        if ($dbResponse) {
            Utilities::redirect('admin/dashboard.php', 303);
        }
    } else {
        $dbResponse = $database->query(
            'UPDATE hardware
             SET 
                 name = ?,
                 type = ?,
                 manufacturer = ?,
                 summary = ?,
                 details = ?,
                 price_at_release = ?,
                 status = ?,
                 user_id = ?,
                 release_date = ?
             WHERE id = ?',
            [
                $_POST['hardware_name'],
                $_POST['hardware_type'],
                $_POST['manufacturer'],
                $_POST['summary'],
                $_POST['details'],
                $_POST['price_at_release'],
                $_POST['status'],
                2, // Replace this with the actual user ID
                $_POST['release_date'],
                $listingId,
            ]
        );

        if ($dbResponse) {
            Utilities::redirect('admin/dashboard.php', 303);
        }
    }
} catch (Exception $e) {
    echo "Error updating listing: " . $e->getMessage();
    Utilities::redirect('admin/update-listing.php?id=' . $listingId, 302);
}
