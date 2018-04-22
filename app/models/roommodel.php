<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RoomModel extends AbstractModel {

    public $id;
    public $room_name;
    public $size;

    protected static $tableName = 'room';

    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'room_name'               => self::DATA_TYPE_STR,
        'size'               => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'id';

}
