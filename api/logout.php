<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

if ($_SESSION['user']) {
    session_unset();
    session_destroy();
    
    Utilities::redirect('admin/auth/login.php', 303);
}