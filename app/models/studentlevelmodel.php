<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StudentLevelModel extends AbstractModel{
    public $id;
    public $scl_grade_id_fk; //use grade only (remove level from database)
    public $user_id_fk;
    private $table_name = "student_level";

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo()
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id =". $this->id;
        $stmt =self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row["id"];
                $this->scl_grade_id_fk = $row["scl_grade_id_fk"];
                $this->user_id_fk = $row["user_id_fk"];
            }
        }
    }

//    public function InsertinDB(){
//
//        $sql = "INSERT INTO student_level (scl_level_id_fk, scl_grade_id_fk,user_id_fk)
//                VALUES ($this->scl_level_id, $this->scl_grade_id,$this->user_id)";
//        $db = DatabaseHandler::getConnection();
//        $result = mysqli_query($db,$sql);
//        if($result){
//            return true;
//        }else{
//            return false;
//        }
//    }

}