<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";
$title = 'Dashboard';

use App\Utilities;

if (!Utilities::guard()) {
    Utilities::redirect('admin/auth/login.php', 303);
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head', ['title' => $title]) ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <header>
                <h1>Dashboard</h1>
                <h3>Welcome, <?= $_SESSION['user']['username'] ?>!</h3>
            </header>

            <?php Utilities::loadPartial('contributions-insert') ?>

            <section>
                <?php Utilities::loadPartial('listings-table', ['database' => $database]) ?>
                <?php Utilities::loadPartial('history-table', ['database' => $database]) ?>
            </section>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>