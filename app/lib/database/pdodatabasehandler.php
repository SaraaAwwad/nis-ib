<?php
namespace PHPMVC\Lib\Database;
class PDODatabaseHandler extends DatabaseHandler
{
    private static $_instance;
    private static $_handler;
    private function __construct(){
        self::init();
    }
    public function __call($name, $arguments)
    {
        return call_user_func_array(array(&self::$_handler, $name), $arguments);
    }
    protected static function init()
    {
        try {
            self::$_handler = new \PDO(
                'mysql:hostname=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER, DB_PASS, array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                )
            );
        } catch (\PDOException $e) {
        }
    }
    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}