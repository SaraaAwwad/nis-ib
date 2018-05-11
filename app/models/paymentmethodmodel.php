<?php
namespace PHPMVC\Models;
use PHPMVC\Models\AbstractModel;
class PaymentmethodModel extends AbstractModel {

    public $id;
    public $method;

    protected static $tableName = 'payment_method';

    public $attr = array();

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
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

        $this->getSelectedAttr();
    }

    public static function getAll(){
        $query = "SELECT * FROM ". static::$tableName ;
        $stmt =self::prepareStmt($query);
        $methods = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $paymentObj = new PaymentmethodModel($row['id']);
                $methods[$i] = $paymentObj;
                $i++;
            }
            return $methods;
        }else{
            return false;
        }
    }

    public function addSelected($attr_id_fk, $req_id_fk){
        
        $query = "INSERT INTO
        payment_selected_attr(attr_id_fk, method_id_fk)
        VALUES (:attr_id_fk, :req_id_fk)";

        $stmt = self::prepareStmt($query);
        
        $stmt->bindParam(":attr_id_fk", $attr_id_fk);
        $stmt->bindParam(":req_id_fk", $req_id_fk);
        
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    public function getSelectedAttr(){
        $query = "SELECT payment_selected_attr.id as sid, payment_attr.* FROM payment_selected_attr 
        INNER JOIN payment_attr ON payment_selected_attr.attr_id_fk = payment_attr.id WHERE method_id_fk = '$this->id'";
         $stmt = self::prepareStmt($query);        
         $i=0;
         if($stmt->execute()){
             while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                 $MyObj= new PaymentAttrModel($row['id']);
                 $MyObj->sid = $row['sid'];
                 $this->attr[$i]=$MyObj;
                 $i++;
             }
            return true;
         }else{
             return false;
         }

    }

    public static function add($requirement_name){
        $query = "INSERT INTO
        payment_method(method)
        VALUES (:requirement_name)";

        $stmt = self::prepareStmt($query);
        
        $requirement_name = self::test_input($requirement_name);

        $stmt->bindParam(":requirement_name", $requirement_name);

        if($stmt->execute()){
            return self::getLastId();
        }

        return false;

    }
}