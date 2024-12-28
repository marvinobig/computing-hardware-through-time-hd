<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Contributions';

$hardwareListings = $database->query('SELECT * FROM hardware;');

if ($_GET['search']) {
    $search = $_GET['search'];

    $hardwareListings = array_filter($hardwareListings, function ($listing) use ($search) {
        if (str_contains($listing['name'], $search)) {
            return $listing;
        }
    });
}

if ($_GET['year-from'] && $_GET['year-from'] !== 'none') {
    $yearFrom = (int) $_GET['year-from'];

    $hardwareListings = array_filter($hardwareListings, function ($listing) use ($yearFrom) {
        $releaseDate = (int) date('Y', strtotime($listing['release_date']));

        if ($releaseDate >= $yearFrom) {
            return $listing;
        }
    });
}

if ($_GET['year-to'] && $_GET['year-to'] !== 'none') {
    $yearFrom = (int) $_GET['year-to'];

    $hardwareListings = array_filter($hardwareListings, function ($listing) use ($yearFrom) {
        $releaseDate = (int) date('Y', strtotime($listing['release_date']));

        if ($releaseDate <= $yearFrom) {
            return $listing;
        }
    });
}

if ($_GET['type'] && $_GET['type'] !== 'none') {
    $type = $_GET['type'];

    $hardwareListings = array_filter($hardwareListings, function ($listing) use ($type) {
        if ($listing['type'] === $type) {
            return $listing;
        }
    });
}

if ($_GET['status'] && $_GET['status'] !== 'none') {
    $status = $_GET['status'];

    $hardwareListings = array_filter($hardwareListings, function ($listing) use ($status) {
        if ($listing['status'] === $status) {
            return $listing;
        }
    });
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head', ['title' => $title]) ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <header id="contributions_header">
                <div class="content">
                    <?php Utilities::loadPartial('filter-form', ['database' => $database]) ?>
                    <?php Utilities::loadPartial('search') ?>
                </div>
            </header>

            <section class="card_container">
                <?php if ($hardwareListings): ?>
                    <?php foreach ($hardwareListings as $hardware): ?>
                        <a href="/contribution.php?id=<?= $hardware['id'] ?>">
                            <article class="contribution_card">
                                <img src="<?= $hardware['image_url'] ?>" alt="<?= $hardware['name'] ?>">
                                <div class="card_content">
                                    <h3><?= $hardware['name'] ?></h3>
                                    <p><?= nl2br($hardware['summary']) ?></p>
                                    <div class="tags_container">
                                        <p class="tags"><?= ucwords(str_replace('_', ' ', $hardware['status'])) ?></p>
                                        <p class="tags"><?= date("d-m-Y", strtotime(nl2br($hardware['release_date']))) ?></p>
                                    </div>
                                </div>
                            </article>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 class="not-exist">Nothing to display</h2>
                <?php endif ?>
            </section>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>