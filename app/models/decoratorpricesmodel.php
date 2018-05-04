<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class DecoratorpricesModel extends AbstractModel implements IpayModel
{
    public $id;
    public $currency_id_fk;
    public $price;
    //aggregation
    public $decoratorObj;      // $decorator_id_fk;
    public $gradeObj;         // $scl_grade_id_fk;

    public $ref_obj;

    protected static $tableName = 'decorator_prices';

    public function __construct($ref , $id=""){
  //  parent::__construct($obj);
        $this->ref_obj = $ref;
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){

//        $query = 'SELECT * FROM'. self::$tableName .'Where id ='.$this->id;
        $query = 'SELECT * FROM decorator_prices Where id ='.$this->id;

        $stmt = DatabaseHandler::getConnection()->prepare($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->decoratorObj = new DecoratorModel($row['decorator_id_fk']);
                $this->gradeObj = new SclGradeModel($row['scl_grade_id_fk']);
                $this->currency_id_fk = $row['currency_id_fk'];
                $this->price = $row['price'];
            }
        }
    }

    public static function getPricesByGrade($grade_id){

        $query = "SELECT * FROM " .self::$tableName. " WHERE scl_grade_id_fk = " .$grade_id;
        $stmt = self::prepareStmt($query);
        $decArr = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $DecoratorPricesObj = new DecoratorpricesModel(new PaymentvalueModel(),$row['id']);
                $decArr[$i] = $DecoratorPricesObj;
                $i++;
            }
            return $decArr;
        }else{
            return false;
        }

    }

    function addPayment()
    {
        return $this->ref_obj->addPayment() + $this->price;

    }
}


?>
