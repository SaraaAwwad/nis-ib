<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SclGradeModel extends AbstractModel{
    public $id;
    public $grade_name;
    private $table_name = 'scl_grade';

    protected static $tableName = 'scl_grade';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'grade_name'          => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

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
                $this->grade_name = $row["grade_name"];
            }
        }
    }

    public static function getAll(){
        $query = "SELECT * from scl_grade";
        $stmt = self::prepareStmt($query);

        $Grades = array();
        $i = 0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $gradeObj = new SclGradeModel($row["id"]);
                $Grades[$i] = $gradeObj;
                $i++;
            }
            return $Grades;
        }else{
            return false;
        }
    }


}
?>