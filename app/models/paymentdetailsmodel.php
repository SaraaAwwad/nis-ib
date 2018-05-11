<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentdetailsModel extends AbstractModel
{

    public $id;
    public $payment_id_fk;
    public $decorator_id_fk;
    public $decoratorObj;
    public $amount;

    protected static $tableName = 'payment_detail';

    public function __construct($id="")
    {
        if($id != ""){
            $this->id = $id;
            $this->getInfo($id);
        }
    }

    public function getInfo()
    {
        $query = "SELECT * FROM " . self::$tableName . " Where id = '$this->id' ";
//        var_dump($query);
        $stmt = self::prepareStmt($query);

        if ($stmt->execute()) {
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $this->decorator_id_fk = $row['decorator_id_fk'];
                $this->decoratorObj = new DecoratorModel($row['decorator_id_fk']);
                $this->amount = $row['amount'];
                $this->payment_id_fk = $row['payment_id_fk'];
            }
        }
    }

    public function add(){
        $query = "INSERT INTO ". self::$tableName ." (payment_id_fk, decorator_id_fk, amount) VALUES (:pay, :dec_id, :amount)";
        $stmt =self::prepareStmt($query);
        
        $stmt->bindParam(':pay', $this->payment_id_fk);         
        $stmt->bindParam(":dec_id", $this->decorator_id_fk);
        $stmt->bindParam(":amount", $this->amount);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    static public function getDetails($payment_id){
        $query = "SELECT * FROM ". self::$tableName ." WHERE payment_id_fk =". $payment_id;
        $stmt =self::prepareStmt($query);
        $details = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $details[$i] = new PaymentdetailsModel($row['id']);
                $i++;
            }
            return $details;
        }else{
            return false;
        }
    }
}

?>