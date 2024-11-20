<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

use Database;
use Utilities;

$database = new Database('mysql', '127.0.0.1', 6033, 'ctt_db', 'ctt_user', 'ctt_user_pass');