<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ClassModel extends AbstractModel {

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

}
