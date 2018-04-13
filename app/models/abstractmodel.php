<?php
namespace PHPMVC\Models;
use PHPMVC\LIB\DATABASE\DatabaseHandler;

class AbstractModel{

    /*
    const DATA_TYPE_BOOL = PDO::PARAM_BOOL;
    const DATA_TYPE_STR = PDO::PARAM_STR;
    const DATA_TYPE_INT = PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;

    private function prepareValues( PDOStatement &$stmt, $schema){
       foreach (static::$tableSchema as $columnName => $type){
           
       } 
    }
    private static function buildParams(){
        $namedParams ='';
        foreach(static::$tableSchema as $columnName => $type){
            $namedParams .= $columnName . '= :' . $columnName . ', ';
        }
        trim($namedParams, ', ');

        return $namedParams;
    }

    public static function create(){
        $sql = 'INSERT INTO' . static::$tableName . 'SET' . self::buildParams();
        $stmt = $connection->prepare($sql);

        foreach(static::$tableSchema as $columnName =>$type){
            if($type==4){
                filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }else{
                
            }
            $stmt->bindParam(":{$columnName}", $this->$columnName, $type);
        }
    }
     */
    protected static $tablename;

}