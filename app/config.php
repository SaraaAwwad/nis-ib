<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}

define('APP_PATH', realpath(dirname(__FILE__)));
define('VIEWS_PATH', APP_PATH . DS . 'views' . DS);
define('TEMPLATE_PATH', APP_PATH . DS . 'template' . DS);
define('HOME_TEMPLATE_PATH', APP_PATH . DS . 'hometemplate' . DS);

define('PUBLIC_PATH',  DS . 'public' . DS);

define('CSS', PUBLIC_PATH . 'css' . DS);
define('IMG', PUBLIC_PATH . 'images' . DS);
define('JS', PUBLIC_PATH. 'js' . DS);
define('FONTS',  PUBLIC_PATH. 'fonts' . DS);
define('CKEDITOR',  PUBLIC_PATH. 'ckeditor' . DS);

define('ASSETS_CSS',  PUBLIC_PATH. 'assets' . DS . 'css'. DS);
define('ASSETS_JS', PUBLIC_PATH . 'assets' . DS . 'js'. DS);
define('ASSETS_IMG', PUBLIC_PATH . 'assets' . DS . 'img'. DS);
define('ASSETS_FONTS',  PUBLIC_PATH . 'assets' . DS . 'fonts'. DS);
define('ASSETS_FONT_AWESOME',  PUBLIC_PATH . 'assets' . DS . 'font-awesome'. DS);
define('ASSETS_ICONS',  PUBLIC_PATH . 'assets' . DS. 'lineicons' . DS);

define('DB_HOST' ,'localhost');
define('DB_NAME', 'nefertari');
define('DB_USER', 'root');
define('DB_PASS', '');

#defined('SESSION_NAME')     ? null : define ('SESSION_NAME', '_NIS_SESSION');
#defined('SESSION_LIFE_TIME')     ? null : define ('SESSION_LIFE_TIME', 0);
#defined('SESSION_SAVE_PATH')     ? null : define ('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'sessions');

define('DOMAIN_NAME', '.nisib.example.com'); //change according to virtualhost
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);