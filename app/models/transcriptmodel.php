<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class TranscriptModel extends AbstractModel{

    public $id;
    public $user_id_fk;
    public $semester_id_fk;
    public $NumericGrade;
    public $date;
    public $course_id_fk;

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        
        /*$query = "SELECT transcript.*, semester.year, season.season_name, course.course_code FROM transcript 
        INNER JOIN semester ON transcript.semester_id_fk = semester.id
        INNER JOIN season ON semester.season_id_fk = season.id 
        INNER JOIN course ON transcript.course_id_fk = course.id
        WHERE transcript.user_id_fk = '.$id.'";*/
        
        $query = "SELECT * FROM transcript 
        WHERE id = :id ";

        $stmt = self::prepareStmt($query);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->course_id_fk = $row['course_id_fk'];
                $this->course = new CourseModel($row['course_id_fk']);
                $this->user_id_fk = $row['user_id_fk'];
                $this->student = new StudentModel($this->user_id_fk);
                $this->semester_id_fk = $row['semester_id_fk'];
                $this->semester = new SemesterModel($row['semester_id_fk']);
                $this->NumericGrade = $row['NumericGrade'];
                $this->date = $row['date'];
            }
        }
        $this->decryptGrade();   
        $this->getOutOfGrade();   
    }

    public function add(){
        $this->encryptGrade();

        $sql = "INSERT INTO transcript (user_id_fk, semester_id_fk, NumericGrade, date, course_id_fk) 
                VALUES (:user_id_fk, :semester_id_fk, :NumericGrade, :date, :course_id_fk)";

        $stmt = self::prepareStmt($sql);  
        
        $stmt->bindParam(':user_id_fk', $this->user_id_fk);         
        $stmt->bindParam(":semester_id_fk", $this->semester_id_fk);
        $stmt->bindParam(":NumericGrade", $this->NumericGrade);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":course_id_fk", $this->course_id_fk);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function encryptGrade(){
        $old = $this->user_id_fk;
        $old .= $this->semester_id_fk;
        $old .= $this->course_id_fk;
        $old .= $this->NumericGrade;

        $this->NumericGrade = self::encrypt($old);
    }

    public function decryptGrade(){
        $dec = self::decrypt($this->NumericGrade);  
        $dec = self::replace($dec, $this->user_id_fk);          
        $dec =  self::replace($dec, $this->semester_id_fk);
        $dec =  self::replace($dec, $this->course_id_fk);

        $this->NumericGrade = $dec;
    }

    public static function getAll(){
        $sql = "SELECT * FROM transcript group by course_id_fk, semester_id_fk";
        $Trans = array();
        $i=0;
        
        $stmt = self::prepareStmt($sql);  

        if ($stmt->execute()){
           while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){ 
                $transObj = new TranscriptModel($row["id"]);
                $Trans[$i] = $transObj;
            $i++;
            }
            return $Trans;
        }else{
            return false;
        }
    }

    public static function getBySemAndCourse($course, $semester){
        $sql = "SELECT * from transcript where course_id_fk = :course and semester_id_fk = :semester";
        $stmt = self::prepareStmt($sql);  
        
        $semester = self::test_input($semester);
        $course = self::test_input($course);

        $stmt->bindParam(":semester", $semester);
        $stmt->bindParam(":course", $course);
 
        $Trans = array();
        $i=0;
        if ($stmt->execute()){
            $numofrows =  $stmt->rowCount();
           while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){ 
                $transObj = new TranscriptModel($row["id"]);
                $Trans[$i] = $transObj;
            $i++;
            }
        }else{
            return false;
        }

        if($numofrows > 0 ) {
            return $Trans;
        }else{
            return false;
        }
    }

    public function edit(){
        $this->encryptGrade();
        $sql = "UPDATE transcript SET NumericGrade = :NumericGrade, date = :date
        WHERE id = :id";
        
        $stmt = self::prepareStmt($sql);  

        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT); 
        $stmt->bindParam(':NumericGrade', $this->NumericGrade);
        $stmt->bindParam(':date', $this->date);
    
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getStudentTranscript($id){
        $query = "SELECT transcript.*, semester.year, season.season_name, course.course_code FROM transcript 
        INNER JOIN semester ON transcript.semester_id_fk = semester.id
        INNER JOIN season ON semester.season_id_fk = season.id 
        INNER JOIN course ON transcript.course_id_fk = course.id
        WHERE transcript.user_id_fk = '.$id.'";

        $stmt = self::prepareStmt($query);
        $stmt->bindParam(':id', $this->id);

        $Trans = array();
        $i=0;
        
        if ($stmt->execute()){
           while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){ 
                $transObj = new TranscriptModel($row["id"]);
                $Trans[$i] = $transObj;
            $i++;
            }
            return $Trans;
        }else{
            return false;
        }
    }

    public function getOutOfGrade(){
        $maxgrade  = ExamModel::getOutOfGrade($this->course_id_fk, $this->semester_id_fk);
        $this->OutOfGrade = $maxgrade;
    }


}



