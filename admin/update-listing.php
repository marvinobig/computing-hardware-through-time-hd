<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
    Utilities::redirect('admin/dashboard.php', 302);
}

$listing = $database->query("SELECT * FROM hardware WHERE id = ?", [$id])[0];

if (!$listing) {
    Utilities::redirect('admin/dashboard.php', 302);
}

$title = 'Update ' . $listing['name'] . ' listing';
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head', ['title' => $title]) ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <h1>Update <?= $listing['name'] ?> listing</h1>            
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>
</html>