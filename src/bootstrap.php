<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_set_cookie_params(1800);
session_start();

use Data\Database;

$database = new Database('mysql', 'chtt_db', 3306, 'chtt_db', 'chtt_user', 'chtt_user_pass');