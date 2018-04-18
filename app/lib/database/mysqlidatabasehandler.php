<?php
namespace PHPMVC\Lib\Database;
class MySQLiDatabaseHandler extends DatabaseHandler
{
    private static $_handler;
    private function __construct(){
        self::init();
    }
    protected static function init()
    {
        try {
            self::$_handler = new PDO(
                'mysql://hostname=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER, DB_PASS
            );
        } catch (PDOException $e) {
        }
    }
    public static function getInstance()
    {
        if(self::$_handler === null) {
            self::$_handler = new self();
        }
        return self::$_handler;
    }
    public function prepare()
    {
    }
}