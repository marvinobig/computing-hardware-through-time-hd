<?php 

require_once __DIR__ . DIRECTORY_SEPARATOR . "Classes" . DIRECTORY_SEPARATOR . "ClassLoader.php" ;

use CTT\Classes\ClassLoader;

$autoloader = new ClassLoader('src', '  Classes');
$autoloader->register();