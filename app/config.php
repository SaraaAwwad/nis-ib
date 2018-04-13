<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);   
}

define('APP_PATH', realpath(dirname(__FILE__)));
define('VIEWS_PATH', APP_PATH . DS . 'views' . DS);
define('TEMPLATE_PATH', APP_PATH . DS . 'template' . DS);

define('DB_HOST' ,'localhost');
define('DB_NAME', 'nefertari');
define('DB_USER', 'root');
define('DB_PASS', '');
