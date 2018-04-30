<?php
namespace PHPMVC\Models;
use PHPMVC\Models\AbstractModel;
class PaymentmethodModel extends AbstractModel {

    public $id;
    public $method;

    protected static $tableName = 'payment_method';

    public function __construct($id="")
    {
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ". self::$tableName ." Where id = '$this->id' ";
        $stmt =self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->method = $row['method'];
            }
        }
    }

    public static function getAll()
    {
        $query = "SELECT * FROM ". static::$tableName ;
        $stmt =self::prepareStmt($query);
        $methods = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $paymentObj = new PaymentmethodModel($row['id']);
                $paymentObj->method = $row['method'];
                $methods[$i] = $paymentObj;
                $i++;
            }
            return $methods;
        }else{
            return false;
        }
    }

}