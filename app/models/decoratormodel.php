<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class DecoratorModel extends AbstractModel
{
    public $id;
    public $name;

    protected static $tableName = 'decorator';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){

        $query = "SELECT * FROM ". self::$tableName ." Where id = '$this->id' ";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->name = $row['name'];
            }
        }
    }
    Static function getDecorator(){
        $query = "SELECT * FROM decorator";
        $stmt = self::prepareStmt($query);
        $Types= array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $Obj = new DecoratorModel($row['id']);
                $Types[$i] = $Obj;
                $i++;
            }
            return $Types;
        }else{
            return false;
        }
    }

}
?>