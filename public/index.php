<?php

require __DIR__ ."/../bootstrap.php";

use SciMuseum\Database;

$connection = new Database("local", "user", "password");

echo $connection->connectionDetails(); 