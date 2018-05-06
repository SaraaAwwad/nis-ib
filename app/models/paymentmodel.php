<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentModel extends AbstractModel
{

    public $id;
    public $user_id_fk; //student id
    public $amount;
    public $method_id;
    public $currency_id;
    public $semester_id_fk;

    protected static $tableName = 'payment';

    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'user_id_fk' => self::DATA_TYPE_INT,
        'amount' => self::DATA_TYPE_INT,
        'method_id_fk' => self::DATA_TYPE_INT,
        'currency_id_fk' => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';


    public function __construct($id="")
    {
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


    public function insertPayment()
    {
        $query = "INSERT INTO " .self::$tableName. " (user_id_fk, amount, method_id_fk, currency_id_fk, semester_id_fk)
                  VALUES ($this->user_id_fk,$this->amount, $this->method_id, $this->currency_id, $this->semester_id_fk )";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    static function getPayment($pid)
    {
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
}

?>