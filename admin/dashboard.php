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

        <main class="admin_page">
            <header class="admin_header">
                <h1>Welcome to the dashboard, <?= $_SESSION['user']['username'] ?>!</h1>
                <?php Utilities::loadPartial('contributions-insert') ?>
            </header>
            <?php Utilities::loadPartial('listings-table', ['database' => $database]) ?>
            <?php Utilities::loadPartial('history-table', ['database' => $database]) ?>
        </main>
        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>