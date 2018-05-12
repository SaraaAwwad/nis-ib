<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentModel extends AbstractModel
{

    public $id;
    public $amount;
    public $status_id_fk;
    public $status_val;
    public $user_id_fk;
    public $currency_id_fk;
    public $currency_val;
    //aggregation
    public $semesterObj;
    public $studentObj;
    public $currencyObj;
    public $paymentValueObjs = array();

    //EAV
    public $paymentMethodObj;
    protected static $tableName = 'payment';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo($id);
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ". self::$tableName ." Where id = '$this->id' ";
        $stmt =self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->amount = $row['amount'];
                $this->user_id_fk = $row['user_id_fk'];
                // Remove aggregation
                $this->currency_id_fk = $row['currency_id_fk'];
                $this->currency_val = CurrencyModel::getCurrencyCode($row['currency_id_fk']);
                //$this->currencyObj = new CurrencyModel($row['currency_id_fk']);
                $this->status_id_fk = $row['status_id_fk'];
                $this->status_val = PaymentstatusModel::getStatusCode($row['status_id_fk']);
                $this->studentObj = new StudentModel($row['user_id_fk']);
                $this->paymentMethodObj = new PaymentmethodModel($row['method_id_fk']);
                $this->semesterObj = new SemesterModel($row['semester_id_fk']);

            }
        }
    }

    public function insertPayment(){
        $query = "INSERT INTO " .self::$tableName. " (user_id_fk, amount, method_id_fk, currency_id_fk, semester_id_fk , status_id_fk)
                  VALUES ($this->user_id_fk,$this->amount, $this->method_id_fk, $this->currency_id_fk, $this->semester_id_fk,$this->status_id_fk )";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            $this->id = self::getLastId();
            return true;
        }else{
            return false;
        }

    }

    static function getPayment($pid){
        $query = "SELECT * FROM ". self::$tableName ." Where user_id_fk = $pid ";

        $stmt = self::prepareStmt($query);
        $payments = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $paymentObj = new ParentModel($row['id']);
                $payments[$i] = $paymentObj;
                $i++;
            }
            return $payments;
        }else{
            return false;
        }
    }

    public function add(){
        $query = "INSERT INTO
        payment(user_id_fk, amount, method_id_fk, currency_id_fk, semester_id_fk, date)
        VALUES (:user_id_fk, :amount, :method_id_fk, :currency_id_fk, :semester_id_fk, :date)";

        $stmt = self::prepareStmt($query);
        
        $this->date = date("Y/m/d");

        $stmt->bindParam(":user_id_fk", $this->user_id_fk);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":amount", $this->amount);                
        $stmt->bindParam(":method_id_fk", $this->method_id_fk);
        $stmt->bindParam(":semester_id_fk", $this->semester_id_fk);
        $stmt->bindParam(":currency_id_fk", $this->currency_id_fk);        

        if($stmt->execute()){
            $this->id = self::getLastId(); 
            return self::getLastId();
        }

        return false;
    }

    public function updateStatus($sid){
        $query = "UPDATE ". self::$tableName ." SET status_id_fk = ".$sid." WHERE id = ". $this->id;
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public static function getAllPayments($semester_id_fk){
        $query = "SELECT * FROM payment where semester_id_fk = '$semester_id_fk' ORDER BY date DESC ";
        $stmt = self::prepareStmt($query);        
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $MyObj= new PaymentModel($row['id']);
                $Res[$i]=$MyObj;
                $i++;
            }
        return $Res;
        }else{
            return false;
        }
    }


    public static function getAllStudentsPayments(){

        $query = "SELECT * FROM " .self::$tableName;
        $stmt = self::prepareStmt($query);
        $payments = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $paymentObj = new PaymentModel($row['id']);
                $payments[$i] = $paymentObj;
                $i++;
            }
            return $payments;
        }else{
            return false;
        }
    }
}

?>