<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SlotModel extends AbstractModel {

    public $id;
    public $slot_name;
    public $start_time;
    public $end_time;

    protected static $tableName = 'slot';

    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'slot_name'               => self::DATA_TYPE_STR,
        'start_time'        => self::DATA_TYPE_STR,
        'end_time'              => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

}
