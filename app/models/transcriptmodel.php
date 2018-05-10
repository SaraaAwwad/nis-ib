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
            $this->getTranscript($id);
        }
    }

    public static function getTranscript($id)
    {
        
        $query = "SELECT transcript.*, semester.year, season.season_name, course.course_code FROM transcript 
        INNER JOIN semester ON transcript.semester_id_fk = semester.id
        INNER JOIN season ON semester.season_id_fk = season.id 
        INNER JOIN course ON transcript.course_id_fk = course.id
        WHERE transcript.user_id_fk = '.$id.'";
        
        $stmt = self::prepareStmt($query);
        $tran = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $tran[$i] = new TranscriptModel();
                // $tran[$i]->id = $row['id'];
                $tran[$i]->user_id_fk = $row['user_id_fk'];
                $tran[$i]->semester_id_fk = $row['semester_id_fk'];
                $tran[$i]->season_name = $row['season_name'];
                $tran[$i]->year = $row['year'];
                $tran[$i]->course_code = $row['course_code'];
                $tran[$i]->LetterGrade = $row['LetterGrade'];
                $i++;
            }
        }
        return $tran;
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
        $old .= $this->NumericGrade;
        $old .= $this->semester_id_fk;
        $old .= $this->course_id_fk;

        $this->NumericGrade = self::encrypt($old);
    }

    public function decryptGrade(){
        $dec = self::decrypt($this->NumericGrade);
        $dec = str_replace($this->user_id_fk, "", $dec);
        $dec = str_replace($this->semester_id_fk, "", $dec);
        $dec = str_replace($this->course_id_fk, "", $dec);
        $this->NumericGrade = $dec;
    }
}


