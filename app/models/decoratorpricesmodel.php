<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class DecoratorpricesModel extends AbstractModel{

    public $id;
    public $decorator_id_fk;
    public $scl_grade_id_fk;
    public $currency_id_fk;
    public $price;

    protected static $tableName = 'decorator_prices';

    protected static $tableSchema = array(
        'id'                            => self::DATA_TYPE_INT,
        'decorator_id_fk'               => self::DATA_TYPE_INT,
        'scl_grade_id_fk'               => self::DATA_TYPE_INT,
        'currency_id_fk'                => self::DATA_TYPE_INT,
        'price'                         => self::DATA_TYPE_INT
    );
    
    protected static $primaryKey = 'id';

}