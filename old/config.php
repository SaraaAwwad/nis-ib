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
define('CSS_DIR', 'css' . DS);
define('JS_DIR', 'js' . DS);
// Paths
define('APP_PATH', realpath(dirname(_FILE_)) . DS);
define('CSS_PATH', APP_PATH . 'css' . DS);
define('JS_PATH', APP_PATH. 'js' . DS);
//define('TEMPLATE_PATH', APP_PATH . '_t');

// Database Credentials
define('DB_HOST' ,'localhost');
define('DB_NAME', 'nefertari');
define('DB_USER', 'root');
define('DB_PASS', '');

require_once (APP_PATH . 'db/trial-database.php');
$dbh = Database::getInstance();

// Call template
require_once(APP_PATH . 'classes\template.php');
$obj = new template();
$obj->setPage();
echo '</body></html>';

//End buffer and send output
ob_flush();
?>