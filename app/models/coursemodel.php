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
}
