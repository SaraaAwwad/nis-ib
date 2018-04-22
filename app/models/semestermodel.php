<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SemesterModel extends AbstractModel {

    public $id;
    public $year;
    public $season_id_fk;
    public $start_date;
    public $end_date;

    protected static $tableName = 'semester';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'year'               => self::DATA_TYPE_INT,
        'season_id_fk'          => self::DATA_TYPE_INT,
        'start_date'           => self::DATA_TYPE_DATE,
        'end_date'           => self::DATA_TYPE_DATE        
    );

    protected static $primaryKey = 'id';

    public static function getSemesters()
    {
        return self::get(
        'SELECT semester.*, season.season_name FROM ' . self::$tableName . ' INNER JOIN
          season ON semester.season_id_fk = season.id'
        );
    }

}
