<?php
namespace PHPMVC\Models;
use PHPMVC\Models\AbstractModel;
class PaymentselectedattrModel extends AbstractModel {

    public $id;
    public $attr_id_fk;
    public $method_id_fk;
    public $methodObj;
    public $attrObj;

    protected static $tableName = 'payment_selected_attr';

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
                $paymentObj = new PaymentselectedattrModel($row['id']);
                $paymentObj->method = $row['method'];
                $methods[$i] = $paymentObj;
                $i++;
            }
            return $methods;
        }else{
            return false;
        }
    }

    public function getAttr($mid){

//        $query= "SELECT payment_method.id methodid , payment_selected_attr.id attrid , payment_attr.* FROM payment_method
//                 INNER JOIN payment_selected_attr ON ( payment_method.id = payment_selected_attr.method_id_fk )
//                 INNER JOIN payment_attr ON (payment_selected_attr.attr_id_fk = payment_attr.id)
//                 where payment_method.id =" . $this->id;
        $query = "SELECT * FROM ". self::$tableName ." WHERE method_id_fk =" . $mid;
        $stmt =self::prepareStmt($query);
        $SelectedAttr = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $obj = new PaymentselectedattrModel($row['id']);
                $obj->methodObj = new PaymentmethodModel($row['method_id_fk']);
                $obj->attrObj = new PaymentattrModel($row['attr_id_fk']);
                $SelectedAttr[$i] = $obj;
                $i++;
            }
            return $SelectedAttr;
        }else{
            return false;
        }
    }

}