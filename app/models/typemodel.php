<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class TypeModel extends AbstractModel {
    public $id;
    public $type;
    public $option_flag;
    private $tableName = "type";
    
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
            $this->type = $row['type'];
            $this->option_flag = $row['option_flag'];
        }
    }

    public static function getAll(){
        $query = "SELECT * FROM type";
        $stmt = self::prepareStmt($query);
        $Stat = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $Stat[$i] = new StatusModel();
                $Stat[$i]->id = $row['id'];
                $Stat[$i]->type = $row['type'];
                $i++;
            }
        }
    return $Stat;
    }

    public static function getByName($name){
        $query = "SELECT * FROM type Where type = :name ";
        $stmt = self::prepareStmt($query);

        $name = self::test_input($name);  
        
        $stmt->bindParam(':name', $name, \PDO::PARAM_STR);         
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $typeObj = new TypeModel($row['id']);
        }
    
        return $typeObj;
    }
}