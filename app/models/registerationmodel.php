<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RegisterationModel extends AbstractModel{

    public $id;
    public $student_id;
    public $class_id;
    public $datetime;
    public $Semester_id_fk;

    protected static $tableName = 'registration';

    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'student_id_fk'               => self::DATA_TYPE_INT,
        'class_id_fk'          => self::DATA_TYPE_INT,
        'semester_id_fk'           => self::DATA_TYPE_INT,
        'datetime'  =>        self::DATA_TYPE_DATE
    );
    protected static $primaryKey = 'id';

    public static function getReg()
    {
        return self::get(
        'SELECT registration.* , user.fname, user.lname, class.name, season.season_name, semester.year FROM ' . self::$tableName . ' INNER JOIN
          class ON registration.class_id_fk = class.id INNER JOIN semester ON registration.semester_id_fk = semester.id
          INNER JOIN season on season.id = semester.season_id_fk INNER JOIN user ON registration.student_id_fk = user.id'
        );
    }
}


?>