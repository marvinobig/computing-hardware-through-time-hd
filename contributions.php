<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Contributions';

$hardwareListings = $database->query('SELECT * FROM hardware;');

?>

<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head') ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <h1>Contributions</h1>

            <?php foreach ($hardwareListings as $hardware): ?>
                <a href="/contribution.php?id=<?= $hardware['id'] ?>">
                    <article>
                        <img src="<?= $hardware['image_url'] ?>" alt="<?= $hardware['name'] ?>">
                        <div>
                            <h3><?= $hardware['name'] ?></h3>
                            <p><?= nl2br($hardware['summary'])  ?></p>
                            <div>
                                <p><?= $hardware['status'] ?></p>
                                <p>Release Date: <?= nl2br($hardware['release_date']) ?></p>
                            </div>
                        </div>
                    </article>
                </a>
            <?php endforeach; ?>
        </main>
    </body>

</html>