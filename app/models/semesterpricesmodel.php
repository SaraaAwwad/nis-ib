<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SemesterPricesModel extends AbstractModel implements IpayModel{
    public $id;
    public $semester_id_fk;
    public $currency_id_fk;
    public $price;
    public $scl_grade_id_fk;
    protected static $tableName = 'semester_price';

    public function __construct($semester_id_fk, $grade_id_fk){
        $query = "SELECT * FROM semester_price WHERE semester_id_fk = '$semester_id_fk' AND scl_grade_id_fk = '$grade_id_fk' ";
        $stmt = $this->prepareStmt($query);  
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->semester_id_fk = $row['semester_id_fk'];
            $this->currency_id_fk = $row['currency_id_fk'];
            $this->price = $row['price'];
            $this->scl_grade_id_fk = $row['scl_grade_id_fk'];
        }
    }

    public function cost(){
        return $this->price;
    }

}