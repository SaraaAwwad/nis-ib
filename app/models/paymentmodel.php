<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentModel extends AbstractModel
{

    public $id;
    public $user_id_fk; //student id
    public $amount;
    public $method_id_fk;
    public $currency_id_fk;
    public $semester_id_fk;

    const PENDING = "pending";
    const APPROVED = "approved";

    protected static $tableName = 'payment';

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ". self::$tableName ." Where user_id_fk = '$this->user_id_fk' ";
        $stmt =self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->user_id_fk = $row['user_id_fk'];
                $this->amount = $row['amount'];
                $this->method_id = $row['method_id'];
                $this->currency_id = $row['currency_id'];
                $this->semester_id_fk = $row['semester_id_fk'];
            }
        }
    }

    public function insertPayment(){
        $query = "INSERT INTO " .self::$tableName. " (user_id_fk, amount, method_id_fk, currency_id_fk, semester_id_fk)
                  VALUES ($this->user_id_fk,$this->amount, $this->method_id_fk, $this->currency_id_fk, $this->semester_id_fk )";
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
            return $paymentObj;
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

    public static function getAll( $semester_id_fk){
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
}

?>