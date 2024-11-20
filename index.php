<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

$title = 'Homepage';
$database->createTables('chtt_db.sql');
$hardwareListings = $database->query('SELECT * FROM hardware;');
?>

<!DOCTYPE html>
<html lang="en">
    <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.partial.php' ?>

    <body>
        <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'nav.partial.php' ?>

        <main>
            <h1>Homepage</h1>
    
            <?php var_dump($hardwareListings) ?>
        </main>
    </body>

</html>