<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentModel extends AbstractModel
{

    public $id;
    public $user_id;
    public $amount;
    public $method_id;
    public $currency_id;

    protected static $tableName = 'payment';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'user_id_fk' => self::DATA_TYPE_INT,
        'amount' => self::DATA_TYPE_INT,
        'method_id_fk' => self::DATA_TYPE_INT,
        'currency_id_fk' => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

    public function InsertPayment()
    {

    }

    public function GetPayemnt(){


    }
}

?>