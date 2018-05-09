<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class AttrOptionsModel extends AbstractModel{
    public function addOption($valueOpt){
       
        $query = "INSERT INTO
        attr_options(attr_id_fk, value)
        VALUES (:attr_id_fk, :value)";

        $stmt = self::prepareStmt($query);
        
        $value = self::test_input($value);

        $stmt->bindParam(":attr_id_fk", $this->id);
        $stmt->bindParam(":value", $valueOpt);
        
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public static function getOpt($id){
        $query = 'select * from attr_options where id = :id';
        $stmt = self::prepareStmt($query);
        
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $value =  $row['value'];     
        return $value;
        }   

    }
}