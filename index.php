<?php
//namespace PHPMVC;
use PHPMVC\LIB\FrontController;

if(!defined('DS')){
  define('DS', DIRECTORY_SEPARATOR);   
}

require_once 'app' . DIRECTORY_SEPARATOR . 'config.php';
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php'; 


$frontController = new FrontController();
$frontController->dispatch();