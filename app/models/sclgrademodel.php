<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SclGradeModel extends AbstractModel{
    public $id;
    public $grade_name;

    protected static $tableName = 'scl_grade';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'grade_name'          => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';


}