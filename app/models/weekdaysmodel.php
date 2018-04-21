<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class WeekdaysModel extends AbstractModel {

    public $id;
    public $day;

    protected static $tableName = 'weekdays';

    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'day'               => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

}
