<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class BusModel extends FeesModel
{
    public $id;
    public $name;
//    protected static $tableName = 'decorator';
//
//    protected static $tableSchema = array(
//        'id'                  => self::DATA_TYPE_INT,
//        'name'               => self::DATA_TYPE_STR
//    );
////protected static $primaryKey = 'id';

    public function __construct(IpayModel $newpay){
        parent::__construct($newpay);

    }

    function addPayment()
    {
        return $this->ref->addPayment() . " + flos el bus ya kelab";
    }

    function viewPayment()
    {
        return $this->ref->viewPayment() . "view payment el bus ya kelab ";
    }
}

?>
