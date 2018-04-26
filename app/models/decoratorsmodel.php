<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class DecoratorsModel extends FeesModel
{
    public $id;
    public $name;
    protected static $tableName = 'decorator';

    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'name'               => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

    function addPayment()
    {

    }

    function viewPayment()
    {
        // TODO: Implement viewPayment() method.
    }
}

?>
