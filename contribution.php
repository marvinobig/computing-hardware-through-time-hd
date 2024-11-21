<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

$title = 'Contributions';
$error_msg = '';
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
    $error_msg = "That listing doesn't exist";
}

$hardwareListing = $database->query('SELECT * FROM hardware WHERE id = ?;', [$id])[0];

if ($hardwareListing === []) {
    $error_msg = "That listing doesn't exist";
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head') ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <?php if ($error_msg): ?>
                <h1><?= $error_msg ?></h1>
            <?php else: ?>
                <h1>Contributions: <?= $hardwareListing['name'] ?></h1>
                <section>
                    <img src="<?= $hardwareListing['image_url'] ?>" alt="<?= $hardwareListing['name'] ?>">
                    <div>
                        <p><?= $hardwareListing['type'] ?></p>
                        <p><?= $hardwareListing['Manufacturer'] ?></p>
                        <p><?= $hardwareListing['status'] ?></p>
                        <p>Release Date: <?= $hardwareListing['release_date'] ?></p>
                        <p><?= nl2br($hardwareListing['summary']) ?></p>
                    </div>
                </section>
                <section>
                    <p><?= nl2br($hardwareListing['details']) ?></p>
                </section>
            <?php endif ?>
        </main>
    </body>

</html>