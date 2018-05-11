<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PaymentstatusModel extends AbstractModel {
    public $id;
    public $code;
    const pending = 1;
    const approved = 2;
    protected static $tableName = 'payment_status';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ".  self::$tableName ." Where id = '$this->id' ";
        $stmt = $this->prepareStmt($query);

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->code = $row['code'];
        }
    }

    public static function getAll(){
        $query = "SELECT * FROM ". self::$tableName;
        $stmt = self::prepareStmt($query);
        $Stat = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $Stat[$i] = new PaymentstatusModel();
                $Stat[$i]->id = $row['id'];
                $Stat[$i]->code = $row['code'];
                $i++;
            }
        }
        return $Stat;
    }

    Static function getStatusID($status){
        $query = "SELECT id FROM ". self::$tableName ." WHERE code = '$status'";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = $row['id'];
            }
            return $result;
        }else{
            return false;
        }
    }

    static function  getStatusCode($id){
        $query = "SELECT code FROM ". self::$tableName ." WHERE id = '$id'";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = $row['code'];
            }
            return $result;
        }else{
            return false;
        }
    }
}