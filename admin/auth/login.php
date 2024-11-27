<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Admin Login';
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head') ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <h1>Admin Login</h1>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>