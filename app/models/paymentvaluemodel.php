<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentvalueModel extends AbstractModel implements IpayModel
{
    public $id;
    public $value;            //price for each decorator
    public $paymentObj;       // payment_id_fk
    public $selectedAttrObj;  // selected_id_fk

    public $totalPrice;

    protected static $tableName = 'payment_value';

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
                $this->paymentObj = new PaymentModel($row['$payment_id_fk']);
                $this->selectedAttrObj = new PaymentselectedattrModel($row['selected_id_fk']);
                $this->value = $row['value'];
//                $this->totalPrice = 0;

            }
        }
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function addPayment()
    {
       return $this->paymentObj->amount;
    }

    public function InsertPayment()
    {
        $query = "INSERT INTO " .self::$tableName. " (user_id_fk, amount, method_id_fk, currency_id_fk, semester_id_fk)
                  VALUES ($this->paymentObj->user_id_fk, $this->paymentObj->amount,
                   $this->paymentObj->method_id, $this->paymentObj->currency_id, $this->paymentObj->semester_id_fk )";
        echo $query;
        var_dump($this->paymentObj);
        exit();
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function viewPayment()
    {
        $query = "SELECT * FROM ". self::$tableName ." Where user_id_fk = '$this->user_id_fk' ";

        $stmt = self::prepareStmt($query);
        $payments = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $paymentObj = new ParentModel($row['id']);
                $payments[$i] = $paymentObj;
                $i++;
            }
            return $paymentObj;
        }else{
            return false;
        }
    }
}

?>