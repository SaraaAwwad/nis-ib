<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ClassModel extends AbstractModel {

    CONST ERR_EXIST = "err_class_exist";

    public $id;
    public $name;
    public $grade_id_fk;
    public $status_id_fk;

    protected static $tableName = 'class';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'name'               => self::DATA_TYPE_STR,
        'grade_id_fk'          => self::DATA_TYPE_INT,
        'status_id_fk'           => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'id';

    public static function getClasses()
    {
        return self::get(
        'SELECT class.*, scl_grade.grade_name, status.code  FROM ' . self::$tableName . ' INNER JOIN
          scl_grade ON class.grade_id_fk = scl_grade.id
         INNER JOIN status ON class.status_id_fk = status.id '
        );
    }

    public function isExist(){
        return self::get(
            'SELECT * FROM ' . self::$tableName . '
            WHERE name = '.$this->name.' AND 
            grade_id_fk = '.$this->grade_id_fk .' '
        );
    }

    public function __construct($id=""){
		if($id != ""){
            $this->id = $id;
			$this->getInfo();
		}
    }

    public function getInfo(){
        $query = "SELECT * FROM class Where id = '$this->id' ";
        $stmt = self::prepareStmt($query);

          if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id=$row["id"];
                $this->name = $row['name'];
                $this->grade_id_fk = $row['grade_id_fk'];
                $this->status_id_fk = $row['status_id_fk'];
            }
        }
    }

    public static function getClassesByGrade($grade_id_fk){
        return self::getArr('SELECT * FROM ' . self::$tableName . ' WHERE grade_id_fk = '. $grade_id_fk .'');
        $query = "SELECT * from class where grade_id_fk =: grade_id_fk";
        $stmt = self::prepareStmt($query);

        $grade_id_fk = self::test_input($grade_id_fk);
        $stmt->bindParam(":grade_id_fk", $grade_id_fk);

        $Classes = array();
        $i = 0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $classObj = new ClassModel(row["id"]);
                $Classes[$i] = $classObj;
                $i++;
            }
            return $Classes;
        }else{
            return false;
        }


    }
    
    public function isClassExist(){
        $query = "SELECT * FROM class where name =:name AND grade_id_fk =:grade ";
        $stmt = self::prepareStmt($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":grade", $this->grade_id_fk);

        if($stmt->execute()){
            $numofrows =  $stmt->rowCount();
        }
        if($numofrows > 0 ) {
            return true;
        }else{
            return false;
        }
    
    }
}
