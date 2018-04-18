<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);   
}

define('APP_PATH', realpath(dirname(__FILE__)));
define('VIEWS_PATH', APP_PATH . DS . 'views' . DS);
define('TEMPLATE_PATH', APP_PATH . DS . 'template' . DS);
define('HOME_TEMPLATE_PATH', APP_PATH . DS . 'hometemplate' . DS);

//define('PUBLIC_PATH', '..' . DS . 'public');

define('CSS', DS . 'public' . DS . 'css' . DS);
define('IMG', DS . 'public' . DS . 'images' . DS);
define('JS', DS . 'public' . DS . 'js' . DS);
define('FONTS', DS . 'public' . DS . 'fonts' . DS);

define('ASSETS_CSS', DS . 'public' . DS . 'assets' . DS . 'css'. DS);
define('ASSETS_JS', DS . 'public' . DS . 'assets' . DS . 'js'. DS);
define('ASSETS_IMG', DS . 'public' . DS . 'assets' . DS . 'img'. DS);
define('ASSETS_FONTS', DS . 'public' . DS . 'assets' . DS . 'fonts'. DS);
define('ASSETS_FONT_AWESOME', DS . 'public' . DS . 'assets' . DS . 'font-awesome'. DS);
define('ASSETS_ICONS', DS . 'public' . DS . 'assets' . DS. 'lineicons' . DS);



define('DB_HOST' ,'localhost');
define('DB_NAME', 'nefertari');
define('DB_USER', 'root');
define('DB_PASS', '');

#defined('SESSION_NAME')     ? null : define ('SESSION_NAME', '_NIS_SESSION');
#defined('SESSION_LIFE_TIME')     ? null : define ('SESSION_LIFE_TIME', 0);
#defined('SESSION_SAVE_PATH')     ? null : define ('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'sessions');

define('DOMAIN_NAME', '.nisib.example.com'); //change according to virtualhost
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);