<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Admin Login';
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head') ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <h1>Admin Login</h1>
            <form id='login-form' action="/api/log-user.php" method="post">
                <section>
                    <label for="username">Username</label>
                    <input required type="text" id="username" name="username">
                </section>
                <section>
                    <label for="password">Password</label>
                    <input required type="password" id="password" name="password">
                </section>
                <section>
                    <button type="submit">Login</button>
                </section>
            </form>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>