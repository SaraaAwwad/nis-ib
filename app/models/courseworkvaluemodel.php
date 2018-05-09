<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseWorkValueModel extends AbstractModel{
    protected static $tableName = 'coursework_value';

    public $id;
    public $selected_id_fk;
    public $coursework_id_fk;
    public $value;

    public function  __construct($id=""){
        if($id != ""){
            $this->id= $id;
            $this->getInfo();
        }
    }
    
    public function getInfo(){
        //$query = "SELECT coursework_attr.*, type.type FROM coursework_attr INNER JOIN type ON type.id = coursework_attr.type_id_fk WHERE coursework_attr.id = :id ";
        $query="select * from coursework_value where id = :id";
        $stmt = self::prepareStmt($query);
        $this->id = self::test_input($this->id);
        
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->selected_id_fk =  $row['selected_id_fk'];
              $this->coursework_id_fk = $row['coursework_id_fk'];  
              $this->value = $row['value'];     
            }
        }   
    }

    public static function add($cw, $selected_id_fk, $value){
      
      $query = "INSERT INTO
        coursework_value(coursework_id_fk, selected_id_fk, value)
        VALUES (:coursework_id_fk, :selected_id_fk, :value)";

        $stmt = self::prepareStmt($query);
        
        $value = self::test_input($value);

        $coursework_id_fk = $cw->id;

        $stmt->bindParam(":value", $value);
        $stmt->bindParam(":selected_id_fk", $selected_id_fk);
        $stmt->bindParam(":coursework_id_fk", $coursework_id_fk);

        
        if($stmt->execute()){
            return self::getLastId();
        }

        return false;
    }

    public static function getAll($selected_id_fk, $coursework_id_fk){

       $query = 'SELECT * FROM coursework_value where coursework_id_fk = '.$coursework_id_fk.'
        and selected_id_fk = '.$selected_id_fk.'';

        $stmt = self::prepareStmt($query);        
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $MyObj= new CourseWorkValueModel($row['id']);
                $Res[$i]=$MyObj;
                $i++;
            }
        return $Res;
        }else{
            return false;
        }
 
    }

    public static function getOpt($id){
        return (AttrOptionsModel::getOpt($id));
    }

}