<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Contributions';
$error_msg = '';
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
    $error_msg = "That listing doesn't exist";
} else {
    $database->query("UPDATE hardware SET views = views + 1 WHERE id = ?", [$id]);
}

$hardwareListing = $database->query('SELECT * FROM hardware WHERE id = ?;', [$id])[0];

?>

<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head', ['title' => $title]) ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main class="contribution_page">
            <?php if ($error_msg): ?>
                <h1><?= $error_msg ?></h1>
            <?php elseif ($hardwareListing): ?>
                <section class="contribution_content">
                    <h1>Contribution: <?= $hardwareListing['name'] ?></h1>
                    <section class="contribution_meta-data">
                        <img src="<?= $hardwareListing['image_url'] ?>" alt="<?= $hardwareListing['name'] ?>">
                        <div>
                            <p><?= $hardwareListing['type'] ?></p>
                            <p><?= $hardwareListing['manufacturer'] ?></p>
                            <p><?= ucwords(str_replace('_', ' ', $hardwareListing['status'])) ?></p>
                            <p><?= $hardwareListing['price_at_release'] ?></p>
                            <p>Release Date: <?= $hardwareListing['release_date'] ?></p>
                            <p><?= nl2br($hardwareListing['summary']) ?></p>
                        </div>
                    </section>
                    <section class="contribution_info">
                        <p><?= nl2br($hardwareListing['details']) ?></p>
                    </section>
                </section>
            <?php else: ?>
                <h1 class="not-exist">That listing doesn't exist</h1>
            <?php endif ?>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>