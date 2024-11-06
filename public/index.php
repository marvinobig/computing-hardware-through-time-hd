<?php

require __DIR__ . "/../bootstrap.php";

use SciMuseum\Database;

$request = $_SERVER['REQUEST_URI'];
$connection = new Database("local", "user", "password");


switch ($request) {
    case '/':
    case '':
        echo $connection->connectionDetails();
        echo "<h1>Hello world</h1>";
        break;
    case "/admin":
        echo "<h1>Admin page</h1>";
        break;
    default:
        # code...
        break;
}