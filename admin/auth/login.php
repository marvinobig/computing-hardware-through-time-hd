<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Admin Login';

if (Utilities::guard()) {
    Utilities::redirect('admin/dashboard.php', 303);
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head') ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main id="login_page">
            <section class="login_form_container">
                <h1>Admin Login</h1>
                <form id='login_form' action="/api/log-user.php" method="post">
                    <label for="username">Username
                        <input required type="text" id="username" name="username">
                    </label>
                    <label for="password">Password
                        <input required type="password" id="password" name="password">
                    </label>
                    <button type="submit" class="btn">Login</button>
                </form>
            </section>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>