<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StudentLevelModel extends AbstractModel{
    public $id;
    public $scl_level_id_fk;
    public $scl_grade_id_fk;
    public $user_id_fk;

    protected static $tableName = 'student_level';
    protected static $tableSchema = array(
        'id'                          => self::DATA_TYPE_INT,
        'scl_level_id_fk'             => self::DATA_TYPE_INT,
        'user_id_fk'                  => self::DATA_TYPE_INT,
        'scl_grade_id_fk'             => self::DATA_TYPE_INT,

    );
    protected static $primaryKey = 'id';
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