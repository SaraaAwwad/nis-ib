<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class DecoratorModel extends AbstractModel
{
    public $id;
    public $name;
    protected static $tableName = 'decorator';
    protected static $tableSchema = array(
        'id'            => self::DATA_TYPE_INT,
        'name'          => self::DATA_TYPE_VARCHAR
    );
    protected static $primaryKey = 'id';

    public static function getAll(){

        return self::getArr('SELECT * FROM' . self::$tableName );
    }

}
?>