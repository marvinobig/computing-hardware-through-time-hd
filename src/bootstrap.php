<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

session_set_cookie_params(1800);
session_start();

use Data\Database;

$database = new Database('mysql', '127.0.0.1', 6033, 'chtt_db', 'chtt_user', 'chtt_user_pass');