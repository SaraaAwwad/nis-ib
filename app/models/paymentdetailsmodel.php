<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentdetailsModel extends AbstractModel
{

    public $id;
    public $user_id_fk; //student id
    public $decorator_id_fk;
    public $amount;

    protected static $tableName = 'payment_detail';

    public function __construct($id="")
    {
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo()
    {
        $query = "SELECT * FROM " . self::$tableName . " Where user_id_fk = '$this->user_id_fk' ";
        $stmt = self::prepareStmt($query);

        if ($stmt->execute()) {
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $this->id = $row['id'];
                $this->decorator_id_fk = $row['decorator_id_fk'];
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
}

?>