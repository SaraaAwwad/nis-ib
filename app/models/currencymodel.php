<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CurrencyModel extends AbstractModel{
    public $id;
    public $code;
    private $tableName = "currency";

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){

        $query = "SELECT * FROM ".$this->tableName ." Where id = '$this->id' ";
        $stmt = $this->prepareStmt($query);

          if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->code = $row['code'];
            }
        }
    }

    Static function getAll(){
        $query = "SELECT * FROM currency";
        $stmt = self::prepareStmt($query);
        $Types= array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $CurrencyObj = new CurrencyModel($row['id']);
                $Types[$i] = $CurrencyObj;
                $i++;
            }
        return $Types;
        }
    
    }

}