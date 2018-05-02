<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class TranscriptModel extends AbstractModel{

    public $id;
    public $user_id_fk;
    public $semester_id_fk;
    public $NumericGrade;
    public $LetterGrade;
    public $course_id_fk;

    // protected static $tableName = "transcript";
    // protected static $tableSchema = array(
    //     'id'                  => self::DATA_TYPE_INT,
    //     'user_id_fk'          => self::DATA_TYPE_INT,
    //     'semester_id_fk'      => self::DATA_TYPE_INT,
    //     'NumericGrade'        => self::DATA_TYPE_INT,
    //     'LetterGrade'         => self::DATA_TYPE_STR,
    //     'course_id_fk'        => self::DATA_TYPE_INT,
        
    // );

    //SELECT transcript.*, 
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
                // $tran[$i]->user_id_fk = $row['user_id_fk'];
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
    }


