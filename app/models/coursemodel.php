<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseModel extends AbstractModel {

    public $id;
    public $course_code;
    public $descr;
    public $status;
    public $group_id_fk;
    public $level_id_fk;
    public $name;
    public $teaching_hours;

    protected static $tableName = 'course';
    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'name'               => self::DATA_TYPE_STR,
        'course_code'        => self::DATA_TYPE_STR,
        'descr'              => self::DATA_TYPE_STR,
        'level_id_fk'        => self::DATA_TYPE_INT,
        'teaching_hours'     => self::DATA_TYPE_INT,
        'group_id_fk'        => self::DATA_TYPE_INT,
        'status'             => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'id';

    public static function getCourse()
    {
        return self::get(
        'SELECT course.*, course_group.id, scl_level.id FROM ' . self::$tableName . ' INNER JOIN course_group ON course.group_id_fk = course_group.id INNER JOIN scl_level ON course.level_id_fk = scl_level.id'
        );
    }

    public static function insertInDB($course){

        $db = DatabaseHandler::getConnection();

        $sql = "INSERT INTO course ('name', 'course_code', 'descr, level_id_fk', 'group_id_fk', 'status', 'teaching_hours') 
        VALUES ('$course->name','$course->course_code', '$course->descr', '$course->level_id_fk',
        '$course->group_id_fk', '$course->status', '$course->teaching_hours' )";

        if (mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
        // die(mysqli_error($db));
        }
    }
    public static function getCourseByGrade($semester_id_fk)
    {
        return self::getArr(
            'SELECT $this->id, $this->course_code, registration.class_id_fk, 
            registration.semester_id_fk, schedule.semester_id_fk, 
            schedule.class_id_fk, schedule.id, schedule_details.sched_id_fk, 
            schedule_details.course_id_fk FROM course INNER JOIN schedule_details ON 
            schedule_details.course_id_fk = course.id INNER JOIN schedule ON 
            schedule_details.sched_id_fk = schedule.id INNER JOIN registration ON 
            schedule.class_id_fk = registration.class_id_fk 
            AND schedule.semester_id_fk = registration.semester_id_fk'

        );
        
    }
    
}
