<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StatusModel extends AbstractModel {
    public $id;
    public $code;
    private $tableName = "status";
    
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
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->code = $row['code'];
        }
    }

    public static function getAll(){
        $query = "SELECT * FROM status";
        $stmt = self::prepareStmt($query);
        $Stat = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $Stat[$i] = new StatusModel();
                $Stat[$i]->id = $row['id'];
                $Stat[$i]->code = $row['code'];
                $i++;
            }
        }
    return $Stat;
    }
}