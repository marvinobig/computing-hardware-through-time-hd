<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'autoloader.php';

use classes\Database;

$database = new Database("local", "marvinobig", "12345")

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
    </head>

    <body>
        <h1>Hello world</h1>
        <?= $database->connectionDetails() ?>
    </body>

</html>