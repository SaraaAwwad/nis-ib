<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseWorkAttrModel extends AbstractModel{
    protected static $tableName = 'coursework_attr';

    public $id;
    public $attr_name;
    public $type;

    public function  __construct($id=""){
        if($id != ""){
            $this->id= $id;
            $this->getInfo();
        }
    }
    
    public function getInfo(){
        $query = "SELECT coursework_attr.*, type.type FROM coursework_attr INNER JOIN type ON type.id = coursework_attr.type_id_fk WHERE coursework_attr.id = :id ";
        $stmt = self::prepareStmt($query);
        $this->id = self::test_input($this->id);
        
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->attr_name =  $row['attr_name'];
              $this->type = $row['type'];       
            }
        }   
    }

    public static function add($attr_name, $type){
        $query = "INSERT INTO
        coursework_attr(attr_name, type_id_fk)
        VALUES (:attr_name, :type_id_fk)";

        $stmt = self::prepareStmt($query);
        
        $attr_name = self::test_input($attr_name);
        $type = self::test_input($type);

        $stmt->bindParam(":attr_name", $attr_name);
        $stmt->bindParam(":type_id_fk", $type);
        
        if($stmt->execute()){
            return self::getLastId();
        }

        return false;

    }

    public static function getAll(){

        $query = "SELECT * FROM coursework_attr";
        $stmt = self::prepareStmt($query);        
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $MyObj= new CourseWorkAttrModel($row['id']);
                $Res[$i]=$MyObj;
                $i++;
            }
        return $Res;
        }else{
            return false;
        }


    }


}