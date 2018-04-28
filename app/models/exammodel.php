<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ExamModel extends AbstractModel{

    public $id;
    public $semester_id_fk;
    public $grade_id_fk ;
    public $status_id_fk;
    protected static $tableName = 'exam';

    protected static $tableSchema = array(
        'id'                        => self::DATA_TYPE_INT,
        'grade_id_fk'               => self::DATA_TYPE_INT,
        'semester_id_fk'            => self::DATA_TYPE_INT,
        'status_id_fk'              => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

    public static function getExams()
    {
        return self::get(
            'SELECT exam.*, scl_grade.grade_name, semester.year, season.season_name, status.code  FROM ' . self::$tableName . ' INNER JOIN
          scl_grade ON exam.grade_id_fk = scl_grade.id
         INNER JOIN status ON exam.status_id_fk = status.id
         INNER JOIN semester ON exam.semester_id_fk = semester.id
         INNER JOIN season ON semester.season_id_fk = season.id '
        );
    }

    public function isExist(){
        return self::get(
            'SELECT * FROM ' . self::$tableName . '
            WHERE grade_id_fk = '.$this->grade_id_fk.' AND 
            semester_id_fk = '.$this->semester_id_fk .' '
        );
    }

    public static function getStudentsInCourse($course){
        return self::getArr(
            'select user.id, user.fname, user.lname
            From user inner JOIN registration on registration.student_id_fk = user.id 
            INNER JOIN schedule on schedule.class_id_fk = registration.class_id_fk 
            INNER JOIN schedule_details ON schedule_details.sched_id_fk = schedule.id 
            AND schedule_details.course_id_fk = ' .$course. '
            AND schedule.semester_id_fk = registration.semester_id_fk 
            WHERE user.status = (SELECT id FROM status WHERE code = "active")');
    }


}