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

    protected static $tableName = "transcript";
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'user_id_fk'          => self::DATA_TYPE_INT,
        'semester_id_fk'      => self::DATA_TYPE_INT,
        'NumericGrade'        => self::DATA_TYPE_INT,
        'LetterGrade'         => self::DATA_TYPE_STR,
        'course_id_fk'        => self::DATA_TYPE_INT,
        
    );

    //protected static $primaryKey = 'id';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getTranscript($id);
        }
    }

    public static function getTranscript($id)
    {
        
        $query = "SELECT * FROM transcript WHERE user_id_fk = '.$id.'";
        $stmt = self::prepareStmt($query);
        $tran = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $tran[$i] = new TranscriptModel();
                $tran[$i]->id = $row['id'];
                $tran[$i]->user_id_fk = $row['user_id_fk'];
                $tran[$i]->semester_id_fk = $row['semester_id_fk'];
                $tran[$i]->course_id_fk = $row['course_id_fk'];
                $tran[$i]->LetterGrade = $row['LetterGrade'];
                $i++;
            }
        }
    return $tran;
    }
    }


