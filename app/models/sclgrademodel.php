<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SclGradeModel extends AbstractModel{
    public $id;
    public $grade_name;

    protected static $tableName = 'scl_grade';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'grade_name'               => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

    

    // public static function getAll()
    // {
    //     $db = DatabaseHandler::getConnection();
    //     $sql = "SELECT * FROM scl_grade";
    //     $gradeinfo = mysqli_query($db,$sql);
    //     $Grade = array();
    //     $i=0;

    //     if($gradeinfo){

    //         while($row = mysqli_fetch_array($gradeinfo)){

    //             $Grade[$i] = new SclGradeModel();
    //             $Grade[$i]->id = $row['id'];
    //             $Grade[$i]->grade_name = $row['grade_name'];
    //             $i++; 
    //         }
    //     }

    //         return $Grade;
    // }


}