<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class GradeModel extends AbstractModel {

    public $id;
    public $grade_name;

    protected static $tableName = 'scl_grade';
    protected static $tableSchema = array(
        'id'                       => self::DATA_TYPE_INT,
        'grade_name'               => self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'id';

    public static function getMaxGrade(){
        $query = "SELECT MAX(id) as id from scl_grade";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row["id"];
        }
    }

}
