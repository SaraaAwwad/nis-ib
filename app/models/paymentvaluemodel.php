<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentValueModel extends AbstractModel
{
    //public $id;
    //public $value;            //price for each decorator
   //? public $paymentObj;       // payment_id_fk
   //? public $selectedAttrObj;  // selected_id_fk

    public $id;
    public $selected_id_fk;
    public $payment_id_fk;
    public $value;


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
               // $this->paymentObj = new PaymentModel($row['$payment_id_fk']);
               // $this->selectedAttrObj = new PaymentselectedattrModel($row['selected_id_fk']);
               $this->selected_id_fk = $row['selected_id_fk'];
               $this->payment_id_fk = $row['payment_id_fk']; 
               $this->value = $row['value'];
                //$this->totalPrice = 0;
            }
        }
    }

    public static function add($payment, $selected_id_fk, $value){
      
        $query = "INSERT INTO
          payment_value(payment_id_fk, selected_id_fk, value)
          VALUES (:payment_id_fk, :selected_id_fk, :value)";
  
          $stmt = self::prepareStmt($query);
          
          $value = self::test_input($value);
  
          $payment_id_fk = $payment->id;
  
          $stmt->bindParam(":value", $value);
          $stmt->bindParam(":selected_id_fk", $selected_id_fk);
          $stmt->bindParam(":payment_id_fk", $payment_id_fk);
  
          
          if($stmt->execute()){
              return self::getLastId();
          }
  
          return false;
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

    public static function getAll($selected_id_fk, $payment_id_fk){

        //change to (assoc)

        $query = 'SELECT * FROM payment_value where payment_id_fk = '.$payment_id_fk.'
         and selected_id_fk = '.$selected_id_fk.'';
 
         $stmt = self::prepareStmt($query);        
         $Res = array();
         $i=0;
         if($stmt->execute()){
             while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                 $MyObj= new PaymentValueModel($row['id']);
                 $Res[$i]=$MyObj;
                 $i++;
             }
         return $Res;
         }else{
             return false;
         }
  
    }

    public static function getOpt($id){
        return (AttrOptionsModel::getOpt($id));
    }
}

?>