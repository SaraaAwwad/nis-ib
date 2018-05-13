<?php
namespace PHPMVC\Models;

class DecoratorpricesModel extends ExtrafeesModel
{
    public $id;
    public $currency_id_fk;
    public $price;
    public $decoratorObj;      // $decorator_id_fk;
    public $gradeObj;         // $scl_grade_id_fk;


    protected static $tableName = 'decorator_prices';

    public function __construct($ref , $id=""){
        $this->ipay = $ref;
    
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){

        $query = 'SELECT * FROM decorator_prices Where id ='.$this->id;
        $stmt =  self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->decoratorObj = new DecoratorModel($row['decorator_id_fk']);
                $this->gradeObj = new SclGradeModel($row['scl_grade_id_fk']);

                //^obj leh?
                $this->scl_grade_id_fk = $row['scl_grade_id_fk'];
                $this->decorator_id_fk = $row['decorator_id_fk'];
                $this->currency_id_fk = $row['currency_id_fk'];
                $this->price = $row['price'];
            }
        }
    }

    public static function getPriceByGrade($grade_id){

        $query = "SELECT * FROM " .self::$tableName. " WHERE scl_grade_id_fk = " .$grade_id;
        $stmt = self::prepareStmt($query);
        $decArr = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                //change 1st param
                $DecoratorPricesObj = new DecoratorpricesModel("",$row['id']);
                $decArr[$i] = $DecoratorPricesObj;
                $i++;
            }
            return $decArr;
        }else{
            return false;
        }

    }

    function cost ()
    {
        return $this->ipay->cost() + $this->price;
    }
}


?>
