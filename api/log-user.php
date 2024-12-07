<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

if (isset($_POST)) {
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $dbUser = $database->query('SELECT * FROM admin_users WHERE username = ?', [$username]);

    var_dump($username, $password);
}