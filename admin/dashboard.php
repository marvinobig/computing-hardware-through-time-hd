<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";
$title = 'Dashboard';

use App\Utilities;
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head') ?>

    <body>
        <?php Utilities::loadPartial('head') ?>

        <main>
            <h1>Dashboard</h1>

            <?php Utilities::loadPartial('contributions_insert') ?>
        </main>
    </body>

</html>