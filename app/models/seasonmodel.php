<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SeasonModel extends AbstractModel {

    public $id;
    public $season_name;

    protected static $tableName = 'season';

    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'season_name'               => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'id';

}
