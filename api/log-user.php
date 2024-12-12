<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

if (isset($_POST['username']) && isset($_POST['password'])) {
    session_set_cookie_params(1800);
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $dbUser = $database->query('SELECT * FROM admin_users WHERE username = ?', [$username])[0];

    if (!$dbUser) {
        Utilities::redirect('admin/auth/login.php', 303);
    }

    if (password_verify($password, $dbUser['password_hash'])) {
        $_SESSION['user'] = [
            'user_id' => $dbUser['id'],
            'username'=> $username,
        ];

        Utilities::redirect('admin/dashboard.php',303);
    } else {
        Utilities::redirect('admin/auth/login.php', 303);
    }
} else {
    Utilities::redirect('admin/auth/login.php', 303);
}