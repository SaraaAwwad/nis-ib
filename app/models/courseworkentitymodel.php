<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseWorkEntityModel extends AbstractModel{
    protected static $tableName = 'coursework_requir';

    public $id;
    public $requirement_name;

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

}
?>