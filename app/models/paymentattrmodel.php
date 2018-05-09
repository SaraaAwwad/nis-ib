<?php
namespace PHPMVC\Models;
use PHPMVC\Models\AbstractModel;
class PaymentAttrModel extends AbstractModel {

    public $id;
    public $attr_name;
    public $type;
    public $oid = array();
    public $values = array();

    protected static $tableName = 'payment_attr';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query = "SELECT payment_attr.*, type.type, type.option_flag FROM payment_attr 
        INNER JOIN type ON type.id = payment_attr.type_id_fk
        WHERE payment_attr.id = :id ";
        
        $stmt = self::prepareStmt($query);
        $this->id = self::test_input($this->id);
        
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->attr_name =  $row['attr_name'];
              $this->type = $row['type'];       
              $this->flag = $row['option_flag'];
            }
        }  
        
        $this->getOptions();
    }

    public static function getAll(){
        $query = "SELECT * FROM ". static::$tableName ;
        $stmt =self::prepareStmt($query);
        $methods = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $paymentObj = new PaymentAttrModel($row['id']);
                $methods[$i] = $paymentObj;
                $i++;
            }
            return $methods;
        }else{
            return false;
        }
    }

    public function addOption($valueOpt){
       $aoptObj = new AttrOptionsModel("");
       return ($aoptObj->addOption($valueOpt));
    }

    public function getOptions(){
        $query = "SELECT attr_options.* FROM attr_options 
        INNER JOIN payment_attr ON payment_attr.id = attr_options.attr_id_fk 
        WHERE payment_attr.id = '$this->id' ";
        
        $stmt = self::prepareStmt($query);
        
        $i=0;
        
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->oid[$i] =  $row['id'];
              $this->values[$i] = $row['value']; 
              $i++;      
            }
        }
    }

}