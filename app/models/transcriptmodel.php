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

    protected static $primaryKey = 'id';

    


}