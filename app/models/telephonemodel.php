<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class TelephoneModel extends AbstractModel {

    public $id;
    public $user_id_fk;
    public $number;

    protected static $tableName = 'telephone';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'user_id_fk'          => self::DATA_TYPE_INT,
        'number'              => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';


    public static function getByUser($userk)
    {
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE user_id_fk = "' . $userk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if ($stmt->execute() === true) {
            if(method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        }
        return false;
    }

}
