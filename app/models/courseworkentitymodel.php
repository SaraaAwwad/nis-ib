<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseWorkEntityModel extends AbstractModel{
    protected static $tableName = 'coursework_requir';
    public $id;
    public $requirement_name;

    //its attributes
    public $attr = array();

    public function  __construct($id=""){
        if($id != ""){
            $this->id= $id;
            $this->getInfo();
        }
    }
    
    public function getInfo(){
        $query = "SELECT * FROM coursework_requir WHERE id = :id ";
        $stmt = self::prepareStmt($query);
        $this->id = self::test_input($this->id);
        
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->requirement_name =  $row['requirement_name'];       
            }
        }
        
       $this->getSelectedAttr();
    }

    public static function add($requirement_name){
        $query = "INSERT INTO
        coursework_requir(requirement_name)
        VALUES (:requirement_name)";

        $stmt = self::prepareStmt($query);
        
        $requirement_name = self::test_input($requirement_name);

        $stmt->bindParam(":requirement_name", $requirement_name);

        if($stmt->execute()){
            return self::getLastId();
        }

        return false;

    }
    
    public function addSelected($attr_id_fk, $req_id_fk){
        
        $query = "INSERT INTO
        coursework_selected_attr(attr_id_fk, req_id_fk)
        VALUES (:attr_id_fk, :req_id_fk)";

        $stmt = self::prepareStmt($query);
        
        $stmt->bindParam(":attr_id_fk", $attr_id_fk);
        $stmt->bindParam(":req_id_fk", $req_id_fk);
        
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    public static function getAll(){
        
        $query = "SELECT * FROM coursework_requir";
        $stmt = self::prepareStmt($query);        
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $MyObj= new CourseWorkEntityModel($row['id']);
                $Res[$i]=$MyObj;
                $i++;
            }
        return $Res;
        }else{
            return false;
        }
    }

    public function getSelectedAttr(){
        $query = "SELECT coursework_selected_attr.id as sid, coursework_attr.* FROM coursework_selected_attr 
        INNER JOIN coursework_attr ON coursework_selected_attr.attr_id_fk = coursework_attr.id WHERE req_id_fk = '$this->id'";
         $stmt = self::prepareStmt($query);        
         $i=0;
         if($stmt->execute()){
             while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                 $MyObj= new CourseWorkAttrModel($row['id']);
                 $MyObj->sid = $row['sid'];
                 $this->attr[$i]=$MyObj;
                 $i++;
             }
            return true;
         }else{
             return false;
         }
    }
}
?>