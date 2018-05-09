<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseWorkModel extends AbstractModel{
    protected static $tableName = 'coursework';

    public $id;
    public $name;
    public $date;
    public $course_id_fk;
    public $req_id_fk;
    public $semester_id_fk;

    public function  __construct($id=""){
        if($id != ""){
            $this->id= $id;
            $this->getInfo();
        }
    }
    
    public function getInfo(){
        $query = "SELECT * FROM coursework WHERE id = :id";
        $stmt = self::prepareStmt($query);
        $this->id = self::test_input($this->id);
        
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->name =  $row['name'];
              $this->date = $row['date'];
              $this->req_id_fk = $row['req_id_fk'];
              $this->req = new CourseWorkEntityModel($this->req_id_fk);
              $this->course_id_fk = $row['course_id_fk'];
              $this->semester_id_fk = $row['semester_id_fk'];       
            }
        }   
    }

    public function add(){
        $query = "INSERT INTO
        coursework(name, course_id_fk, date, req_id_fk, semester_id_fk)
        VALUES (:name, :course_id_fk, :date, :req_id_fk, :semester_id_fk)";

        $stmt = self::prepareStmt($query);
        
        $this->name = self::test_input($this->name);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":req_id_fk", $this->req_id_fk);                
        $stmt->bindParam(":course_id_fk", $this->course_id_fk);
        $stmt->bindParam(":semester_id_fk", $this->semester_id_fk);
        

        if($stmt->execute()){
            $this->id = self::getLastId(); 
            return self::getLastId();
        }

        return false;
    }

    public static function getAll($course_id_fk, $semester_id_fk){
        $query = "SELECT * FROM coursework where course_id_fk = '$course_id_fk' and semester_id_fk = '$semester_id_fk' ORDER BY date DESC ";
        $stmt = self::prepareStmt($query);        
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $MyObj= new CourseWorkModel($row['id']);
                $Res[$i]=$MyObj;
                $i++;
            }
        return $Res;
        }else{
            return false;
        }
    }

}