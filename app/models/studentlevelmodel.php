<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StudentLevelModel extends AbstractModel{
    public $id;
    public $scl_level_id;
    public $scl_grade_id;
    public $user_id;

    public function InsertinDB(){

        $sql = "INSERT INTO student_level (scl_level_id_fk, scl_grade_id_fk,user_id_fk) 
                VALUES ($this->scl_level_id, $this->scl_grade_id,$this->user_id)";
        $db = DatabaseHandler::getConnection();
        $result = mysqli_query($db,$sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

}