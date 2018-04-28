<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class courseworkentityModel extends AbstractModel{
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
        $query = "SELECT * FROM ". $this->tableName ." WHERE id = :id ";
        $stmt = prepareStmt($query);
        $this->id = test_input($this->id);
        
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              $this->requirement_name =  $row['requirement_name'];       
            }
        }   
    }

    public static function create(){
        $query = "INSERT INTO
        " . $this->tableName . "
        SET
        requirement_name=:requirement_name";

        $stmt = prepareStmt($query);
        
        $this->requirement_name = test_input($this->requirement_name);

        $stmt->bindParam(":requirement_name", $this->requirement_name);

        if($stmt->execute()){
            return true;
        }

        return false;

    }

}
?>