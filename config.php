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
//define('APP_PATH', );




//End buffer and send output
ob_flush();
?>