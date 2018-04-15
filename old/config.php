<?php
// setting output buffer
ob_start();

// Error handling
// display errors
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

// Turn off register globals
// PHP 5.3(sha3'ala mo2ktan), PHP 5.4(removed)
ini_set('register_globals', 0);

// Define App Constants
// Shorcuts
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
// Domain Constants
define('HOST_NAME', $_SERVER['HTTP_HOST']);
echo HOST_NAME;
define('CSS_DIR', HOST_NAME . '/css');

// Paths
define('APP_PATH', realpath(dirname(_FILE_)) . DS);
//define('TEMPLATE_PATH', APP_PATH . '_t');

// Database Credentials
define('DB_HOST' ,'localhost');
define('DB_NAME', 'nefertari');
define('DB_USER', 'root');
define('DB_PASS', '');

require_once (APP_PATH . 'db/trial-database.php');
$dbh = Database::getInstance();

// Call template
// require_once('trial-header.php');
// require_once('trial-footer.php');
require_once(APP_PATH . 'classes\template.php');
$obj = new template();
$obj->setCSS();
// $dir = opendir(APP_PATH . 'classes');
// echo readdir($dir);

// while ($file = readdir($dir)) {

// 	echo $file . '</br>';
// }
// Include config.php inside index.php

//End buffer and send output
ob_flush();
?>